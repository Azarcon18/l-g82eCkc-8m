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
        <input type="password" class="form-control form" id="signup-password" name="password" required>
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="button" onclick="togglePasswordVisibility('signup-password', this)">
                <i class="fa fa-eye"></i>
            </button>
        </div>
    </div>
    <!-- <small><a href="#" onclick="suggestStrongPassword()">Suggest Strong Password</a></small>-->

    <!-- Password Strength Bar -->
    <div class="mt-2">
        <progress id="password-strength-bar" value="0" max="100" style="width: 100%; height: 10px;"></progress>
        <small id="password-strength-text"></small>
    </div>
</div>

<script>
    function togglePasswordVisibility(id, button) {
        const passwordField = document.getElementById(id);
        const icon = button.querySelector('i');
        
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

    function suggestStrongPassword() {
        // Function to suggest a strong password (basic example)
        const passwordField = document.getElementById('signup-password');
        passwordField.value = 'StrongPassword123';
        updatePasswordStrength();
    }

    function updatePasswordStrength() {
        const password = document.getElementById('signup-password').value;
        const strengthBar = document.getElementById('password-strength-bar');
        const strengthText = document.getElementById('password-strength-text');
        let strength = 0;
        
        // Check for symbols
        if (/[^A-Za-z0-9]/.test(password)) {
            strengthText.textContent = 'Password cannot contain symbols!';
            strengthBar.value = 0;
            return;
        }

        // Length check
        if (password.length >= 8) strength += 25;

        // Uppercase letter check
        if (/[A-Z]/.test(password)) strength += 25;

        // Number check
        if (/[0-9]/.test(password)) strength += 25;

        // Mixed case (uppercase + lowercase)
        if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength += 25;

        // Update the progress bar and text
        strengthBar.value = strength;
        if (strength <= 25) {
            strengthText.textContent = 'Weak Password';
            strengthText.style.color = 'red';
        } else if (strength <= 50) {
            strengthText.textContent = 'Fair Password';
            strengthText.style.color = 'orange';
        } else if (strength <= 75) {
            strengthText.textContent = 'Good Password';
            strengthText.style.color = 'yellowgreen';
        } else {
            strengthText.textContent = 'Strong Password';
            strengthText.style.color = 'green';
        }
    }

    // Add event listener to update strength as user types
    document.getElementById('signup-password').addEventListener('input', updatePasswordStrength);
</script>

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
    
        <!-- Terms of Service Modal -->
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
                        <!-- Terms of Service content -->
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
    
            function isStrongPassword(password) {
                const strongPasswordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
                return strongPasswordPattern.test(password);
            }
    
            function suggestStrongPassword() {
                const length = 12;
                const charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789@$!%*?&";
                let password = "";
    
                const categories = [
                    "abcdefghijklmnopqrstuvwxyz",
                    "ABCDEFGHIJKLMNOPQRSTUVWXYZ",
                    "0123456789",
                    "@$!%*?&"
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