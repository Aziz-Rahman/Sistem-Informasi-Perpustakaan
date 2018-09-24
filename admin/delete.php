<?php
/**
* -------------------------------------
* All Actions Delete Data
* -------------------------------------
*/

session_start();
include_once 'includes/class.php';

$bks = new Books();
$mb = new Member();
$brw = new Borrowing();
$adm = new Librarian();
$kas = new Kas();
$msg = new Messages();
$sdr = new Slider();

/**
* -------------------------------------
* MENGHAPUS DATA PETUGAS PERPUSTAKAAN
* -------------------------------------
*/
if ( isset( $_GET['del_adm'] ) ) :
	// MENGAMBIL GABMAR COVER SEBELUM DIHAPUS
	$get_photo = $adm->get_photo_librarian_by_id( $_GET['del_adm'] );
 	$photo_adm = $get_photo->fetch( PDO::FETCH_ASSOC );

	// Menghapus file gb di directory
	$img1_dir = 'images/users/'.$photo_adm['foto'];
	if ( file_exists( $img1_dir ) AND ( ! empty( $photo_adm['foto' ] ) ) ) { // check if file exists and available in database
		unlink( $img1_dir );
	}
	// MELAKUKAN AKSI DELETE DATA
	$delete = $adm->delete_librarian( $_GET['del_adm'] );
	if ( $delete ) {
		echo "<script>alert( 'Data berhasil dihapus !' ); location='./?p=petugas';</script>";
	} else {
		die ( 'Error !!' );
	}
endif;


/**
* -------------------------------------
* MENGHAPUS DATA KATEGORI
* -------------------------------------
*/
if ( isset( $_GET['del_cat'] ) ) :
	// $get_category_in_book = $bks->get_category_book( $_GET['del_cat'] );
	// $cat_book = mysql_fetch_assoc( $get_category_in_book );
	// $aaa = $cat_book['kategori_id' ];
	// $bbb = $_GET['del_cat'];
	// if ( $aaa === $bbb ) {
	// 	echo "<script>alert('Anda tidak dapat menghapus data ini, (kategori) ini sedang digunakan !'); location='./?p=category';</script>";
	// } else {
	$categories = $bks->delete_category( $_GET['del_cat'] );
	if ( $categories ) {
		echo "<script>location='./?p=kategori';</script>";
		$_SESSION['messages'] = '<div class="alert alert-success alert-dismissible" role="alert"><i class="fa fa-check"></i>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                Data berhasil dihapus.
                                </div>';
	} else {
		echo "<script>location='./?p=kategori';</script>";
        $_SESSION['messages'] = '<div class="alert alert-danger alert-dismissible" role="alert"><i class="fa fa-check"></i>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                Maaf, ada kesalahan dalam sistem kami.
                                </div>';
	}
endif;


/**
* -------------------------------------
* MENGHAPUS DATA BUKU
* -------------------------------------
*/
if ( isset( $_GET['del_bk'] ) ) :
	// MENGAMBIL GABMAR COVER SEBELUM DIHAPUS
	$get_cover = $bks->get_cover_book( $_GET['del_bk'] );
 	$cover_books = $get_cover->fetch( PDO::FETCH_ASSOC );

	// Menghapus file gb di directory
	$img1_dir = 'images/books/'.$cover_books['buku_cover'];
	if ( file_exists( $img1_dir ) AND ( ! empty( $cover_books['buku_cover' ] ) ) ) { // check if file exists and available in database
		unlink( $img1_dir );
	}
	// MELAKUKAN AKSI DELETE DATA
	$books = $bks->delete_book( $_GET['del_bk'] );
	if ( $books ) {
		echo "<script>alert( 'Data berhasil dihapus !' ); location='./?p=buku';</script>";
	} else {
		die ( 'Error !!' );
	}
endif;


/**
* -------------------------------------
* MENGHAPUS STATUS BUKU RUSAK / HILANG / DLL.
* -------------------------------------
*/
if ( isset( $_GET['stts_id'] ) ) :
	$get_stts_book_by_id = $bks->get_data_status_book_by_id( $_GET['stts_id'] ); // Ambil data
	$data = $get_stts_book_by_id->fetch( PDO::FETCH_ASSOC );
	$the_book = $data['buku_id'];
	$count_of_book = $data['buku_jumlah'] + 1; // Mengembalikan pengurangan stok buku

	$stts_book = $bks->delete_status_book( $_GET['stts_id'] );
	if ( $stts_book ) {
		// Menghapus data kas sesuai dg id status buku yg dihapus
		$kas->delete_kas_based_stts_book_id( $_GET['stts_id'] );

        // Update stok buku untuk mengembalikan jumlah / stok buku jika status buku rusak / hilang / dll. dihapus
        $bks->update_stock_book( $the_book, $count_of_book );

		echo "<script>location='./?p=data-status-buku';</script>";
		$_SESSION['messages'] = '<div class="alert alert-success alert-dismissible" role="alert"><i class="fa fa-check"></i>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                Data berhasil dihapus.
                                </div>';
	} else {
		echo "<script>location='./?p=data-status-buku';</script>";
		$_SESSION['messages'] = '<div class="alert alert-danger alert-dismissible" role="alert"><i class="fa fa-exclamation-triangle"></i>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                Maaf, ada kesalahan dalam sistem kami.
                                </div>';
	}
endif;


/**
* -------------------------------------
* MENGHAPUS DATA ANGGOTA
* -------------------------------------
*/
if ( isset( $_GET['del_mb'] ) ) :
	$member = $mb->delete_member( $_GET['del_mb'] );
	if ( $member ) {
		echo "<script>alert( 'Data berhasil dihapus !' ); location='./?p=anggota';</script>";
	} else {
		die ( 'Error !!' );
	}
endif;


/**
* -------------------------------------
* MENGHAPUS DATA PINJAMAN
* -------------------------------------
*/
if ( isset( $_GET['del_brw'] ) ) :
	$borrowing = $brw->delete_borrowing( $_GET['del_brw'] );
	if ( $borrowing ) {
		echo "<script>alert( 'Data berhasil dihapus !' ); location='./?p=peminjaman';</script>";
		$get_detail_borrowing_by_borowing_id = $brw->get_detail_borrowing_by_borowing_id( $_GET['del_brw'] ); // Ambil data detail peminjaman
		while ( $get_book_in_list_borrowing = $get_detail_borrowing_by_borowing_id->fetch( PDO::FETCH_ASSOC ) ) {
			$the_book = $get_book_in_list_borrowing['buku_id'];
			$borrowing_id = $get_book_in_list_borrowing['id_peminjaman'];
			// Proses membatalkan pengurangan stok buku
	        $count_of_book = $get_book_in_list_borrowing['buku_jumlah'] + 1;
	        // Update stok buku jika batal dipinjam
	        $bks->update_stock_book( $the_book, $count_of_book );
	    }
	    // Menghapus daftar list peminjaman buku berdasarkan id peminjaman
	    $brw->delete_detail_borrowing_by_borrowing_id( $borrowing_id );
	} else {
		die ( 'Error !!' );
	}
endif;


/**
* -------------------------------------
* MENGHAPUS DATA DETAIL / LIST PEMINJAMAN
* -------------------------------------
*/
if ( isset( $_GET['del_detail_brw'] ) ) :
	$get_detail_borrowing_by_id = $brw->get_detail_borrowing_by_id( $_GET['del_detail_brw'] ); // Ambil data detail peminjaman
	$get_book_in_list_borrowing = $get_detail_borrowing_by_id->fetch( PDO::FETCH_ASSOC );
	$the_book = $get_book_in_list_borrowing['buku_id'];

	$get_stock_book = $bks->get_stock_book( $the_book ); // ambil stock buku untuk membatalkan pengurangan stok jk data buku dihapus di list peminjaman
	$get_book_based_id = $get_stock_book->fetch( PDO::FETCH_ASSOC );

	$detail_borrowing = $brw->delete_detail_borrowing( $_GET['del_detail_brw'] );
	if ( $detail_borrowing ) {
		echo "<script>alert('Data berhasil dihapus.'); location='./?p=list-peminjaman';</script>";
		// Proses membatalkan pengurangan stok buku
        $count_of_book = $get_book_based_id['buku_jumlah'] + 1;
        // Update stok buku jika batal dipinjam
        $bks->update_stock_book( $the_book, $count_of_book );
	} else {
		die ( 'Error !!' );
	}
endif;


/**
* -------------------------------------
* MENGHAPUS PESAN ( INBOX )
* -------------------------------------
*/
if ( isset( $_GET['msg'] ) ) :
	$message = $msg->delete_message( $_GET['msg'] );
	if ( $message ) {
		echo "<script>location='./?p=pesan-masuk';</script>";
		$_SESSION['messages'] = '<div class="alert alert-success alert-dismissible" role="alert"><i class="fa fa-check"></i>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                Data berhasil dihapus.
                                </div>';
	} else {
		echo "<script>location='./?p=pesan-masuk';</script>";
		$_SESSION['messages'] = '<div class="alert alert-danger alert-dismissible" role="alert"><i class="fa fa-exclamation-triangle"></i>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                Maaf, ada kesalahan dalam sistem kami.
                                </div>';
	}
endif;


/**
* -------------------------------------
* MENGHAPUS Banner Slider
* -------------------------------------
*/
if ( isset( $_GET['slideshow'] ) ) :
	// Mengambil gambar banner sebelum dihapus
	$get_banner_img = $sdr->get_banner_img_by_id( $_GET['slideshow'] );
 	$banner_img = $get_banner_img->fetch( PDO::FETCH_ASSOC );

	// Menghapus file gb di directory
	$img1_dir = 'images/slideshow/'.$banner_img['gambar'];
	if ( file_exists( $img1_dir ) AND ( ! empty( $banner_img['gambar' ] ) ) ) { // check if file exists and available in database
		unlink( $img1_dir );
	}

	// Menghapus banner
	$slider = $sdr->delete_slider( $_GET['slideshow'] );
	if ( $slider ) {
		echo "<script>location='./?p=slideshow';</script>";
		$_SESSION['messages'] = '<div class="alert alert-success alert-dismissible" role="alert"><i class="fa fa-check"></i>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                Data berhasil dihapus.
                                </div>';
	} else {
		echo "<script>location='./?p=slideshow';</script>";
		$_SESSION['messages'] = '<div class="alert alert-danger alert-dismissible" role="alert"><i class="fa fa-exclamation-triangle"></i>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                Maaf, ada kesalahan dalam sistem kami.
                                </div>';
	}
endif;