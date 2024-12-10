<?php 
  require_once('config.php');

?>
<!DOCTYPE html>
<html lang="en">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php require_once('inc/header.php') ?>
<body style="background-color: white;">
<?php if ($_settings->chk_flashdata('success')): ?>
  <script>
    alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
  </script>
<?php endif; ?>
<?php require_once('inc/topBarNav.php') ?>

<?php 
  $page = isset($_GET['p']) ? $_GET['p'] : 'home';  
  if (!file_exists($page . ".php") && !is_dir($page)) {
      include '404.html';
  } else {
      if (is_dir($page)) {
          include $page . '/index.php';
      } else {
          include $page . '.php';
      }
  }
?>

<?php require_once('inc/footer.php') ?>
  <div class="modal fade" id="confirm_modal" role='dialog'>
      <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
          <h5 class="modal-title">Confirmation</h5>
        </div>
        <div class="modal-body">
          <div id="delete_content"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id='confirm' onclick="">Continue</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </div>
      </div>
    </div>
    <div class="modal fade bg-gradient" id="uni_modal" role='dialog'>
      <div class="modal-dialog   rounded-0 modal-md modal-dialog-centered " role="document">
        <div class="modal-content  rounded-0">
          <div class="modal-header">
          <h5 class="modal-title"></h5>
        </div>
        <div class="modal-body">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="uni_modal_right" role='dialog'>
      <div class="modal-dialog  rounded-0 modal-full-height  modal-md" role="document">
        <div class="modal-content rounded-0">
          <div class="modal-header">
          <h5 class="modal-title"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="fa fa-arrow-right"></span>
          </button>
        </div>
        <div class="modal-body">
        </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="viewer_modal" role='dialog'>
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
                <button type="button" class="btn-close" data-dismiss="modal"><span class="fa fa-times"></span></button>
                <img src="" alt="">
        </div>
      </div>
    </div>
    <script>
      // Disable right-click context menu
      document.addEventListener('contextmenu', function(e) {
          e.preventDefault();
      });

      // Disable F12, Ctrl+Shift+I, Ctrl+U (common shortcuts for opening developer tools)
      document.addEventListener('keydown', function(e) {
          if (e.key === 'F12' || (e.ctrlKey && (e.key === 'i' || e.key === 'u'))) {
              e.preventDefault();
          }
      });
  </script>

  </body>
  </html>
