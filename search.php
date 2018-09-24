<?php
include_once 'admin/includes/functions.php';
include_once 'admin/includes/class.php';
$page = isset( $_GET['p'] ) ? $_GET['p'] : '';
$search = isset( $_GET['s'] ) ? anti_injection( $_GET['s'] ) : '';
$bks = new Books(); // instansiasi obj
$search_books = $bks->search_books( $search );
$my_search = $search_books->rowCount();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="assets/images/discover-mobile-350x350-16.png" type="image/x-icon">
    <meta name="description" content="Perpustakan Online">
    <title>Perpustakaan Nusantara</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:700,400&amp;subset=cyrillic,latin,greek,vietnamese">
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
    include 'includes/page-header.php';
    ?>

   	<section class="content-2 content-books" style="background-color: rgb(239, 239, 239);">
    	<div class="container">

			<?php 
				if ( $search == '' ) :
					echo '<div class="info-search"><h3 class="info-s"><i class="fa fa-search"></i> Pencarian: " "</h3></div>';
					echo '<div class="info-search"><span class="text-search">Silahkan masukan kata kunci pencarian Anda !</span></div>';
				else :
					echo '<div class="info-search"><h3 class="info-s"><i class="fa fa-search"></i> Pencarian: '.$search.'</h3></div>'; 

					if ( $my_search == 0 ) {
						echo '<div class="text-search">Hasil pencarian tidak ditemukan !</div>';
					} else {

						echo '<div class="row">';
							foreach( $search_books as $book ) :
								echo '<div class="col-md-12" style="margin-bottom: 30px;">';
									echo '<div class="book-cover col-md-2" style="padding-left: 0;">';
										echo '<a href="./?p=detail-buku&id='. $book['buku_id'] .'" alt="'. $book['buku_judul'] .'"><img src="admin/images/books/'. $book['buku_cover'] .'" width="100%" height="" alt="'. $book['buku_judul'] .'"></a>';
									echo '</div>';

									echo '<div class="book-info col-md-10">';
										echo '<a href="./?p=detail-buku&id='. $book['buku_id'] .'" alt="'. $book['buku_judul'] .'"><h3 class="the-title">'. $book['buku_judul'] .'</h3></a>';
										echo '<table>';
											echo '<tr>';
												echo '<td>Penulis</td>';
												echo '<td width="20" align="center">:</td>';
												echo '<td>'. $book['penulis'] .'</td>';
											echo '<tr>';
											echo '<tr>';
												echo '<td>Penerbit</td>';
												echo '<td width="20" align="center">:</td>';
												echo '<td>'. $book['penerbit'] .'</td>';
											echo '<tr>';
											echo '<tr>';
												echo '<td>Deskripsi Buku</td>';
												echo '<td width="20" align="center">:</td>';
												echo '<td>'. $book['buku_deskripsi'] .'</td>';
											echo '<tr>';
										echo '</table>';
									echo '</div>';
								echo '</div>';
							endforeach;
						echo '</div>';
					}
				endif; // END: Check empty data ?>

		</div> <!-- END: container -->
	</section> <!-- END: section -->

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
                        Fax: +1 (0) 990 0000 002
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
                    <p class="azz-footer__copyright"></p><p>Copyright (c) <?php echo date('Y') ?> Perpustakaan Nusantara.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.justifiedGallery.min.js"></script>
    <script src="assets/js/SmoothScroll.js"></script>
    <script src="assets/js/jarallax.js"></script>
    <script src="assets/js/script.js"></script>
    <script src="assets/js/functions.js"></script>
  
</body>
</html>