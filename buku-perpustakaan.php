<?php
$bks = new Books(); // instansiasi obj
$categories = $bks->display_category();
$all_books = $bks->display_page_book();

$get_url_code = isset( $_GET['c'] ) ? anti_injection( $_GET['c'] ) : '';
$get_category_by_id = $bks->get_data_category_book_by_id( $get_url_code );
$the_category = $get_category_by_id->fetch( PDO::FETCH_ASSOC );
$get_category = $the_category ['kategori_nama'];
?>

<section class="content-2 content-books azz-section__container--first" id="features1-108" style="background-color: rgb(239, 239, 239);">
    <div class="container">
        <div class="row">
        	<div class="col-md-12" style="margin-bottom: 30px;">
        	<?php 
        	if ( ! isset( $_GET['c'] ) ) :
        		$filter_by = 'Semua Buku';
        	else :
        		$filter_by = $get_category;
        	endif;
        	?>
        	<i class="fa fa-bars"></i> Filter Berdasarkan: <a href="#menuCategories" data-toggle="modal" class="filter-books"><?= $filter_by; ?> <i class=" fa fa-angle-down"></i></a>
        	</div>
        </div>

		<?php
		$limit = 20;
		$position = '';
		$pg = isset( $_GET['pg'] ) ? anti_injection( $_GET['pg'] ) : '';

		if ( empty( $pg ) ) {
		    $position = 0;
		    $pg = 1;
		} else {
		    $position = ( $pg - 1 ) * $limit;
		}

		$book_based_category = $bks->display_page_book_based_category( $get_url_code );
		$all_books_with_pagination = $bks->display_page_book_with_pagination( $position, $limit );
		$book_based_category_with_pagination = $bks->display_page_book_based_category_with_pagination( $get_url_code, $position, $limit );
		?>

        <div id="azz-book" class="row" style="margin: 0;">
			<?php
			if ( ! isset( $_GET['c'] ) ) :
				foreach( $all_books_with_pagination as $book ) :
	                echo '<div class="book-list">';
	                	echo '<a href="?p=detail-buku&id='. $book['buku_id'] .'" alt="'. $book['buku_judul'] .'">';
	                    	echo '<img src="admin/images/books/'. $book['buku_cover'] .'" alt="'. $book['buku_judul'] .'">';
	                    	echo '<div class="overlay-book"></div>';
		                echo '</a>';
	                echo '</div>';
				endforeach;
			else :
				foreach( $book_based_category_with_pagination as $book ) :
	                echo '<div class="book-list">';
	                	echo '<a href="?p=detail-buku&id='. $book['buku_id'] .'" alt="'. $book['buku_judul'] .'">';
	                    	echo '<img src="admin/images/books/'. $book['buku_cover'] .'" alt="'. $book['buku_judul'] .'">';
	                    	echo '<div class="overlay-book"></div>';
		                echo '</a>';
	                echo '</div>';
				endforeach;
			endif;
			?>
        </div>

        <!--START: pagination -->
       	<div class="row" style="margin-top: 20px;">
			<div class="col-md-12">
                <div class="pagination-home text-center">
                    <?php
                    $get_category_based_url = '';
                    // Mengitung jumlah data
                    if ( ! isset( $_GET['c'] ) ) :
                       	$data_books = $all_books->rowCount(); // All book
                    else :
                        $data_books = $book_based_category->rowCount(); // Book based category
                        $get_category_based_url = '&c='. anti_injection( $get_url_code );
                    endif;

                    if ( empty( $data_books ) ) :
                        echo 'Not available books !';
                    endif;
                    
                    // Jumlah halaman
                    $JmlHalaman = ceil( $data_books / $limit );

                    // To first nav
                    $first = '';
                    if ( $pg > 1 ) {
                        $first .= '<a href="?p=buku-perpustakaan'. $get_category_based_url .'&pg=1"><span aria-hidden="true">«</span></a>';
                    } else {
                        $first .= '<li class="disabled"><a href="#">«</a></li>';
                    }
                     
                    // prev nav
                    $prev = '';
                    if ( $pg > 1 ) {
                        $link = $pg-1;
                        $prev .= '<a href="?p=buku-perpustakaan'. $get_category_based_url .'&pg='.$link.'"><span aria-hidden="true">‹</span></a>';
                    } else {
                        $prev .= '<li class="disabled"><a href="#">‹</a></li>';
                    }
                     
                    // Number of nav
                    $number = '';
                    for ( $i = 1; $i <= $JmlHalaman; $i++ ) {
                        if ( $i == $pg ) {
                            $number .= '<a class="active">'.$i.'</a>';
                        } else {
                            $number .='<a href="?p=buku-perpustakaan'. $get_category_based_url .'&pg='.$i.'">'.$i.'</a>';
                        }
                    }
                     
                    // Next nav
                    $next = '';
                    if ( $pg < $JmlHalaman ) {
                        $link = $pg + 1;
                        $next .= '<a href="?p=buku-perpustakaan'. $get_category_based_url .'&pg='.$link.'"><span aria-hidden="true">›</span></a>';
                    } else {
                        $next .= '<li class="disabled"><a href="#">›</a></li>';
                    }

                    // Last nav
                    $Last = '';
                    if ( $pg < $JmlHalaman ) {
                        $Last .= '<a href="?p=buku-perpustakaan'. $get_category_based_url .'&pg='.$JmlHalaman.'"><span aria-hidden="true">»</span></a>';
                    }  else {
                        $Last .= '<li class="disabled"><a href="#">»</a></li>';
                    }

					if ( ! empty( $data_books ) ) :
                        echo '<nav>';
                            echo '<ul class="pagination pagination-sm">';
                                echo '<li>'. $first .'</li>';
                                echo '<li>'. $prev .'</li>';
                                echo '<li>'. $number .'</li>';
                                echo '<li>'. $next .'</li>';
                                echo '<li>'. $Last .'</li>';
                            echo '</ul>';
                        echo '</nav>';
                   	endif;
                   	?>
                </div>
            </div>
        </div>
        <!-- END: pagination -->
    </div>
</section>

<!-- START: POP-UP MENU CATEGORIES -->
<div aria-hidden="true" aria-labelledby="menuCategoriesLabel" data-toggle="modal" role="dialog" tabindex="-1" id="menuCategories" class="modal fade" style="background: rgba(0,0,0,0.7);">
    <div class="modal-dialog modal-lg" style="margin-top: 150px;">
        <div class="modal-content modal-categories">
            <div class="modal-header">
                <button type="button" class="btn-close close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h3 class="modal-title">Filter Berdasarkan:</h3>
            </div>
            <div class="modal-body">
    			<ul class="all-books">
    				<?php if ( ! isset( $_GET['c'] ) ) : ?>
    					<li><a href="./?p=buku-perpustakaan" style="background: #098F56;" class="active">Semua Buku</a></li>
    				<?php else : ?>
    					<li><a href="./?p=buku-perpustakaan">Semua Buku</a></li>
    				<?php endif; ?>
    			</ul>
				<div class="clearfix"></div><hr style="margin: 10px 5px; border-top: 1px solid #28282B;">
    			<ul class="menu-categories">
    				<?php
    				 while( $loop_category = $categories->fetch( PDO::FETCH_ASSOC ) ) {
                        $kd_category = $loop_category['kategori_id'];
                        $nm_category = $loop_category['kategori_nama'];

                        if ( $kd_category == $get_url_code ) {
                            $acive = 'style="background: #098F56;" class="active"';
                        } else {
                            $acive = null;
                        }

                        echo '<li><a href="./?p=buku-perpustakaan&c='. $kd_category .'"'. $acive .'>'. $nm_category .'</a></li>';
                    }
                    ?>
    			</ul>
				<div class="clearfix"></div>
            </div> <!-- END: Class modal-body -->
        </div>
    </div>
</div>
<!-- END: POP-UP MENU CATEGORIES -->