<?php require_once('config.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Removed reCAPTCHA verification logic for signup
    // Proceed with login/signup logic here
}

$request = $_SERVER['REQUEST_URI'];
if (substr($request, -4) == '.php') {
    $new_url = substr($request, 0, -4);
    header("Location: $new_url", true, 301);
    exit();
}
?>

<?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger">
        <?php
        echo $_SESSION['error'];
        unset($_SESSION['error']);
        ?>
    </div>
<?php endif; ?>

<script src="https://www.google.com/recaptcha/api.js?render=6LfCPpMqAAAAANJD3dBADWW_bQgoZa5_SXfnrlvK"></script>

<!DOCTYPE html>
<html lang="en">
<?php require_once('inc/header.php'); ?>

<body class="light-mode">
    <?php if ($_settings->chk_flashdata('success')): ?>
        <script>
            alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
        </script>
    <?php endif; ?>
    <?php require_once('inc/topBarNav.php'); ?>
    <style>
        #uni_modal .modal-content>.modal-footer,
        #uni_modal .modal-content>.modal-header {
            display: none;
        }
    </style>
    <div class="container-fluid mb-5 mt-2">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-4">
                <h3 class="text-center">Login</h3>
                <hr>
                <form id="login-form" action="classes/registereduser_login.php" method="post">
                    <div class="form-group">
                        <label for="email" class="control-label">Email</label>
                        <input type="email" class="form-control form" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password" class="control-label">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control form" id="password" name="password" required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button"
                                    onclick="togglePasswordVisibility('password', this)">
                                    <i class="fa fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">
                    <div class="row mb-4 mt-3">
                        <button type="submit" class="btn btn-primary float-end" name="login_btn">Login</button>
                    </div>
                    <div class="row mb-4">
                        <button type="button" class="btn btn-secondary float-end" data-toggle="modal"
                            data-target="#signupModal">Create Account</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Signup Modal -->
    <div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="signupModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="signupModalLabel">Create Account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="signup-form">
                        <div class="form-group">
                            <label for="name" class="control-label">Full Name</label>
                            <input type="text" class="form-control" name="name" required oninput="validateName(this)">
                        </div>
                        <div class="form-group">
                            <label for="user_name" class="control-label">Username</label>
                            <input type="text" class="form-control" name="user_name" required oninput="validateName(this)">
                        </div>
                        <div class="form-group">
                            <label for="email" class="control-label">Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password" class="control-label">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control form" id="signup-password" name="password"
                                    required oninput="validatePassword(this)">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button"
                                        onclick="togglePasswordVisibility('signup-password', this)">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            <small><a href="#" onclick="suggestStrongPassword()">Suggest Strong Password</a></small>
                        </div>
                        <div class="form-group">
                            <label for="phone_no" class="control-label">Phone Number</label>
                            <input type="text" class="form-control" name="phone_no" required oninput="validatePhoneNumber(this)">
                        </div>
                        <div class="form-group">
                            <label for="address" class="control-label">Address</label>
                            <textarea class="form-control" name="address" required oninput="validateAddress(this)"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="status" class="control-label">Marital Status</label>
                            <select class="form-control" name="status" required>
                                <option value="single">Single</option>
                                <option value="married">Married</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="terms-of-service" name="terms_accepted" required>
                                <label class="custom-control-label" for="terms-of-service">
                                    I have read and agree to the <a href="#" data-toggle="modal" data-target="#termsModal">Terms of Service</a>
                                </label>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Sign Up</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

   
<!-- Add this Terms of Service Modal -->
<div class="modal fade" id="termsModal" tabindex="-1" role="dialog" aria-labelledby="termsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="termsModalLabel">Terms of Service</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6>1. Acceptance of Terms</h6>
                <p>By creating an account, you agree to these Terms of Service. Please read them carefully.</p>

                <h6>2. User Account</h6>
                <p>You are responsible for maintaining the confidentiality of your account and password. You agree to accept responsibility for all activities that occur under your account.</p>

                <h6>3. User Conduct</h6>
                <p>You agree not to use the service for any unlawful purposes or to violate any local, state, national, or international laws. Prohibited activities include, but are not limited to:</p>
                <ul>
                    <li>Harassment or abuse of other users</li>
                    <li>Spreading harmful or malicious content</li>
                    <li>Attempting to gain unauthorized access to system resources</li>
                </ul>

                <h6>4. Privacy</h6>
                <p>Your use of the service is also governed by our Privacy Policy. We collect and use personal information as described in that policy.</p>

                <h6>5. Intellectual Property</h6>
                <p>All content on this platform is protected by intellectual property laws. Users may not reproduce, distribute, or create derivative works without explicit permission.</p>

                <h6>6. Limitation of Liability</h6>
                <p>We are not liable for any direct, indirect, incidental, special, or consequential damages resulting from your use of the service.</p>

                <h6>7. Modifications to Terms</h6>
                <p>We reserve the right to modify these terms at any time. Continued use of the service after changes constitutes acceptance of the new terms.</p>

                <h6>8. Termination</h6>
                <p>We may terminate or suspend your account at our discretion, with or without notice, for conduct that we believe violates these terms or is harmful to other users.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

    <center><div class="row mb-4">
        <a href="#" class="btn-link float-end" data-toggle="modal" data-target="#forgotPasswordModal">Forgot Password?</a>
    </div></center>

    <!-- Forgot Password Modal -->
    <div class="modal fade" id="forgotPasswordModal" tabindex="-1" role="dialog"
        aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="forgotPasswordModalLabel">Reset Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="forgot-password-form" action="classes/reset_password.php" method="POST">
                        <div class="form-group">
                            <label for="reset-email" class="control-label">Enter your email address</label>
                            <input type="email" class="form-control" name="email" id="reset-email" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Reset Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePasswordVisibility(fieldId, toggleButton) {
            const passwordField = document.getElementById(fieldId);
            const icon = toggleButton.querySelector('i');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        function validatePassword(input) {
            // Allow only alphabetic characters and numbers
            input.value = input.value.replace(/[^a-zA-Z0-9]/g, '');
        }

        function isStrongPassword(password) {
            const strongPasswordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/;
            return strongPasswordPattern.test(password);
        }

        function suggestStrongPassword() {
            const length = 12;
            const charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            let password = "";

            const categories = [
                "abcdefghijklmnopqrstuvwxyz",
                "ABCDEFGHIJKLMNOPQRSTUVWXYZ",
                "0123456789"
            ];

            categories.forEach(category => {
                password += category.charAt(Math.floor(Math.random() * category.length));
            });

            for (let i = password.length; i < length; ++i) {
                password += charset.charAt(Math.floor(Math.random() * charset.length));
            }

            password = password.split('').sort(() => 0.5 - Math.random()).join('');

            document.getElementById('signup-password').value = password;
        }

        function validateName(input) {
            // Allow only alphabetic characters and spaces
            input.value = input.value.replace(/[^a-zA-Z\s]/g, '');
        }

        function validateAddress(input) {
            // Allow only alphabetic characters, numbers, and spaces
            input.value = input.value.replace(/[^a-zA-Z0-9\s]/g, '');
        }

        function validatePhoneNumber(input) {
            // Allow only numeric input
            input.value = input.value.replace(/[^0-9]/g, '');
        }

        document.getElementById('signup-form').addEventListener('submit', function (e) {
            e.preventDefault();

            const passwordField = document.getElementById('signup-password');
            const password = passwordField.value;

            if (!isStrongPassword(password)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Strong Password Required',
                    text: 'Please use a stronger password.',
                    position: 'center',
                    toast: true,    
                    showConfirmButton: false,
                    timer: 3000
                });
                return;
            }

            var formData = new FormData(this);
            formData.append('action', 'register');

            Swal.fire({
                html: 'Please wait while we create your account',
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                },
                position: 'center',
                toast: true,
                showConfirmButton: false
            });

            fetch('classes/register.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                Swal.close();
                if (data.success) {
                    const email = formData.get('email');
                    window.location.href = `verify_gmail.php?email=${encodeURIComponent(email)}`;
                } else {
                    Swal.fire({
                        icon: 'error',
                        text: data.message,
                        position: 'center',
                        toast: true,
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });
                }
            })
            .catch(error => {
                Swal.close();
                console.error('', error);
                Swal.fire({
                    icon: 'error',
                    text: 'An unexpected error occurred. Please try again.',
                    position: 'center',
                    toast: true,
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });
            });
        });

        document.getElementById('forgot-password-form').addEventListener('submit', function(e) {
            e.preventDefault();

            var formData = new FormData(this);

            Swal.fire({
                html: 'Please wait while we process your request',
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                },
                position: 'center',
                toast: true,
                showConfirmButton: false
            });

            fetch('forgot-password.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                Swal.close();
                Swal.fire({
                    icon: 'success',
                    text: data,
                    position: 'center',
                    toast: true,
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });
            })
            .catch(error => {
                Swal.close();
                console.error('', error);
                Swal.fire({
                    icon: 'error',
                    text: 'An unexpected error occurred. Please try again.',
                    position: 'center',
                    toast: true,
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });
            });
        });

        grecaptcha.ready(function () {
            grecaptcha.execute('6LfCPpMqAAAAANJD3dBADWW_bQgoZa5_SXfnrlvK', { action: 'submit' }).then(function (token) {
                document.getElementById('g-recaptcha-response').value = token;
            });
        });
    </script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <?php require_once('inc/footer.php'); ?>