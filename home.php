<?php 
require_once('config.php');
session_start(); // Start the session to access session variables

$qry = $conn->query("SELECT * FROM `daily_verses` where `display_date` = '".date('Y-m-d')."' ");
if($qry->num_rows > 0){
    foreach($qry->fetch_array() as $k => $v){
        if(!is_numeric($k))
            $dv[$k] = $v;
    }
}
?>

<style>
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
        word-wrap: break-word;
        white-space: normal;
    }
    @media (max-width: 768px) {
        #main-header {
            height: 60vh;
        }
        #main-header h1 {
            font-size: 2rem;
        }
        #main-header p {
            font-size: 1rem;
        }
        .container {
            padding-left: 10px;
            padding-right: 10px;
        }
        .recent-blog-img {
            max-width: 100%;
            height: auto;
        }
        .row.gx-4 {
            flex-direction: column;
        }
        .col-md-8, .col-md-4 {
            width: 100%;
            margin-bottom: 20px;
        }
        .col-md-4 {
            padding-left: 0 !important;
        }
        .border-start {
            border-left: none;
            border-top: 1px solid #ddd;
        }
        .truncate-1 {
            font-size: 0.9rem;
        }
    }
    @media (max-width: 480px) {
        #main-header h1 {
            font-size: 1.5rem;
        }
        #main-header p {
            font-size: 0.9rem;
        }
        .truncate-1 {
            overflow: hidden;
            word-wrap: break-word;
            white-space: normal;
        }
    }
</style>

<?php
// Include this at the top of your main PHP file
if (isset($_SESSION['login_success'])) {
    echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Login Successful',
            text: 'Welcome back!',
            position: 'center',
            toast: true,
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });
    </script>";
    unset($_SESSION['login_success']); // Clear the session variable
}

?>

<?php if (isset($_SESSION['logout_success'])): ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Logout Successful',
            text: 'You have been logged out.',
            position: 'center',
            toast: true,
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });
    </script>
    <?php unset($_SESSION['logout_success']); // Clear the session variable ?>
<?php endif; ?>
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
           <div class="col-md-4 col-12 border-start">
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
                       <small class="truncate-1 text-muted"><?php echo $row['meta_description'] ?></small>
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