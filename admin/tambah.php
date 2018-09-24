<?php  
/**
* -------------------------------------
* All Actions Add Data 
* -------------------------------------
*/

session_start();
require_once 'includes/functions.php';
include 'includes/class.php';
$adm = new Librarian();
$mb = new Member();
$bks = new Books();
$brw = new Borrowing();
$ks = new Kas();
$sdr = new Slider();

/**
* -------------------------------------
* TAMBAH PETUGAS PERPUS
* -------------------------------------
*/
if ( isset( $_POST['btn-add-librarian'] ) ) :
    $fullname = $_POST['fullname'];
    $gender = $_POST['gender'];
    $date_of_birth = $_POST['date_of_birth'];
    $place_of_birth = $_POST['place_of_birth'];
    $marital_status = $_POST['marital_status'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $librarian_status = $_POST['librarian_status'];

    // Photo
    $pass_photo = $_FILES['photo']['name'];
    if ( ! empty( $pass_photo ) ) {
        $files = end( explode( '.', $pass_photo ) );
        $file_name = $pass_photo;
        $file_ext = $files;
        $hash_name = 'admin_'. random_char( $file_name, 3 );
        $photo = $hash_name. ".$file_ext";
        $path1 = 'images/users/'.$photo;
    } else {
        $photo = '';
        $path1 = '';
    }

   if ( empty( $fullname ) || empty( $gender ) || empty( $date_of_birth ) || empty( $place_of_birth ) || empty( $marital_status ) || empty( $phone ) || empty( $email ) || empty( $address ) || empty( $username ) || empty( $password ) || empty( $librarian_status ) || empty( $pass_photo ) ) {
        echo "<script>location='./?p=petugas';</script>";
        $_SESSION['messages'] = '<div class="alert alert-danger alert-dismissible" role="alert"><i class="fa fa-exclamation-triangle"></i>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                               	Pengisian data harus lengkap dan benar, silahkan ulangi.
                                </div>';
    }
    elseif ( !preg_match( "/^[a-zA-Z ]*$/", $fullname ) ) {
		echo "<script>location='./?p=petugas';</script>";
        $_SESSION['messages'] = '<div class="alert alert-danger alert-dismissible" role="alert"><i class="fa fa-exclamation-triangle"></i>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                               	Nama tidak valid, silahkan ulangi.
                                </div>';
	}
    elseif ( ! is_numeric( $phone ) ) {
		echo "<script>location='./?p=petugas';</script>";
        $_SESSION['messages'] = '<div class="alert alert-danger alert-dismissible" role="alert"><i class="fa fa-exclamation-triangle"></i>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                               	No. Telp tidak valid, silahkan ulangi. Contoh: 081234234222
                                </div>';
	}
	elseif ( filter_var( $email, FILTER_VALIDATE_EMAIL) === false ) {
		echo "<script>location='./?p=petugas';</script>";
        $_SESSION['messages'] = '<div class="alert alert-danger alert-dismissible" role="alert"><i class="fa fa-exclamation-triangle"></i>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                               	Alamat email tidak valid !
                                </div>';
	}
    elseif ( strlen( $password ) < 8 ) {
        echo "<script>location='./?p=petugas';</script>";
        $_SESSION['messages'] = '<div class="alert alert-danger alert-dismissible" role="alert"><i class="fa fa-exclamation-triangle"></i>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                Panjang password minimal 8 karakter !
                                </div>';
    } else {
        $librarian = $adm->add_librarian( $fullname, $gender, $date_of_birth, $place_of_birth, $marital_status, $phone, $email, $address, $photo, $username, $password, $librarian_status );
        if ( $librarian ) {
	        move_uploaded_file( $_FILES['photo']['tmp_name'], $path1 ); // save img to directory
	        echo "<script>location='./?p=petugas';</script>";
	        $_SESSION['messages'] = '<div class="alert alert-success alert-dismissible" role="alert"><i class="fa fa-check"></i>
	                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
	                                Data petugas baru berhasil disimpan.
	                                </div>';
        } else {
            echo "<script>location='./?p=petugas';</script>";
            $_SESSION['messages'] = '<div class="alert alert-danger alert-dismissible" role="alert"><i class="fa fa-exclamation-triangle"></i>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    Maaf, ada kesalahan dalam sistem kami.
                                    </div>';
        }
    }
endif;


/**
* -------------------------------------
* TAMBAH ANGGOTA PERPUS
* -------------------------------------
*/
if ( isset( $_POST['btn-add-member'] ) ) :
    $type_of_identity = $_POST['type_of_identity'];
    $no_identity = $_POST['no_identity'];
    $fullname = $_POST['fullname'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address_1 = $_POST['address_1'];
    $address_2 = $_POST['address_2'];
    $type_of_member = $_POST['type_of_member'];
    $name_of_institution = $_POST['name_of_institution'];
    $address_of_institution = $_POST['address_of_institution'];
    $deposit = $_POST['deposit'];
    date_default_timezone_set( "Asia/Jakarta" ); // time zone
    $date_join = date( 'Y-m-d' );

    // // Foto
    // $pass_photo = $_FILES['photo']['name'];
    // if ( ! empty( $pass_photo ) ) {
    //     $files = end( explode( '.', $pass_photo ) );
    //     $file_name = $pass_photo;
    //     $file_ext = $files;
    //     $hash_name = 'user_'. random_char( $file_name, 5 );
    //     $photo = $hash_name. ".$file_ext";
    //     $path1 = 'images/users/'.$photo;
    // } else {
    //     $photo = '';
    //     $path1 = '';
    // }
    if ( empty( $type_of_identity ) || empty( $no_identity ) || empty( $fullname ) || empty( $gender ) || empty( $phone ) || empty( $address_1 ) || empty( $address_2 ) || empty( $type_of_member ) || empty( $name_of_institution ) || empty( $address_of_institution ) || empty( $deposit ) ) {
        echo "<script>location='./?p=anggota';</script>";
        $_SESSION['messages'] = '<div class="alert alert-danger alert-dismissible" role="alert"><i class="fa fa-exclamation-triangle"></i>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                Pengisian data harus lengkap dan benar, silahkan ulangi.
                                </div>';
    }
    elseif ( ! is_numeric( $no_identity ) ) {
        echo "<script>location='./?p=anggota';</script>";
        $_SESSION['messages'] = '<div class="alert alert-danger alert-dismissible" role="alert"><i class="fa fa-exclamation-triangle"></i>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
								No. identitas tidak valid, silahkan ulangi. Contoh: 11111222223333
								</div>';
    }
    elseif ( ! preg_match( "/^[a-zA-Z ]*$/", $fullname ) ) {
        echo "<script>location='./?p=anggota';</script>";
        $_SESSION['messages'] = '<div class="alert alert-danger alert-dismissible" role="alert"><i class="fa fa-exclamation-triangle"></i>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                Nama tidak valid, silahkan ulangi.
                                </div>';
    }
    elseif ( ! is_numeric( $phone ) ) {
        echo "<script>location='./?p=anggota';</script>";
        $_SESSION['messages'] = '<div class="alert alert-danger alert-dismissible" role="alert"><i class="fa fa-exclamation-triangle"></i>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                No. telepon tidak valid, silahkan ulangi. Contoh: 089888777666
                                </div>';
    }
    // elseif ( filter_var( $email, FILTER_VALIDATE_EMAIL) === false ) {
    //     echo "<script>location='./?p=anggota';</script>";
    //     $_SESSION['messages'] = '<div class="alert alert-danger alert-dismissible" role="alert"><i class="fa fa-exclamation-triangle"></i>
    //                             <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
    //                             Alamat email tidak valid, silahkan ulangi.
    //                             </div>';
    // }
    elseif ( ! is_numeric( $deposit ) ) {
        echo "<script>location='./?p=anggota';</script>";
        $_SESSION['messages'] = '<div class="alert alert-danger alert-dismissible" role="alert"><i class="fa fa-exclamation-triangle"></i>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                               	Nominal uang tidak valid. Contoh penulisan: 100000
                                </div>';
    }
    else {
        $member = $mb->add_member( $type_of_identity, $no_identity, $fullname, $gender, $phone, $email,  $address_1,  $address_2, $type_of_member, $name_of_institution, $address_of_institution, $deposit, $date_join );
        if ( $member ) {
	        // move_uploaded_file( $_FILES['photo']['tmp_name'], $path1 ); // save img to directory
	        echo "<script>location='./?p=anggota';</script>";
	        $_SESSION['messages'] = '<div class="alert alert-success alert-dismissible" role="alert"><i class="fa fa-check"></i>
	                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
	                                Data anggota baru berhasil ditambahkan.
	                                </div>';
        } else {
            echo "<script>location='./?p=anggota';</script>";
            $_SESSION['messages'] = '<div class="alert alert-danger alert-dismissible" role="alert"><i class="fa fa-exclamation-triangle"></i>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    Maaf, ada kesalahan dalam sistem kami.
                                    </div>';
        }
    }
endif;


/**
* -------------------------------------
* TAMBAH KATEGORI BUKU
* -------------------------------------
*/
if ( isset( $_POST['btn-add-category'] ) ) :
	$cat_name = trim( $_POST['categories'] );

	if ( empty( $cat_name ) ) {
		echo "<script>location='./?p=kategori';</script>";
        $_SESSION['messages'] = '<div class="alert alert-danger alert-dismissible" role="alert"><i class="fa fa-exclamation-triangle"></i>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                Nama kategori tidak boleh kosong !
                                </div>';
	}
	else if ( !preg_match( "/^[a-zA-Z ]*$/",$cat_name ) ) {
		echo "<script>location='./?p=kategori';</script>";
        $_SESSION['messages'] = '<div class="alert alert-danger alert-dismissible" role="alert"><i class="fa fa-exclamation-triangle"></i>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
								Nama kategori tidak valid !
								</div>';
	} 
	else {
		$categories = $bks->add_category( $cat_name );
        if ( $categories ) {
	       	echo "<script>location='./?p=kategori';</script>";
        	$_SESSION['messages'] = '<div class="alert alert-success alert-dismissible" role="alert"><i class="fa fa-check"></i>
	                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
	                                Data kategori berhasil disimpan.
	                                </div>';
        } else {
            echo "<script>location='./?p=kategori';</script>";
            $_SESSION['messages'] = '<div class="alert alert-danger alert-dismissible" role="alert"><i class="fa fa-exclamation-triangle"></i>
	                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
	                                Maaf, ada kesalahan dalam sistem kami.
	                                </div>';
        }
	}
endif;


/**
* -------------------------------------
* TAMBAH BUKU PERPUS
* -------------------------------------
*/
if ( isset( $_POST['btn-add-books'] ) ) :
    $book_id = $_POST['book_id'];
    $title = $_POST['title'];
    $category_books = $_POST['category_books'];
    $author = $_POST['author'];
    $publisher = $_POST['publisher'];
    $physical_description = $_POST['physical_description'];
    $isbn = $_POST['isbn'];
    $description = $_POST['description'];
    $count = $_POST['count'];
    // Cover book
    $cover_book = $_FILES['cover']['name'];
    if ( ! empty( $cover_book ) ) {
        $files = end( explode( '.', $cover_book ) );
        $file_name = $cover_book;
        $file_ext = $files;
        $hash_name = 'book_'. random_char( $file_name, 5 );
        $cover = $hash_name. ".$file_ext";
        $path1 = 'images/books/'.$cover;
    } else {
        $cover = '';
        $path1 = '';
    }

    if ( empty( $title ) || empty( $category_books ) || empty( $author ) || empty( $publisher ) || empty( $physical_description ) || empty( $description ) || empty( $count ) || empty( $cover_book ) ) {
        echo "<script>location='./?p=buku';</script>";
        $_SESSION['messages'] = '<div class="alert alert-danger alert-dismissible" role="alert"><i class="fa fa-exclamation-triangle"></i>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                               	Pengisian data harus lengkap dan benar, silahkan ulangi.
                                </div>';
    }
    elseif ( ! preg_match( "/^[a-zA-Z0-9 ]*$/",$title ) ) {
        echo "<script>location='./?p=buku';</script>";
        $_SESSION['messages'] = '<div class="alert alert-danger alert-dismissible" role="alert"><i class="fa fa-exclamation-triangle"></i>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                               	Judul buku tidak valid, silahkan ulangi.
                                </div>';
    }
    elseif ( ! is_numeric( $count ) ) {
        echo "<script>location='./?p=buku';</script>";
        $_SESSION['messages'] = '<div class="alert alert-danger alert-dismissible" role="alert"><i class="fa fa-exclamation-triangle"></i>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                               	Stok buku harus diisi dengan angka !.
                                </div>';
    }
    else {
        $simpan = $bks->add_book( $book_id, $title, $category_books, $author, $publisher, $physical_description, $isbn, $description, $count, $cover );
        if ( $simpan ) {
	        move_uploaded_file( $_FILES['cover']['tmp_name'], $path1 ); // save img to directory
	        echo "<script>location='./?p=buku';</script>";
	        $_SESSION['messages'] = '<div class="alert alert-success alert-dismissible" role="alert"><i class="fa fa-check"></i>
	                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
	                                Data buku berhasil disimpan !
	                                </div>';
        } else {
            echo "<script>location='./?p=buku';</script>";
            $_SESSION['messages'] = '<div class="alert alert-danger alert-dismissible" role="alert"><i class="fa fa-exclamation-triangle"></i>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    Maaf, ada kesalahan dalam sistem kami.
                                    </div>';
        }
    }
endif;


/**
* -------------------------------------
* TAMBAH STATUS BUKU RUSAK / HILANG / DLL
* -------------------------------------
*/
if ( isset( $_POST['add-status-book'] ) ) :
    $date = $_POST['date'];
    $book_id = $_POST['my_books'];
    $member_id = $_POST['member_name'];
    $information = $_POST['information'];
    $optional = $_POST['optional'];
    $biaya_ganti = $_POST['biaya_ganti'];

    // custom code .
    $year = date( 'Y' ); // year
    $get_year = substr( $year, -2 ); // Get 2 number of year from right

    $number = '';
    $get_stts_book = $bks->get_maxid_by_data_status_book();
    $data_id_stts_books = $get_stts_book->fetch( PDO::FETCH_ASSOC );
    $check_stts = $get_stts_book->rowCount();
    $maxid  = $data_id_stts_books['max_id'];
    $last_id = substr( $maxid, 3 );

    if ( empty( $check_stts ) ) {
        $number = 1;
    } else {
        $the_code = $last_id;
        $number = $the_code + 1;
    }

    $custom_code = $get_year.'0'.$number;

    if ( empty( $date ) || empty( $book_id ) || empty( $member_id ) || empty( $information ) || empty( $biaya_ganti ) ) {
        echo "<script>location='./?p=data-status-buku';</script>";
        $_SESSION['messages'] = '<div class="alert alert-danger alert-dismissible" role="alert"><i class="fa fa-exclamation-triangle"></i>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                               	Pengisian data harus lengkap dan benar, silahkan ulangi.
                                </div>';
    }
    elseif ( ! is_numeric( $biaya_ganti ) ) {
        echo "<script>location='./?p=data-status-buku';</script>";
        $_SESSION['messages'] = '<div class="alert alert-danger alert-dismissible" role="alert"><i class="fa fa-exclamation-triangle"></i>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                Biaya ganti rugi / nominal uang harus diisi dengan angka !. Silahkan ulangi.
                                </div>';
    }
    else {

        $add_status_books = $bks->add_status_book( $custom_code, $book_id, $date, $information, $optional, $member_id, $biaya_ganti );
        $get_stock_book = $bks->get_stock_book( $book_id ); // ambil stock buku berdasarkan id buku ( hilang, rusak, dll )
        $get_book_based_id = $get_stock_book->fetch( PDO::FETCH_ASSOC );

        // Proses pengurangan stok buku jika terjadi kerusakan, hilang, dll.
        $count_of_book = $get_book_based_id['buku_jumlah'] - 1;

        // Mengupdate stok buku setelah pengurangan diproses
        $bks->update_stock_book( $book_id, $count_of_book );

        // Insert otomatis ke table kas
        $ks->add_kas( '', $custom_code, $biaya_ganti );
        // echo "<script>alert( 'Data status buku berhasil disimpan !' ); location='./?p=data-status-buku';</script>";
        echo "<script>location='./?p=data-status-buku';</script>";
        $_SESSION['messages'] = '<div class="alert alert-success alert-dismissible" role="alert"><i class="fa fa-check"></i>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                Data status buku rusak / hilang berhasil disimpan.
                                </div>';
    }
endif;


/**
* -------------------------------------
* TAMBAH LIST BUKU PEMINJAMAN ( DETAIL PEMINJAMAN )
* -------------------------------------
*/
if ( isset( $_POST['btn-add-detail-borrowing'] ) ) :
    $my_books = isset( $_POST['my_books'] ) ?  $_POST['my_books'] : '';
    $session_id = session_id();

    $get_data_book_by_id = $brw->get_detail_borrowing_by_sess_id( $session_id );
    $t_book = $brw->get_count_book_detail_borrowing( $my_books, $session_id );
    $get_stock_book = $bks->get_stock_book( $my_books );

    $get_book = $get_data_book_by_id->fetch( PDO::FETCH_ASSOC );
    $row_count = $get_data_book_by_id->rowCount();
    $count_book = $t_book->fetch( PDO::FETCH_ASSOC );
    $get_book_based_id = $get_stock_book->fetch( PDO::FETCH_ASSOC );

    if ( empty( $my_books ) ) {
    	echo "<script>location='./?p=list-peminjaman';</script>";
        $_SESSION['messages'] = '<div class="alert alert-danger alert-dismissible" role="alert"><i class="fa fa-exclamation-triangle"></i>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                Anda belum memilih buku !
                                </div>';
    }
    else if ( $count_book['count_book'] >= 1 ) {
        echo "<script>location='./?p=list-peminjaman';</script>";
        $_SESSION['messages'] = '<div class="alert alert-danger alert-dismissible" role="alert"><i class="fa fa-exclamation-triangle"></i>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                Jumlah dari setiap jenis / judul buku tidak boleh dipinjam lebih dari satu buku.
                                </div>';
    }
    else if ( $row_count >= 3 ) {
        echo "<script>location='./?p=list-peminjaman';</script>";
        $_SESSION['messages'] = '<div class="alert alert-danger alert-dismissible" role="alert"><i class="fa fa-exclamation-triangle"></i>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                Jumlah peminjaman maksimal 3 buah buku.
                                </div>';
    } 
    else {
        $brw->add_detail_borrowing( '', $my_books, $session_id );
        echo "<script>location='./?p=list-peminjaman';</script>";
        $_SESSION['messages'] = '<div class="alert alert-success alert-dismissible" role="alert"><i class="fa fa-check"></i>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                Data berhasil ditambahkan.
                                </div>';

        // PROSES PENGURANGAN STOCK BUKU
        $count_of_book = $get_book_based_id['buku_jumlah'] - 1;
        // UPDATE STOCK BUKU SETELAH DIPINJAM
        $bks->update_stock_book( $my_books, $count_of_book );

    }
endif;


/**
* -------------------------------------
* TAMBAH PEMINJAMAN BUKU
* -------------------------------------
*/
if ( isset( $_POST['btn-save-borrowing'] ) ) :
	$session_id = session_id();
	$year = date( 'Y' ); // year
	$mounth = date( 'm' ); // Mounth
	$get_year = substr( $year, -2 ); // Get 2 number of year from right

	$number = '';
	$get_borrow = $brw->get_maxid_by_data_borrowing();
	$data_id_borrow = $get_borrow->fetch( PDO::FETCH_ASSOC );
	$check_databorrow = $get_borrow->rowCount();

	$maxid  = $data_id_borrow['max_id'];
	$last_id = substr($maxid, 4);

	if ( empty( $check_databorrow ) ) {
	    $number = 1;
	} else {
	    $the_code = $last_id;
	    $number = $the_code + 1;
	}

	$custom_code = $get_year.$mounth.$number;

    $member_id = $_POST['member_name'];
    $date_borrowing = $_POST['date_borrowing'];
    $due_date = $_POST['due_date'];

    // Get id member to check status borrowing
    $member = $brw->get_user_in_borrowing_based_status_borrowing( $member_id, '-1' );
    $check_borrowing = $member->rowCount();

    if ( empty( $member_id ) || empty( $date_borrowing ) || empty( $due_date ) ) {
        echo "<script>location='./?p=list-peminjaman';</script>";
        $_SESSION['messages'] = '<div class="alert alert-danger alert-dismissible" role="alert"><i class="fa fa-exclamation-triangle"></i>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                               	Pengisian data harus lengkap dan benar, silahkan ulangi.
                                </div>';
    } 
    else {
    	if ( $check_borrowing > 0 ) {
			echo "<script>location='./?p=list-peminjaman';</script>";
        	$_SESSION['messages'] = '<div class="alert alert-danger alert-dismissible" role="alert"><i class="fa fa-exclamation-triangle"></i>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            	User belum mengembalikan buku sebelmnya !
                                </div>';
    	} else {
	        $add_borrowing = $brw->add_borrowing( $custom_code, $member_id, $date_borrowing, $due_date );
	        if ( $add_borrowing ) {
	            // Update id_peminjaman di table detail_peminjaman
	            $update_id_borrowing = $brw->update_id_peminjaman( $custom_code, $session_id );
	            echo "<script>location='./?p=peminjaman';</script>";
	            $_SESSION['messages'] = '<div class="alert alert-success alert-dismissible" role="alert"><i class="fa fa-check"></i>
	                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
	                                    Data peminjaman baru dengan id <strong>'. $custom_code . $users_who_still_borrow. '</strong> berhasil disimpan.
	                                    </div>';
	        } else {
	            echo "<script>location='./?p=peminjaman';</script>";
	            $_SESSION['messages'] = '<div class="alert alert-danger alert-dismissible" role="alert"><i class="fa fa-exclamation-triangle"></i>
	                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
	                                    Maaf, ada kesalahan dalam sistem kami.
	                                    </div>';
	        }
	    }
    }
endif;


/**
* -------------------------------------
* TAMBAH Banner Slider
* -------------------------------------
*/
if ( isset( $_POST['btn-add-slideshow'] ) ) :
    $title = $_POST['title'];
    $information = $_POST['information'];

    // Banner img
    $slider = $_FILES['banner_img']['name'];
    if ( ! empty( $slider ) ) {
        $files = end( explode( '.', $slider ) );
        $file_name = $slider;
        $file_ext = $files;
        $hash_name = 'baner_'. random_char( $file_name, 3 );
        $banner_img = $hash_name. ".$file_ext";
        $path = 'images/slideshow/'.$banner_img;
    } else {
        $banner_img = '';
        $path = '';
    }

   if ( empty( $slider ) || empty( $title ) || empty( $information ) ) {
        echo "<script>location='./?p=slideshow';</script>";
        $_SESSION['messages'] = '<div class="alert alert-danger alert-dismissible" role="alert"><i class="fa fa-exclamation-triangle"></i>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                               	Pengisian data harus lengkap dan benar, silahkan ulangi.
                                </div>';
    } else {
        $add = $sdr->add_slider( $title, $information, $banner_img );
        if ( $add ) {
	        move_uploaded_file( $_FILES['banner_img']['tmp_name'], $path ); // save img to directory
	        echo "<script>location='./?p=slideshow';</script>";
	        $_SESSION['messages'] = '<div class="alert alert-success alert-dismissible" role="alert"><i class="fa fa-check"></i>
	                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
	                                Banner slideshow berhasil ditambahkan.
	                                </div>';
        } else {
            echo "<script>location='./?p=slideshow';</script>";
            $_SESSION['messages'] = '<div class="alert alert-danger alert-dismissible" role="alert"><i class="fa fa-exclamation-triangle"></i>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    Maaf, ada kesalahan dalam sistem kami.
                                    </div>';
        }
    }
endif;
