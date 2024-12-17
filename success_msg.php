<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success Modal</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        #uni_modal .modal-footer, 
        #uni_modal .modal-header {
            display: none !important;
        }
    </style>
</head>
<body>
    <div id="uni_modal" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container-fluid">
                    <p>Your Request is successfully sent. Please wait for the confirmation as soon as the management sees your request. Thank You and God Bless :)</p>
                    <div class="row justify-content-end">
                        <div class="col-auto">
                            <button class="btn btn-sm btn-flat btn-light" type="button" data-dismiss="modal" id="closeModalBtn">Close</button>
                        </div>
                    </div>
                    <div class="container">
                        <h4>Success!</h4>
                        <p>Your Request Has Been Recorded.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const closeModalBtn = document.getElementById('closeModalBtn');

            // Function to redirect
            function redirectToSchedule() {
                window.location.href = 'https://icpmadridejos.com/?p=schedule';
            }

            // Auto-close and redirect after 3 seconds
            setTimeout(() => {
                redirectToSchedule();
            }, 3000);

            // Close modal and redirect when button is clicked
            closeModalBtn.addEventListener('click', function() {
                redirectToSchedule();
            });
        });
    </script>
</body>
</html>