<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Navbar with Donation Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .scanning-progress {
            margin-top: 10px;
            padding: 10px;
            background-color: #f8f9fa;
            border-radius: 4px;
            font-size: 14px;
        }

        .progress {
            height: 4px;
            margin-top: 5px;
        }

        .spinner-wrapper {
            display: inline-block;
            margin-right: 8px;
        }

        /* Ensures the QR code is centered within the modal */
        #qrCode {
            width: 250px;
            height: 250px;
            margin: 0 auto;
            text-align: center;
        }

        /* Modal Customizations */
        .modal-content {
            border-radius: 10px;
        }

        #main-header:before {
            background-image: url("<?php echo validate_image((isset($dv['image_path']) && !empty($dv['image_path'])) ? $dv['image_path'] : $_settings->info('cover')) ?>");
            background-size: cover;
            background-position: center;
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: -1;
        }
        #main-header {
            height: 83vh;
            font-family: 'Brush Script MT', 'Brush Script Std', cursive;
            text-shadow: 5px 5px #9e73734d;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            color: #fff;
            text-align: center;
        }
        .recent-blog-img {
            transition: transform 0.3s ease-in-out;
            width: 100%;
            height: auto;
        }
        .recent-blog-img:hover {
            transform: scale(1.1);
        }
        .truncate-1 {
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .word-wrap {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: normal; /* Allow text to wrap */
        }

        /* Media Query for Small Screens */
        @media (max-width: 768px) {
            #main-header {
                height: 60vh;
            }
            #main-header h1 {
                font-size: 2rem; /* Reduce font size on small screens */
            }
            #main-header p {
                font-size: 1rem; /* Adjust verse source text size */
            }
            .container {
                padding-left: 10px;
                padding-right: 10px;
            }
            .recent-blog-img {
                max-width: 100%; /* Ensure images fit within their container */
                height: auto;
            }
            .row.gx-4 {
                flex-direction: column; /* Stack the blogs and content on small screens */
            }
            .col-md-8, .col-md-4 {
                width: 100%; /* Ensure both columns take full width on smaller screens */
                margin-bottom: 20px;
            }
            .col-md-4 {
                /* Ensures the blog section becomes full-width on small screens */
                padding-left: 0 !important;
            }
            .border-start {
                border-left: none;
                border-top: 1px solid #ddd;
            }
            .truncate-1 {
                font-size: 0.9rem; /* Reduce font size for mobile view */
            }
        }

        /* For very small devices */
        @media (max-width: 480px) {
            #main-header h1 {
                font-size: 1.5rem; /* Make the title smaller on very small screens */
            }
            #main-header p {
                font-size: 0.9rem; /* Reduce the font size of the verse attribution */
            }
        }
    </style>
</head>
<body>

<!-- Include session management -->
<?php 
include 'session.php'; 
$qry = $conn->query("SELECT * FROM `daily_verses` where `display_date` = '".date('Y-m-d')."' ");
if($qry->num_rows > 0){
    foreach($qry->fetch_array() as $k => $v){
        if(!is_numeric($k))
            $dv[$k] = $v;
    }
}
?>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
        <button class="navbar-toggler btn btn-sm" type="button" id="navbarToggler" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="<?php echo base_url ?>">
            <img src="uploads/mary.jpg" width="30" height="30" class="d-inline-block align-top" alt="Logo" style="margin-left: 25px;">
            IMMACULATE CONCEPTION
        </a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="nav-link" href="<?php echo base_url ?>">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo base_url ?>?p=events">Events</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" aria-expanded="false">Topics</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="/articles/t/1">Topic 1</a></li>
                        <li><a class="dropdown-item" href="/articles/t/2">Topic 2</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link" href="<?php echo base_url ?>?p=schedule">Schedule</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo base_url ?>?p=about">About Us</a></li>
            </ul>
            <div class="d-flex align-items-center">
                <?php if (isset($_SESSION['user_id']) && isset($_SESSION['name'])): ?>
                    <div class="dropdown">
                        <a class="d-flex align-items-center text-decoration-none dropdown-toggle" href="#" id="userDropdown" role="button" aria-expanded="false">
                            <span class="user-name ms-2">Hi, <?php echo htmlspecialchars($_SESSION['name']); ?>!</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="<?php echo base_url ?>?p=profile">Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        </ul>
                    </div>
                <?php else: ?>
                    <a href="login.php" class="btn btn-primary btn-sm">Login</a>
                    <a href="./admin/" class="btn btn-primary btn-sm ms-3">Admin Login</a>
                <?php endif; ?>
                <button id="donation" class="btn btn-success btn-sm ms-3">Donate</button>
            </div>
        </div>
    </div>
</nav>

<!-- Header-->
<header class="bg-dark py-5 d-flex align-items-center" id="main-header">
    <div class="container px-4 px-lg-5 my-5 w-100">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder"><?php echo isset($dv['verse']) ? '"' . $dv['verse'] . '"' : $_settings->info('home_quote') ?></h1>
            <p class="lead fw-normal text-white-50 mb-0"><?php echo isset($dv['verse_from']) ? $dv['verse_from'] : "" ?></p>
        </div>
    </div>
</header>

<!-- Section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
       <div class="row gx-4 gx-lg-5">
           <div class="col-md-8 mb-4">
               <h2><b>Welcome to <?php echo $_settings->info('name') ?></b></h2>
               <hr>
               <?php include('welcome_content.html') ?>
           </div>
           <div class="col-md-4 col-12 border-start"> <!-- Adjusted for mobile responsiveness -->
               <h4><b>Recent Blogs</b></h4>
               <hr>
               <?php 
                $qry_blogs = $conn->query("SELECT * FROM `blogs` WHERE `status` = 1 ORDER BY unix_timestamp(`date_created`) DESC LIMIT 10");
                while($row = $qry_blogs->fetch_assoc()):
               ?>
               <a href="<?php echo base_url . $row['blog_url'] ?>" class="w-100 d-flex text-decoration-none bg-light bg-gradient rounded-1 border-light border mb-3 p-2">
                   <div class="me-3">
                       <img src="<?php echo validate_image($row['banner_path']) ?>" alt="Blog Image" class="img-thumbnail recent-blog-img">
                   </div>
                   <div class="flex-grow-1">
                       <p class="truncate-1 fw-bold mb-1"><?php echo $row['title'] ?></p>
                       <small class="word-wrap text-muted"><?php echo $row['meta_description'] ?></small>
                   </div>
               </a>
               <?php endwhile; ?>
               <?php if($qry_blogs->num_rows <= 0): ?>
                   <div class="text-center"><small><i>No data listed yet.</i></small></div>
               <?php endif; ?>
           </div>
       </div>
    </div>
</section>

<!-- Donation Modal -->
<div class="modal fade" id="donationModal" tabindex="-1" aria-labelledby="donationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="donationModalLabel">Donation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="donation-form">
                    <div class="mb-3 text-center">
                        <p id="scanText" class="text-primary" style="cursor: pointer;">SCAN ME</p>
                        <img id="qrCode" src="qr_code.jpg" alt="QR Code" class="d-none">
                    </div>
                    <div class="mb-3">
                        <label for="gcashReceipt" class="form-label">Upload GCASH Receipt</label>
                        <input type="file" class="form-control" id="gcashReceipt" accept="image/*">
                        <div id="scanningIndicator" class="d-none"></div>
                    </div>
                    <div class="mb-3">
                        <label for="donorName" class="form-label">Donor Name</label>
                        <input type="text" class="form-control" id="donorName" placeholder="Enter your name" required>
                    </div>
                    <div class="mb-3">
                        <label for="donorEmail" class="form-label">Donor Email</label>
                        <input type="email" class="form-control" id="donorEmail" placeholder="Enter your email" required>
                    </div>
                    <div class="mb-3">
                        <label for="donationAmount" class="form-label">Donation Amount</label>
                        <input type="number" class="form-control" id="donationAmount" placeholder="Enter your donation amount" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="refNo" class="form-label">Ref No.</label>
                        <input type="text" class="form-control" id="refNo" placeholder="Enter your donation reference number" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="donorMessage" class="form-label">Message (optional)</label>
                        <textarea class="form-control" id="donorMessage" rows="3" placeholder="Enter your message"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="donate-btn">Donate</button>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/tesseract.js/2.1.1/tesseract.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const navbarToggler = document.getElementById('navbarToggler');
        const navbarCollapse = document.getElementById('navbarSupportedContent');
        const donationButton = document.getElementById('donation');
        const donationModal = new bootstrap.Modal(document.getElementById('donationModal'));
        const scanText = document.getElementById('scanText');
        const qrCode = document.getElementById('qrCode');
        const gcashReceipt = document.getElementById('gcashReceipt');
        const scanningIndicator = document.getElementById('scanningIndicator');
        const donateBtn = document.getElementById('donate-btn');
        let isScanning = false;

        // Toggle navbar on mobile
        navbarToggler.addEventListener('click', function() {
            navbarCollapse.classList.toggle('collapse');
        });

        // Show donation modal
        donationButton.addEventListener('click', function() {
            donationModal.show();
        });

        // Toggle QR code visibility
        scanText.addEventListener('click', function() {
            qrCode.classList.toggle('d-none');
        });

        // Reset form when modal is closed
        document.getElementById('donationModal').addEventListener('hidden.bs.modal', function() {
            document.getElementById('donation-form').reset();
            scanningIndicator.classList.add('d-none');
            isScanning = false;
        });

        // Handle file upload and OCR scanning
        gcashReceipt.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                scanningIndicator.classList.remove('d-none');
                scanningIndicator.innerHTML = 'Scanning receipt...';
                Tesseract.recognize(file, 'eng', { logger: m => scanningIndicator.innerHTML = `Scanning: ${Math.round(m.progress * 100)}%` })
                    .then(({ data: { text } }) => {
                        scanningIndicator.innerHTML = 'Scan complete!';
                        processReceiptText(text);
                    })
                    .catch(err => {
                        scanningIndicator.innerHTML = 'Error during scanning.';
                        console.error(err);
                    });
            }
        });

        // Process OCR result and extract information
        function processReceiptText(text) {
            const amountRegex = /\b(?:Amount|Total)[^\d]*(\d+\.\d{2})/;
            const refRegex = /\b(?:Ref|Reference)[^\d]*(\d+)/;
            const amountMatch = text.match(amountRegex);
            const refMatch = text.match(refRegex);

            if (amountMatch) {
                document.getElementById('donationAmount').value = amountMatch[1];
            }

            if (refMatch) {
                document.getElementById('refNo').value = refMatch[1];
            }
        }

        // Handle donation button click
        donateBtn.addEventListener('click', function() {
            alert('Donation process initiated!');
            donationModal.hide();
        });

        // Toggle user dropdown menu
        const userDropdown = document.getElementById('userDropdown');
        const dropdownMenu = userDropdown.nextElementSibling;

        userDropdown.addEventListener('click', function(e) {
            e.preventDefault(); // Prevent default link behavior
            dropdownMenu.classList.toggle('show');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!userDropdown.contains(e.target) && !dropdownMenu.contains(e.target)) {
                dropdownMenu.classList.remove('show');
            }
        });
    });
</script>

</body>
</html>