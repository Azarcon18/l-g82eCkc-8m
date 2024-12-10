<?php require_once('config.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $recaptchaSecret = '6LfCPpMqAAAAAE4pB5LZP4P_TUqHsKnnt3J465OP'; // Replace with your secret key
    $recaptchaResponse = $_POST['g-recaptcha-response']; // User's response token

    // Verify reCAPTCHA with Google
    $verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$recaptchaSecret}&response={$recaptchaResponse}");
    $response = json_decode($verify);

    // Check if reCAPTCHA validation is successful
    if (!$response->success || $response->score < 0.5) { // Adjust the score threshold as needed
        die('reCAPTCHA verification failed. Please try again.');
    }

    // Proceed with login/signup logic here
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
    <script src="https://www.google.com/recaptcha/api.js" async defer></script> <!-- Correct reCAPTCHA script -->
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
    <input 
        type="text" 
        class="form-control" 
        id="name" 
        name="name" 
        pattern="^[A-Za-z\s'-]+$" 
        title="Please enter only letters, spaces, hyphens, and apostrophes" 
        required 
        oninput="sanitizeName(this)"
    >
</div>
<div class="form-group">
    <label for="name" class="control-label">User name</label>
    <input 
        type="text" 
        class="form-control" 
        id="name" 
        name="name" 
        pattern="^[A-Za-z\s'-]+$" 
        title="Please enter only letters, spaces, hyphens, and apostrophes" 
        required 
        oninput="sanitizeName(this)"
    >
</div>
                        <div class="form-group">
                            <label for="email" class="control-label">Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="form-group">
    <label for="password" class="control-label">Password</label>
    <div class="input-group">
        <input type="password" class="form-control form" id="signup-password" name="password" required 
            oninput="sanitizeInput(this)">
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="button" 
                onclick="togglePasswordVisibility('signup-password', this)">
                <i class="fa fa-eye"></i>
            </button>
        </div>
    </div>
</div>

                            <small><a href="#" onclick="suggestStrongPassword()">Suggest Strong Password</a></small>
                        </div>
                        <div class="form-group">
                            <label for="phone_no" class="control-label">Phone Number</label>
                            <input type="text" class="form-control" name="phone_no" required>
                        </div>
                        <div class="form-group">
                            <label for="address" class="control-label">Address</label>
                            <textarea class="form-control" name="address" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="status" class="control-label">Marital Status</label>
                            <select class="form-control" name="status" required>
                                <option value="single">Single</option>
                                <option value="married">Married</option>
                            </select>
                        </div>
                        <div class="g-recaptcha mb-3" data-sitekey="6LfCPpMqAAAAANJD3dBADWW_bQgoZa5_SXfnrlvK"></div>
                        <!-- Modify the existing signup form in the modal body -->
<div class="form-group">
    <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="terms-of-service" name="terms_accepted" required>
        <label class="custom-control-label" for="terms-of-service">
            I have read and agree to the <a href="#" data-toggle="modal" data-target="#termsModal">Terms of Service</a>
        </label>
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
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Sign Up</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <center><div class="row mb-4">
        <a href="#" class="btn-link float-end" data-toggle="modal" data-target="#forgotPasswordModal">Forgot
            Password?</a>
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
            // Define what constitutes a strong password
            const strongPasswordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
            return strongPasswordPattern.test(password);
        }

        function suggestStrongPassword() {
        const length = 12;
        const charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789@$!%*?&";
        let password = "";

        // Ensure the password contains at least one character from each category
        const categories = [
            "abcdefghijklmnopqrstuvwxyz", // Lowercase
            "ABCDEFGHIJKLMNOPQRSTUVWXYZ", // Uppercase
            "0123456789",                 // Numbers
            "@$!%*?&"                     // Special characters
        ];

        // Add one character from each category to ensure diversity
        categories.forEach(category => {
            password += category.charAt(Math.floor(Math.random() * category.length));
        });

        // Fill the rest of the password length with random characters from the charset
        for (let i = password.length; i < length; ++i) {
            password += charset.charAt(Math.floor(Math.random() * charset.length));
        }

        // Shuffle the password to ensure randomness
        password = password.split('').sort(() => 0.5 - Math.random()).join('');

        document.getElementById('signup-password').value = password;
        }

        document.getElementById('signup-form').addEventListener('submit', function (e) {
            e.preventDefault();

            const passwordField = document.getElementById('signup-password');
            const password = passwordField.value;

            // Check if the password is strong
            if (!isStrongPassword(password)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Strong Password Required',
                    text: 'Please use a stronger password.',
                    position: 'top-end',
                    toast: true,
                    showConfirmButton: false,
                    timer: 3000
                });
                return;
            }

            // Get reCAPTCHA response
            var recaptchaResponse = grecaptcha.getResponse();
            if (recaptchaResponse.length === 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'reCAPTCHA Error',
                    text: 'Please complete the reCAPTCHA verification.',
                    position: 'top-end',
                    toast: true,
                    showConfirmButton: false,
                    timer: 3000
                });
                return;
            }

            var formData = new FormData(this);
            formData.append('action', 'register');
            formData.append('g-recaptcha-response', recaptchaResponse);

            // Show loading alert
            Swal.fire({
                title: 'Processing...',
                html: 'Please wait while we create your account',
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                },
                position: 'top-end',
                toast: true,
                showConfirmButton: false
            });

            fetch('classes/register.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                // Close loading alert
                Swal.close();
                if (data.success) {
                    // Redirect to verify_gmail.php with email as a query parameter
                    const email = formData.get('email');
                    window.location.href = `verify_gmail.php?email=${encodeURIComponent(email)}`;
                } else {
                    Swal.fire({
                        icon: 'error',
                        text: data.message,
                        position: 'top-end',
                        toast: true,
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });
                }
            })
            .catch(error => {
                // Close loading alert
                Swal.close();
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An unexpected error occurred. Please try again.',
                    position: 'top-end',
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

            // Show loading alert
            Swal.fire({
                title: 'Processing...',
                html: 'Please wait while we process your request',
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                },
                position: 'top-end',
                toast: true,
                showConfirmButton: false
            });

            fetch('forgot-password.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                // Close loading alert
                Swal.close();
                Swal.fire({
                    icon: 'success',
                    title: 'Email Sent',
                    text: data,
                    position: 'top-end',
                    toast: true,
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });
            })
            .catch(error => {
                // Close loading alert
                Swal.close();
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An unexpected error occurred. Please try again.',
                    position: 'top-end',
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
    <script>
function sanitizeName(input) {
    // Remove any characters that are not letters, spaces, hyphens, or apostrophes
    input.value = input.value.replace(/[^A-Za-z\s'-]/g, '');
    
    // Limit length to prevent extremely long inputs
    input.value = input.value.substring(0, 50);
    
    // Ensure first character is uppercase
    input.value = input.value.charAt(0).toUpperCase() + input.value.slice(1);
}

// Server-side validation example (pseudocode)
function validateNameServer(name) {
    // Regex to match only letters, spaces, hyphens, and apostrophes
    const nameRegex = /^[A-Za-z\s'-]+$/;
    
    // Check if name matches the regex and is within length limits
    if (nameRegex.test(name) && name.length >= 2 && name.length <= 50) {
        return true; // Valid name
    }
    
    return false; // Invalid name
}
function sanitizeInput(input) {
    // Allow only letters and numbers, remove symbols
    input.value = input.value.replace(/[^a-zA-Z0-9]/g, '');
}

function togglePasswordVisibility(fieldId, toggleBtn) {
    const passwordField = document.getElementById(fieldId);
    const icon = toggleBtn.querySelector("i");

    if (passwordField.type === "password") {
        passwordField.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    } else {
        passwordField.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    }
}
</script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <?php require_once('inc/footer.php'); ?>