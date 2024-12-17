<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success Modal</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1050;
        }
        .modal-overlay .modal-dialog {
            z-index: 1060;
        }
    </style>
</head>
<body>
    <!-- Custom Modal Wrapper -->
    <div class="modal-overlay" id="modalOverlay">
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
                    <button type="button" class="btn btn-success" id="closeModalBtn">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modalOverlay = document.getElementById('modalOverlay');
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