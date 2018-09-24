<?php
include_once 'admin/includes/functions.php';
include_once 'admin/includes/class.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
    <meta name="description" content="Perpustakan Online">
    <title>Perpustakaan Nusantara</title>
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:700,400&amp;subset=cyrillic,latin,greek,vietnamese"> -->
    <link rel="stylesheet" href="assets/fonts/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/justifiedGallery.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="assets/animate.css/animate.min.css"> -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/slider.css">
    <link rel="stylesheet" href="assets/css/gallery.css">
</head>
<body>

    <?php 
    include 'includes/navbar-top.php';
    include 'search-form.php';

    $searchBooks = isset( $_GET['s'] ) ? $_GET['s'] : '';
    $page = isset( $_GET['p'] ) ? $_GET['p'] : '';
    if ( $page == "" ) :
        include 'includes/slideshow.php';
    else :
        include 'includes/page-header.php';
    endif;

    include 'includes/load-pages.php';
    ?>

    <section class="azz-section azz-section--relative azz-section--fixed-size" id="contacts2-36" style="background-color: rgb(48, 48, 49);">
        <div class="azz-section__container container">
            <div class="azz-contacts azz-contacts--wysiwyg row">
                <div class="col-md-4">
                    <div class="azz-footer-title"><strong>ADDRESS</strong></div>
                    Jl. Mawar Berduri No. 31 Blok D2 <br>
                    Cengkareng, Jakarta Barat. <br>

                   
                </div>
                <div class="col-md-4">
                     <div class="azz-footer-title"><strong> CONTACT</strong></div>
                        Email: arman@gmail.com<br>
                        Phone: (021) 899 31599<br>
                        Fax: +1 (0) 990 0000 00277
                </div>
               <div class="col-md-4">
                <div class="azz-footer-title"><strong>FOLLOW US</strong></div>
                    <div class="social-buttons">
                        <a class="social-icons icon-facebook" title="Facebook" href="#"><i class="fa fa-facebook"></i></a> 
                        <a class="social-icons icon-google" title="Google+" href="#"><i class="fa fa-google-plus"></i></a>
                        <a class="social-icons icon-twitter" title="Twitter" href="#"><i class="fa fa-twitter"></i></a>
                        <a class="social-icons icon-pinterest" title="Pinterest" href="#"><i class="fa fa-pinterest"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="azz-section copyright" id="footer1-37" style="background-color: #2c2c2c;">
        <div class="azz-section__container container">
            <div class="azz-footer azz-footer--wysiwyg row">
                <div class="col-sm-12">
                    <p class="azz-footer__copyright"></p><p>Copyright <?php echo '© '. date('Y') ?> Perpustakaan Nusantara.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.justifiedGallery.min.js"></script>
    <script src="assets/js/jquery.nicescroll.min.js"></script>
    <script src="assets/js/jarallax.js"></script>
    <script src="assets/js/script.js"></script>
    <script src="assets/js/functions.js"></script>
  
</body>
</html>