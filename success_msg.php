<?php
// success_modal.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success Modal</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .success-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }
        .success-modal-content {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            text-align: center;
            max-width: 500px;
            width: 90%;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="success-modal" id="successModal">
        <div class="success-modal-content">
            <div class="text-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="green" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mx-auto mb-4">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
                <h2 class="mb-3 text-success">Success!</h2>
                <p class="text-muted mb-4">
                    Your Request Has Been Recorded. 
                    Please wait for confirmation from the management.
                </p>
                <button id="closeModal" class="btn btn-success">Close</button>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
    <script>
        // Auto-close functionality
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('successModal');
            const closeBtn = document.getElementById('closeModal');

            // Auto-close after 3 seconds
            setTimeout(() => {
                modal.style.display = 'none';
            }, 3000);

            // Manual close
            closeBtn.addEventListener('click', function() {
                modal.style.display = 'none';
            });
        });
    </script>
</body>
</html>