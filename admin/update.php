<?php  
/**
* -------------------------------------
* All Actions Update 
* -------------------------------------
*/

session_start();
require_once 'includes/functions.php';
include_once 'includes/class.php';
$librarian = new Librarian(); // instansiasi obj
$bks = new Books(); // instansiasi obj
$mb = new Member(); // instansiasi obj
$brw = new Borrowing(); // instansiasi obj
$kas = new Kas(); // instansiasi obj
$admin = $librarian->get_sessi(); // get session

/**
* -------------------------------------
* MENGUPDATE PROFILE PETUGAS PERPUS
* -------------------------------------
*/
if ( isset( $_POST['btn-update-librarian'] ) ) :
	$librarian_id = $admin;
	$fullname = $_POST['fullname'];
	$gender = $_POST['gender'];
	$date_of_birth = $_POST['date_of_birth'];
	$place_of_birth = $_POST['place_of_birth'];
	$marital_status = $_POST['marital_status'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$address = $_POST['address'];
	$username = $_POST['username'];
	$librarian_status = $_POST['librarian_status'];
	
	if ( empty( $fullname ) || empty( $gender ) || empty( $date_of_birth ) || empty( $place_of_birth ) || empty( $marital_status ) || empty( $phone ) || empty( $email ) || empty( $address ) || empty( $username ) || empty( $librarian_status ) ) {
        echo "<script>location='./?p=profile';</script>";
        $_SESSION['messages'] = '<div class="alert alert-danger alert-dismissible" role="alert"><i class="fa fa-exclamation-triangle"></i>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                               	Pengisian data harus lengkap dan benar, silahkan ulangi.
                                </div>';
    } 
    elseif ( !preg_match( "/^[a-zA-Z ]*$/", $fullname ) ) {
		echo "<script>location='./?p=profile';</script>";
        $_SESSION['messages'] = '<div class="alert alert-danger alert-dismissible" role="alert"><i class="fa fa-exclamation-triangle"></i>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                               	Nama tidak valid, silahkan ulangi.
                                </div>';
	}
    elseif ( ! is_numeric( $phone ) ) {
		echo "<script>location='./?p=profile';</script>";
        $_SESSION['messages'] = '<div class="alert alert-danger alert-dismissible" role="alert"><i class="fa fa-exclamation-triangle"></i>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                               	No. Telp tidak valid, silahkan ulangi. Contoh: 081234234222
                                </div>';
	}
	elseif ( filter_var( $email, FILTER_VALIDATE_EMAIL) === false ) {
		echo "<script>location='./?p=profile';</script>";
        $_SESSION['messages'] = '<div class="alert alert-danger alert-dismissible" role="alert"><i class="fa fa-exclamation-triangle"></i>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                               	Alamat email tidak valid !
                                </div>';
    } else {
    	$update = $librarian->update_librarian( $librarian_id, $fullname, $gender, $date_of_birth, $place_of_birth, $marital_status, $phone, $email, $address, $username, $librarian_status );
		if ( $update ) {
	        echo "<script>location='./?p=profile';</script>";
	        $_SESSION['messages'] = '<div class="alert alert-success alert-dismissible" role="alert"><i class="fa fa-check"></i>
	                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
	                                Data Anda berhasil diperbarui.
	                                </div>';
	    } else {
	        echo "<script>location='./?p=profile';</script>";
	        $_SESSION['messages'] = '<div class="alert alert-danger alert-dismissible" role="alert"><i class="fa fa-exclamation-triangle"></i>
	                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
	                                Maaf, ada kesalahan dalam sistem kami.
	                                </div>';
	    }
	}
endif;


/**
* -------------------------------------
* MENGUPDATE FOTO PROFILE PETUGAS PERPUS
* -------------------------------------
*/
if ( isset( $_POST['btn-update-photo-librarian'] ) ) :
	$librarian_id = $admin;
	$pass_photo = $_FILES['photo']['name'];
	$data = $librarian->get_photo_librarian_by_id( $librarian_id );
	$edit = $data->fetch( PDO::FETCH_ASSOC );

	$old_photo = $edit['foto'];
	$dir = 'images/users/'. $old_photo; // dir & pass foto lama
	$path = ''; // set directory & foto baru

	if ( ! empty( $pass_photo ) ) {
		$files = end( explode( '.', $pass_photo ) );
		$file_name = $pass_photo;
		$file_ext = $files;
		$hash_name = 'admin_'. random_char( $file_name, 3 );
		$photo = $hash_name . ".$file_ext";
		$path = 'images/users/'.$photo;
    } else {
		// Check file in directory 
		if ( file_exists( $dir ) ) { 
			$photo = $edit['foto'];
		} else {
			$photo = '';
			$path = '';
		}
	}

    // Check extention file
    $exts = array('png', 'jpg', 'jpeg'); 

	if ( empty( $pass_photo ) ) {
        echo "<script>location='./?p=profile';</script>";
        $_SESSION['messages'] = '<div class="alert alert-danger alert-dismissible" role="alert"><i class="fa fa-exclamation-triangle"></i>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                               	Foto tidak boleh kosong, silahkan ulangi !.
                                </div>';
    } 
    elseif ( ! in_array( $file_ext, $exts ) ) {
        echo "<script>location='./?p=profile';</script>";
        $_SESSION['messages'] = '<div class="alert alert-danger alert-dismissible" role="alert"><i class="fa fa-exclamation-triangle"></i>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                Foto harus ber-extentions jpg, jpeg, atau png !
                                </div>';
    } else {
    	$update = $librarian->update_photo_librarian( $librarian_id, $photo );
        if ( $update ) {

            // check if file exists and available in database
            if ( file_exists( $dir ) AND ( ! empty( $old_photo ) ) ) { 
                unlink( $dir ); // then, remove file in directory
            }

	        move_uploaded_file( $_FILES['photo']['tmp_name'], $path );
	        echo "<script>location='./?p=profile';</script>";
	        $_SESSION['messages'] = '<div class="alert alert-success alert-dismissible" role="alert"><i class="fa fa-check"></i>
	                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
	                                Foto Anda berhasil diperbarui.
	                                </div>';
	    } else {
	        echo "<script>location='./?p=profile';</script>";
	        $_SESSION['messages'] = '<div class="alert alert-danger alert-dismissible" role="alert"><i class="fa fa-exclamation-triangle"></i>
	                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
	                                Maaf, ada kesalahan dalam sistem kami.
	                                </div>';
	    }
    } 
endif;


/**
* -------------------------------------
* MENGUPDATE PASSWORD PERPUS
* -------------------------------------
*/
if ( isset( $_POST['btn-update-password-librarian'] ) ) :
	$librarian_id = $admin;
	$old_password = $_POST['old_password'];
	$new_password = $_POST['new_password'];
	$confirm_password = $_POST['confirm_password'];

	$get_password_librarian_by_id = $librarian->get_password_librarian_by_id( $librarian_id, $old_password );
	$data = $get_password_librarian_by_id->fetch( PDO::FETCH_ASSOC );
	$check_password = $get_password_librarian_by_id->rowCount();
	
	if ( empty( $old_password ) || empty( $new_password ) || empty( $confirm_password ) ) {
        echo "<script>location='./?p=profile';</script>";
        $_SESSION['messages'] = '<div class="alert alert-danger alert-dismissible" role="alert"><i class="fa fa-exclamation-triangle"></i>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                               	Password tidak boleh kosong, silahkan ulangi !.
                                </div>';
    } elseif ( strlen( $new_password ) < 8 ) {
		echo "<script>location='./?p=profile';</script>";
        $_SESSION['messages'] = '<div class="alert alert-danger alert-dismissible" role="alert"><i class="fa fa-exclamation-triangle"></i>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                               	Panjang password minimal 8 karakter !.
                                </div>';
    } elseif ( $check_password == 0 ) {
        echo "<script>location='./?p=profile';</script>";
        $_SESSION['messages'] = '<div class="alert alert-danger alert-dismissible" role="alert"><i class="fa fa-exclamation-triangle"></i>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                Password salah, silahkan ulangi !.
                                </div>';
    } elseif ( $new_password != $confirm_password ) {
        echo "<script>location='./?p=profile';</script>";
        $_SESSION['messages'] = '<div class="alert alert-danger alert-dismissible" role="alert"><i class="fa fa-exclamation-triangle"></i>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                Password tidak cocok, silahkan ulangi !.
                                </div>';
    } else {
    	$librarian->update_password_librarian( $librarian_id, $new_password );
        echo "<script>location='./?p=profile';</script>";
        $_SESSION['messages'] = '<div class="alert alert-success alert-dismissible" role="alert"><i class="fa fa-check"></i>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                Password berhasil diperbarui.
                                </div>';
    }
endif;


/**
* -------------------------------------
* MENGUPDATE DATA KATEGORI BUKU
* -------------------------------------
*/
if ( isset( $_GET['id_cat'] ) ) :
	$data = $bks->get_data_category_book_by_id( $_GET['id_cat'] );
	$edit = $data->fetch( PDO::FETCH_ASSOC );

	$cat_id = $_GET['id_cat'];
	$categories = trim( $_POST['categoryname'] );

	if ( empty( $categories ) ) {
		echo "<script>alert( 'Nama kategori tidak boleh kosong !' ); location='?p=kategori';</script>";
	}
	else if ( !preg_match( "/^[a-zA-Z ]*$/",$categories ) ) {
		echo "<script>alert( 'Nama kategori tidak valid !' ); location='?p=kategori';</script>";
	} 
	else {
		$update = $bks->update_category( $cat_id, $categories );
		// echo "Data kategori berhasil diperbarui.";
		echo "<script>location='./?p=kategori';</script>";
        $_SESSION['messages'] = '<div class="alert alert-success alert-dismissible" role="alert"><i class="fa fa-check"></i>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                Data kategori berhasil diperbarui.
                                </div>';
	}
endif;


/**
* -------------------------------------
* MENGUPDATE DATA BUKU
* -------------------------------------
*/
if ( isset( $_POST['btn-update-books'] ) ) :
    $book_id = $_POST['book_id'];
    $title = $_POST['title'];
    $category_books = $_POST['category_books'];
    $author = $_POST['author'];
    $publisher = $_POST['publisher'];
    $physical_description = $_POST['physical_description'];
    $isbn = $_POST['isbn'];
    $description = $_POST['description'];
    $count = $_POST['count'];

    $data = $bks->get_data_book_by_id( $book_id );
    $edit = $data->fetch( PDO::FETCH_ASSOC );
    $path = '';

    // Cover book
    $cover_book =  $_FILES['cover']['name'];

    // Check extention file
    // $exts = array('png', 'jpg', 'jpeg'); 

    if ( empty( $title ) || empty( $category_books ) || empty( $author ) || empty( $publisher ) || empty( $physical_description ) || empty( $description ) || empty( $count ) ) {
        echo "<script>location='./?p=buku';</script>";
        $_SESSION['messages'] = '<div class="alert alert-danger alert-dismissible" role="alert"><i class="fa fa-exclamation-triangle"></i>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                Pengisian data harus lengkap dan benar, silahkan ulangi.
                                </div>';
    } 
    elseif ( ! preg_match( "/^[a-zA-Z0-9 ]*$/", $title ) ) {
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
    } else {
        
        if ( ! empty( $cover_book ) ) {
            $files = end( explode( '.', $cover_book ) );
            $file_name = $cover_book;
            $file_ext = $files;
            $hash_name = 'book_'. random_char( $file_name, 5 );
            $cover_bk = $hash_name . ".$file_ext"; // file name yg telah dienkripsi + extentionnya
            $path = 'images/books/'. $cover_bk;

            $cover_old = $edit['buku_cover'];
            // hapus cover lama
            unlink( 'images/books/'. $cover_old );
            // Jika gb cover diganti / diinput dg cover baru
            $update = $bks->update_book( $book_id, $title, $category_books, $author, $publisher, $physical_description, $isbn, $description, $count, $cover_bk );
        } else {
            $update = $bks->update_book_without_cover( $book_id, $title, $category_books, $author, $publisher, $physical_description, $isbn, $description, $count );
        }

        if ( $update ) {
            move_uploaded_file( $_FILES['cover']['tmp_name'], $path ); // Menyimpan gb ke directory jika gambar di ganti dengan yg baru
           	echo "<script>location='./?p=buku';</script>";
            $_SESSION['messages'] = '<div class="alert alert-success alert-dismissible" role="alert"><i class="fa fa-check"></i>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                  	Data buku dengan id = '. $book_id .' berhasil diperbarui.
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
* MENGUPDATE STATUS BUKU RUSAK / HILANG / DLL.
* -------------------------------------
*/
if ( isset( $_POST['btn-update-status-books'] ) ) :
	$stts_book_id = $_POST['book_status_id'];
	$date = $_POST['date'];
    $book_id = $_POST['my_books'];
    $member_id = $_POST['member_name'];
    $information = $_POST['information'];
    $optional = $_POST['optional'];
    $biaya_ganti = $_POST['biaya_ganti'];

    // $get_data_status_book_by_id = $bks->get_data_status_book_by_id( $stts_book_id );
    // $data = $get_data_status_book_by_id->fetch( PDO::FETCH_ASSOC );
    // $the_book = $data['buku_id'];
    // $count_of_book = $data['buku_jumlah'];
   
	
	if ( empty( $date ) || empty( $book_id ) || empty( $member_id ) || empty( $information ) || empty( $biaya_ganti ) ) {
        echo "<script>location='./?p=data-status-buku';</script>";
        $_SESSION['messages'] = '<div class="alert alert-danger alert-dismissible" role="alert"><i class="fa fa-exclamation-triangle"></i>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                               	Pengisian data harus lengkap dan benar, silahkan ulangi !
                                </div>';
    } else {

    	// Update stok buku
		// if ( $the_book != $book_id ) {
		// 	$the_count = $count_of_book + 1;
		// 	$bks->update_stock_book( $book_id, $the_count );
		// } else {
		// 	$get_data_status_book_by_id_old = $bks->get_stock_book( $stts_book_id );
		// 	$data_old = $get_data_status_book_by_id_old->fetch( PDO::FETCH_ASSOC );
		// 	$the_book_old = $data_old['buku_id'];
		// 	$count_of_book_old = $data_old['buku_jumlah'];

		// 	$the_count = $count_of_book_old - 1;
		// 	$bks->update_stock_book( $the_book_old, $the_count );
		// }

    	$update_status_book = $bks->update_status_book( $stts_book_id, $book_id, $date, $information, $optional, $member_id, $biaya_ganti );

    	if ( $update_status_book ) {
	    	// Update uang kas sesuai dengan id yg dedit
	    	$kas->update_kas_based_stts_book_id( $stts_book_id, $biaya_ganti );

	        echo "<script>location='./?p=data-status-buku';</script>";
	        $_SESSION['messages'] = '<div class="alert alert-success alert-dismissible" role="alert"><i class="fa fa-check"></i>
	                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
	                                Data status buku hilang / rusak dengan id = '. $stts_book_id .' berhasil diperbarui.
	                                </div>';
	    } else {
	    	echo "<script>location='./?p=data-status-buku';</script>";
        	$_SESSION['messages'] = '<div class="alert alert-danger alert-dismissible" role="alert"><i class="fa fa-exclamation-triangle"></i>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                Maaf, ada kesalahan dalam sistem kami.
                                </div>';
	    }
    }
endif;


/**
* -------------------------------------
* MENGUPDATE DATA ANGGOTA PERPUS
* -------------------------------------
*/
if ( isset( $_POST['btn-update-member'] ) ) :
	$member_id = $_POST['member_id'];
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
	
	if ( empty( $type_of_identity ) || empty( $no_identity ) || empty( $fullname ) || empty( $gender ) || empty( $phone ) || empty( $email ) || empty( $address_1 ) || empty( $address_2 ) || empty( $type_of_member ) || empty( $name_of_institution ) || empty( $address_of_institution )  || empty( $deposit ) ) {
        echo "<script>location='./?p=anggota';</script>";
        $_SESSION['messages'] = '<div class="alert alert-danger alert-dismissible" role="alert"><i class="fa fa-exclamation-triangle"></i>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                               	Pengisian data harus lengkap dan benar, silahkan ulangi !
                                </div>';
    } 
    elseif ( ! preg_match( "/^[0-9 ]*$/", $no_identity ) ) {
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
    } else {
    	$mb->update_member( $member_id, $type_of_identity, $no_identity, $fullname, $gender, $phone, $email, $address_1, $address_2, $type_of_member, $name_of_institution, $address_of_institution, $deposit );
        echo "<script>location='./?p=anggota';</script>";
        $_SESSION['messages'] = '<div class="alert alert-success alert-dismissible" role="alert"><i class="fa fa-check"></i>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                Data anggota dengan id = '. $member_id .' berhasil diperbarui.
                                </div>';
    }
endif;


/**
* -------------------------------------
* MENGUPDATE DATA PEMINJAMAN
* -------------------------------------
*/
if ( isset( $_POST['btn-update-borrowing'] ) ) :
    $borrowing_id = $_POST['borrowing_id'];
    $member_books = isset( $_POST['member_books'] ) ? $_POST['member_books'] : '';
    $date_borrowing = $_POST['date_borrowing'];
    $due_date = $_POST['due_date'];

    if ( empty( $member_books ) || empty( $date_borrowing ) || empty( $due_date ) ) {
        echo "<script>location='./?p=edit-peminjaman&edit_brw=$borrowing_id';</script>";
        $_SESSION['messages'] = '<div class="alert alert-danger alert-dismissible" role="alert"><i class="fa fa-exclamation-triangle"></i>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                               	Pengisian data harus lengkap dan benar, silahkan ulangi.
                                </div>';
    } 
    else {
    	$update = $brw->update_borrowing( $borrowing_id, $member_books, $date_borrowing, $due_date );
	    if ( $update ) {
	    	echo "<script>location='./?p=peminjaman';</script>";
	       	$_SESSION['messages'] = '<div class="alert alert-success alert-dismissible" role="alert"><i class="fa fa-check"></i>
	                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
	                                Data peminjaman berhasil diperbarui.
	                                </div>';
	    } else {
	        echo "<script>location='./?p=peminjaman';</script>";
	       	$_SESSION['messages'] = '<div class="alert alert-danger alert-dismissible" role="alert"><i class="fa fa-exclamation-triangle"></i>
	                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
	                               	Maaf, ada kesalahan dalam sistem kami.
	                                </div>';
	    }
	}
endif;
