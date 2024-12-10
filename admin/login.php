<!DOCTYPE html>
<html lang="en" style="height: auto;">

<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<?php require_once('../config.php'); ?>
<?php require_once('inc/header.php'); ?>

<style>
  /* Custom Styles for Login */
  body {
    background-color: #343a40;
    background: linear-gradient(45deg, #343a40, #007bff, #343a40, #007bff);
    background-size: 400% 400%;
    animation: gradientAnimation 15s ease infinite;
  }

  @keyframes gradientAnimation {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
  }

  .login-box {
    width: 100%;
    max-width: 360px;
    margin: 7% auto;
    animation: loginBoxAnimation 2s ease-out;
  }

  @keyframes loginBoxAnimation {
    0% { opacity: 0; transform: translateY(-50px) scale(0.8); }
    50% { opacity: 0.5; transform: translateY(0) scale(1.05); }
    100% { opacity: 1; transform: translateY(0) scale(1); }
  }
</style>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="./" class="h1"><b>Login</b></a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form id="login-frm" action="login_action.php" method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="form-check mb-3">
            <input type="checkbox" class="form-check-input" id="show-password">
            <label class="form-check-label" for="show-password">Show Password</label>
          </div>
          <div class="row">
            <div class="col-8">
              <a href="<?php echo base_url; ?>">Go to Website</a>
            </div>
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- External Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    // Show/Hide Password Toggle
    document.getElementById('show-password').addEventListener('change', function () {
      const passwordField = document.getElementById('password');
      passwordField.type = this.checked ? 'text' : 'password';
    });

    $(document).ready(function () {
  $('#login-frm').on('submit', function (e) {
    e.preventDefault();  // Prevent form submission from reloading the page

    $.ajax({
      url: 'login_action.php',
      type: 'POST',
      data: $(this).serialize(),
      dataType: 'json',
      beforeSend: function () {
        Swal.fire({
          title: "Logging In...",
          text: "Please wait while we log you in.",
          allowOutsideClick: false,
          showConfirmButton: false,
          willOpen: () => {
            Swal.showLoading(); // Show loading animation
          }
        });
      },
      success: function (response) {
        Swal.close(); // Close loading alert

        if (response.status === "success") {
          Swal.fire({
            icon: "success",
            title: "Success!",
            text: response.message,
            timer: 2000,
            showConfirmButton: false
          }).then(() => {
            window.location.href = response.redirect;
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Error!",
            text: response.message,
            timer: 2000,
            showConfirmButton: false
          });
        }
      },
      error: function () {
        Swal.close(); // Close loading alert
        Swal.fire({
          icon: "error",
          title: "Error!",
          text: "Something went wrong. Please try again later.",
          timer: 2000,
          showConfirmButton: false
        });
      }
    });
  });
});
  </script>
</body>
</html>
