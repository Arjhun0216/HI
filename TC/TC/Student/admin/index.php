
<?php
ob_start();
$cn = mysqli_connect("localhost", "root", "1711104@gceb!!", "db_admission");
if (isset($_POST['generate'])) {
    include('tc.php'); // Include tc.php for PDF generation
    exit; // Stop further execution to prevent additional output
}
/*if (isset($_GET['generate'])) {
    if (isset($_GET['regno'])) { // Check if regno is set
        $regno = $_GET['regno'];
        // Fetch the data for the specified regno
        $query = "SELECT * FROM STUDENT WHERE regno='$regno'";
        $query_run = mysqli_query($cn, $query);
        
        if (mysqli_num_rows($query_run) > 0) {
            $row = mysqli_fetch_array($query_run);
            // Include the file responsible for PDF generation
            include('tc.php');
        } else {
            echo "No records found for the specified registration number.";
        }
    } else {
        echo "Registration number is not set.";
    }
    exit; // Stop further execution to prevent additional output
}*/
ob_end_clean();
?>
<!doctype html>
<html lang="en">

<head>
    <!--============================== Required meta tags ===========================-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--============================= Fonts =======================================-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100i,300,300i,400,700" rel="stylesheet">

    <!--============================= CSS =======================================-->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="style.css">

    <script src="assets/js/jquery-3.2.1.slim.min.js"></script>

    <title>GCEB TC</title>
    <link rel="shourtcut icon" type="image/png" href="assets/img/favicon.png">
</head>

<body>
<header class="header-area" >
    <div class="container-fluid"> <!-- Changed to container-fluid for full width -->
        <div class="row">
            <div class="col-md-12"> <!-- Full width column -->
                <div class="logo">
                    <a href="#">
                        <i class="fa"></i>
                        <span></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>


    <!--================= Header-area ======================-->
    <div class="header-are header-absoulate">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="logo">
                        <a href="">
                           

                            <span><span id="na"></span></span>
                        </a>
                    </div>
                </div>
    <!--================== Main menu-area ====================-->
                <div class="col-md-7">
                    <div class="main-menu">
                        <?php include('component/menu.php'); ?>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <!--======================= Slide-area =======================-->
    <div class="welcome-area">
        <div class="owl-carousel slider-content">
            <div class="single-slider-item slider-bg-1">
                <div class="slider-inner">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <!--=========================== Content-area ============================-->
    <div class="content-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <?php include ('component/controller.php'); ?>

                </div>
            </div>
        </div>
    </div>
    <!--========================== Footer-area ===============================-->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="widget">
                        <div class="logo">
                            <a href="">
                                <i class="fa fa-home"></i>
                                <span>GCEB</span>
                            </a>
                            <p> 

                                <br><i</i>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="widget">
                        <h3>Navigation</h3>
                        <div class="footer-menu">
                            <ul>
                                <li><a href="#">home</a></li>
                                <li><a href="?a=student_add">admission</a></li>
                                <li><a href="?a=view">students</a></li>
                               
                                <li><a href="#">contact us</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <h3>Contact Us</h3>
                    
                    <span class="social-icon">
                        <a href=""><i class="fa fa-facebook"></i></a>
                        <a href="https://gcebargur.ac.in/"><i class="fa fa-google-plus"></i></a>
                    </span>
                    
                </div>
                <p class="copy-right"> &copy;</p>
            </div>
        </div>
    </footer>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="assets/js/popper-1.12.9.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/main.js"></script>
    <div class="arrow-down" onclick="scrollDown()">
        &#x2193; <!-- Down arrow symbol -->
    </div>
    <script>
        function scrollDown() {
            window.scrollTo({
                top: document.body.scrollHeight,
                behavior: 'smooth'
            });
        }
    </script>
</body>

</html>
