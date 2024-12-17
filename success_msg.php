<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success Modal</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .modal-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            z-index: 2000;
            width: 100vw;
            height: 100vh;
            background-color: #000;
            opacity: 0.5;
        }
    </style>
</head>
<body>
    <!-- Modal -->
    <div class="modal fade show" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true" style="display: block;">
        <div class="modal-backdrop"></div>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center p-5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="green" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mx-auto mb-4">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                    <h2 class="mb-3 text-success">Success!</h2>
                    <p class="text-muted mb-4">
                        Your Request Has Been Recorded. 
                        Please wait for confirmation from the management.
                    </p>
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('successModal');
            
            // Auto-close after 3 seconds
            setTimeout(() => {
                // Use Bootstrap's modal method to hide
                var bsModal = new bootstrap.Modal(modal);
                bsModal.hide();
            }, 3000);

            // Ensure close button works
            const closeButtons = modal.querySelectorAll('[data-bs-dismiss="modal"]');
            closeButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    // Use Bootstrap's modal method to hide
                    var bsModal = new bootstrap.Modal(modal);
                    bsModal.hide();
                });
            });
        });
    </script>
</body>
</html>