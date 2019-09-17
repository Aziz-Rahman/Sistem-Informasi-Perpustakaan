<?php
/**
* -------------------------------------
* OOP with PDO - Sistem Informasi Perpustakaan
* By Aziz Rahman Aji
* -------------------------------------

/ PDO ( PHP DATA OBJECT )
/ mysql_num_rows = rowCount();
/ mysql_fetch_array = fetch(PDO::FETCH_BOTH) - The rows are arrays with both numeric and named indexes.
/ mysql_fetch_assoc = fetch(PDO::FETCH_ASSOC) - The rows are arrays with named indexes.
/ mysql_fetch_row = fetch(PDO::FETCH_NUM) - The rows are arrays with numeric indexes.
/ mysql_fetch_object = fetch(PDO::FETCH_OBJ) or fetch(PDO::FETCH_CLASS)

* -------------------------------------
* Class My_Connection
* -------------------------------------
*/
class My_Connection {
	public function connection() {
		$this->db = new PDO( "mysql:host=localhost; dbname=db_perpus", "root", "" );
		$this->db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	}
} // END: Class My_Connection


/**
* -------------------------------------
* Class Dashboard ( Home )
* -------------------------------------
*/
class Dashboard extends My_Connection {
	public function __construct() {
		parent::connection();
	}

	public function total_member() {
		try {
			$stmt = $this->db->prepare( "SELECT count(*) AS total_member FROM anggota" );
			$stmt->execute();
			return $stmt;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function new_register() {
		try {
			$stmt = $this->db->prepare( "SELECT count(*) AS new_register FROM anggota WHERE YEAR(tgl_pendaftaran) = YEAR(NOW()) AND MONTH(tgl_pendaftaran) = MONTH(NOW())" );
			$stmt->execute();
			return $stmt;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function count_of_borrowing() {
		try {
			$stmt = $this->db->prepare( "SELECT count(*) AS borrowing_one_mounth FROM peminjaman WHERE YEAR(tgl_pinjam) = YEAR(NOW()) AND MONTH(tgl_pinjam) = MONTH(NOW())" );
			$stmt->execute();
			return $stmt;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function count_of_book() {
		try {
			$stmt = $this->db->prepare( "SELECT count(*) AS total_book FROM buku" );
			$stmt->execute();
			return $stmt;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function count_of_borrowing_group_by_mounth() {
		try {
			$stmt = $this->db->prepare( "SELECT count(*) AS count_per_mounth FROM peminjaman WHERE YEAR(tgl_pinjam) = YEAR(CURDATE()) GROUP BY MONTH(tgl_pinjam)" );
			$stmt->execute();
			return $stmt;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function borrowing_per_mounth() {
		try {
			$stmt = $this->db->prepare( "SELECT date_format(tgl_pinjam,'%b') AS bulan 
											FROM peminjaman 
											WHERE YEAR(tgl_pinjam) = YEAR(CURDATE())
											GROUP BY MONTH(tgl_pinjam)" );

			// WHERE YEAR(tgl_pinjam) = YEAR(CURDATE()) -> berdasarkan tahun ini
			$stmt->execute();
			return $stmt;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}
} // END: Class Dashboard ( Home )


/**
* -------------------------------------
* Class Librarian ( Petugas / Admin )
* -------------------------------------
*/
class Librarian extends My_Connection {
	public function __construct() {
		parent::connection();
	}

	public function check_login( $username, $password ) {
		try {
			$password_hash = md5( $password );
			$stmt = $this->db->prepare( "SELECT * FROM petugas WHERE username = :username AND password = :password" );
			$stmt->bindParam( ":username", $username );
			$stmt->bindParam( ":password", $password_hash );
			$stmt->execute();

			$data = $stmt->fetch( PDO::FETCH_ASSOC );
			$check = $stmt->rowCount();

			if ( $check > 0 ) {
				$_SESSION['sess_id_login'] = $data['petugas_id'];
				$_SESSION['username'] = $data['username'];
				return true;
			} else {
				return false;
			}
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function get_sessi() {
		$session = isset( $_SESSION['sess_id_login'] ) ? $_SESSION['sess_id_login'] : '';
		return $session;
	}

	public function logout() {
		unset( $_SESSION['sess_id_login'] );
		session_destroy();
	}

	public function display_librarian() {
		try {
			$stmt = $this->db->prepare( "SELECT * FROM petugas" );
			$stmt->execute();
			return $stmt;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function get_name_and_photo_librarian_by_id( $petugas_id ) {
		try {
			$stmt = $this->db->prepare( "SELECT nama_lengkap, foto FROM petugas WHERE petugas_id = :petugas_id" );
			$stmt->bindParam( ":petugas_id", $petugas_id );
			$stmt->execute();
			return $stmt;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function add_librarian( $fullname, $gender, $date_of_birth, $place_of_birth, $marital_status, $phone, $email, $address, $photo, $username, $password, $librarian_status ) {
		try {
			$password_hash = md5( $password );
			$stmt = $this->db->prepare( "INSERT INTO `petugas` ( `nama_lengkap`, `jenis_kelamin`, `tgl_lahir`, `tempat_lahir`, `status_perkawinan`, `no_telp`, `email`, `alamat`, `foto`, `username`, `password`, `status_petugas` ) 
										VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? )" );
			$stmt->bindParam( 1, $fullname );
			$stmt->bindParam( 2, $gender );
			$stmt->bindParam( 3, $date_of_birth );
			$stmt->bindParam( 4, $place_of_birth );
			$stmt->bindParam( 5, $marital_status );
			$stmt->bindParam( 6, $phone );
			$stmt->bindParam( 7, $email );
			$stmt->bindParam( 8, $address );
			$stmt->bindParam( 9, $photo );
			$stmt->bindParam( 10, $username );
			$stmt->bindParam( 11, $password_hash );
			$stmt->bindParam( 12, $librarian_status );
			$stmt->execute();
			return true;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function get_data_librarian_by_id( $librarian_id ) {
		try {
			$stmt = $this->db->prepare( "SELECT * FROM petugas WHERE petugas_id = :librarian_id" );
			$stmt->bindParam( ":librarian_id", $librarian_id );
			$stmt->execute();
			return $stmt;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function get_photo_librarian_by_id( $librarian_id ) {
		try {
			$stmt = $this->db->prepare( "SELECT foto FROM petugas WHERE petugas_id = :librarian_id" );
			$stmt->bindParam( ":librarian_id", $librarian_id );
			$stmt->execute();
			return $stmt;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function get_password_librarian_by_id( $librarian_id, $password ) {
		try {
			$password_hash = md5( $password );
			$stmt = $this->db->prepare( "SELECT password FROM petugas WHERE password = :password_hash AND petugas_id = :librarian_id" );
			$stmt->bindParam( ":librarian_id", $librarian_id );
			$stmt->bindParam( ":password_hash", $password_hash );
			$stmt->execute();
			return $stmt;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function update_librarian( $librarian_id, $fullname, $gender, $date_of_birth, $place_of_birth, $marital_status, $phone, $email, $address, $username, $librarian_status ) {
		try {
			$stmt = $this->db->prepare( 
				"UPDATE petugas 
				SET nama_lengkap 		= :fullname, 
					jenis_kelamin 		= :gender,
					tgl_lahir			= :date_of_birth,
					tempat_lahir		= :place_of_birth,
					status_perkawinan	= :marital_status,
					no_telp				= :phone,
					email 				= :email, 
					alamat 				= :address,
					username 			= :username, 
					status_petugas 		= :librarian_status
				WHERE petugas_id 		= :librarian_id" 
			);
			$stmt->bindParam( ":fullname", $fullname );
			$stmt->bindParam( ":gender", $gender );
			$stmt->bindParam( ":date_of_birth", $date_of_birth );
			$stmt->bindParam( ":place_of_birth", $place_of_birth );
			$stmt->bindParam( ":marital_status", $marital_status );
			$stmt->bindParam( ":phone", $phone );
			$stmt->bindParam( ":email", $email );
			$stmt->bindParam( ":address", $address );
			$stmt->bindParam( ":username", $username );
			$stmt->bindParam( "librarian_status", $librarian_status );
			$stmt->bindParam( "librarian_id", $librarian_id );
			$stmt->execute();
			return true;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function update_photo_librarian( $librarian_id, $photo ) {
		try {
			$stmt = $this->db->prepare( "UPDATE petugas SET foto = :photo WHERE petugas_id = :librarian_id" );
			$stmt->bindParam( ":photo", $photo );
			$stmt->bindParam( "librarian_id", $librarian_id );
			$stmt->execute();
			return true;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function update_password_librarian( $librarian_id, $password ) {
		try {
			$password_hash = md5( $password );
			$stmt = $this->db->prepare( "UPDATE petugas SET password = :password WHERE petugas_id = :librarian_id" );
			$stmt->bindParam( ":password", $password_hash );
			$stmt->bindParam( "librarian_id", $librarian_id );
			$stmt->execute();
			return true;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function delete_librarian( $librarian_id ) {
		try {
			$stmt = $this->db->prepare( "DELETE FROM petugas WHERE petugas_id = :librarian_id" );
			$stmt->bindParam( ":librarian_id", $librarian_id );
			$stmt->execute();
			return true;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}
} // END: Class Librarian ( Petugas / Admin )


/**
* -------------------------------------
* Class Books,  ( berisi method kategori & buku )
* -------------------------------------
*/
class Books extends My_Connection {
	public function __construct() {
		parent::connection();
	}

	public function display_category() {
		try {
			$stmt = $this->db->prepare( "SELECT * FROM kategori ORDER BY kategori_nama ASC" );
			$stmt->execute();
			return $stmt;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function search_books( $search ) {
		try {
			$stmt = $this->db->prepare( "SELECT buku_id, buku_judul, penulis, penerbit, buku_deskripsi, buku_cover FROM buku WHERE buku_id LIKE '%$search%' OR buku_judul LIKE '%$search%' OR penulis LIKE '%$search%' OR penerbit LIKE '%$search%' OR buku_deskripsi LIKE '%$search%' ORDER BY buku_judul ASC" );
			$stmt->execute();
			return $stmt;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function add_category( $category_name ) {
		try {
			$stmt = $this->db->prepare( "INSERT INTO kategori ( kategori_nama ) VALUES ( ? )" );
			$stmt->bindParam( "1", $category_name );
			$stmt->execute();
			return true;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function get_data_category_book_by_id( $category_id ) {
		try {
			$stmt = $this->db->prepare( "SELECT * FROM kategori WHERE kategori_id = :category_id" );
			$stmt->bindParam( ":category_id", $category_id );
			$stmt->execute();
			return $stmt;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function update_category( $category_id, $category_name ) {
		try {
			$stmt = $this->db->prepare( "UPDATE kategori SET kategori_nama = :category_name WHERE kategori_id = :category_id" );
			$stmt->bindParam( ":category_id", $category_id );
			$stmt->bindParam( ":category_name", $category_name );
			$stmt->execute();
			return true;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function delete_category( $category_id ) {
		try {
			$stmt = $this->db->prepare( "DELETE FROM kategori WHERE kategori_id = :category_id" );
			$stmt->bindParam( ":category_id", $category_id );
			$stmt->execute();
			return true;
		} catch ( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function display_book() {
		try {
			$stmt = $this->db->prepare( "SELECT * FROM buku INNER JOIN kategori ON buku.kategori_id = kategori.kategori_id ORDER BY buku_id DESC" );
			$stmt->execute();
			return $stmt;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function display_page_book() {
		try {
			$stmt = $this->db->prepare( "SELECT buku_id, buku_judul, kategori_id, buku_cover FROM buku ORDER BY buku_id DESC" );
			$stmt->execute();
			return $stmt;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function recent_post_of_book() {
		try {
			$stmt = $this->db->prepare( "SELECT buku_id, buku_judul, buku_cover FROM buku ORDER BY buku_id DESC LIMIT 4" );
			$stmt->execute();
			return $stmt;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function related_post_of_book( $category_id, $book_id ) {
		try {
			$stmt = $this->db->prepare( "SELECT buku_id, buku_judul, buku_cover FROM buku WHERE kategori_id = '$category_id' AND buku_id <> '$book_id' ORDER BY RAND() LIMIT 0, 4" );
			$stmt->execute();
			return $stmt;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function display_page_book_with_pagination( $position, $limit ) {
		try {
			$stmt = $this->db->prepare( "SELECT buku_id, buku_judul, buku_cover FROM buku ORDER BY buku_id DESC LIMIT $position, $limit" );
			$stmt->execute();
			return $stmt;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function display_page_book_based_category_with_pagination( $code_category, $position, $limit ) {
		try {
			$stmt = $this->db->prepare( "SELECT buku_id, kategori_id, buku_judul, buku_cover FROM buku WHERE kategori_id = '$code_category' ORDER BY buku_id DESC LIMIT $position, $limit" );
			$stmt->execute();
			return $stmt;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function display_page_book_based_category( $code_category ) {
		try {
			$stmt = $this->db->prepare( "SELECT buku_id, buku_judul, kategori_id, buku_cover FROM buku WHERE kategori_id = '$code_category' ORDER BY buku_id DESC" );
			$stmt->execute();
			return $stmt;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function get_books_id_from_right() {
		try {
			$stmt = $this->db->prepare( "SELECT RIGHT(buku_id,10) FROM `buku` ORDER BY RIGHT(buku_id,10) DESC" );
			$stmt->execute();
			return $stmt;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function add_book( $book_id, $title, $category_books, $author, $publisher, $physical_description, $isbn, $description, $count, $cover ) {
		try {
			$stmt = $this->db->prepare( "INSERT INTO `buku` ( `buku_id`, `buku_judul`, `kategori_id`, `penulis`, `penerbit`, `deskripsi_fisik`, `isbn`, `buku_deskripsi`, `buku_jumlah`, `buku_cover` ) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ? )" );
			$stmt->bindParam( 1, $book_id );
			$stmt->bindParam( 2, $title );
			$stmt->bindParam( 3, $category_books );
			$stmt->bindParam( 4, $author );
			$stmt->bindParam( 5, $publisher );
			$stmt->bindParam( 6, $physical_description );
			$stmt->bindParam( 7, $isbn );
			$stmt->bindParam( 8, $description );
			$stmt->bindParam( 9, $count );
			$stmt->bindParam( 10, $cover );
			$stmt->execute();
			return true;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function get_maxid_by_data_status_book() {
		try {
			$stmt = $this->db->prepare( "SELECT max(id_status_buku) AS max_id FROM status_buku" );
			$stmt->execute();
			return $stmt;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function get_data_book_by_id( $book_id ) {
		try {
			$stmt = $this->db->prepare( "SELECT * FROM buku WHERE buku_id = :book_id" );
			$stmt->bindParam( ":book_id", $book_id );
			$stmt->execute();
			return $stmt;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function update_book( $book_id, $title, $category_books, $author, $publisher, $physical_description, $isbn, $description, $count, $cover ) {
		try {
			$stmt = $this->db->prepare( 
				"UPDATE buku 
				SET buku_judul 		= :title, 
					kategori_id 	= :category_books,
					penulis			= :author,
					penerbit		= :publisher,
					deskripsi_fisik	= :physical_description,
					isbn			= :isbn,
					buku_deskripsi 	= :description, 
					buku_jumlah 	= :count, 
					buku_cover 		= :cover 
				WHERE buku_id 		= :book_id"
			);
			$stmt->bindParam( ":title", $title );
			$stmt->bindParam( ":category_books", $category_books );
			$stmt->bindParam( ":author", $author );
			$stmt->bindParam( ":publisher", $publisher );
			$stmt->bindParam( ":physical_description", $physical_description );
			$stmt->bindParam( ":isbn", $isbn );
			$stmt->bindParam( ":description", $description );
			$stmt->bindParam( ":count", $count );
			$stmt->bindParam( ":cover", $cover );
			$stmt->bindParam( ":book_id", $book_id );
			$stmt->execute();
			return true;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function update_book_without_cover( $book_id, $title, $category_books, $author, $publisher, $physical_description, $isbn, $description, $count ) {
		try {
			$stmt = $this->db->prepare( 
				"UPDATE buku 
				SET buku_judul 		= :title, 
					kategori_id 	= :category_books,
					penulis			= :author,
					penerbit		= :publisher,
					deskripsi_fisik	= :physical_description,
					isbn			= :isbn,
					buku_deskripsi 	= :description, 
					buku_jumlah 	= :count
				WHERE buku_id 		= :book_id"
			);
			$stmt->bindParam( ":title", $title );
			$stmt->bindParam( ":category_books", $category_books );
			$stmt->bindParam( ":author", $author );
			$stmt->bindParam( ":publisher", $publisher );
			$stmt->bindParam( ":physical_description", $physical_description );
			$stmt->bindParam( ":isbn", $isbn );
			$stmt->bindParam( ":description", $description );
			$stmt->bindParam( ":count", $count );
			$stmt->bindParam( ":book_id", $book_id );
			$stmt->execute();
			return true;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function get_cover_book( $book_id ) {
		try {
			$stmt = $this->db->prepare( "SELECT buku_cover FROM buku WHERE buku_id = :book_id" );
			$stmt->bindParam( ":book_id", $book_id );
			$stmt->execute();
			return $stmt;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	// Pengurangan stock buku setelah ditampung/ terpinjam
	public function get_stock_book( $book_id ) {
		try {
			$stmt = $this->db->prepare( "SELECT buku_id, buku_jumlah FROM buku WHERE buku_id = :book_id" );
			$stmt->bindParam( ":book_id", $book_id );
			$stmt->execute();
			return $stmt;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function update_stock_book( $book_id, $count_of_book ) {
		try {
			$stmt = $this->db->prepare( "UPDATE buku SET buku_jumlah = :count_of_book WHERE buku_id = :book_id" );
			$stmt->bindParam( ":count_of_book", $count_of_book );
			$stmt->bindParam( ":book_id", $book_id );
			$stmt->execute();
			return $stmt;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function delete_book( $book_id ) {
		try {
			$stmt = $this->db->prepare( "DELETE FROM buku WHERE buku_id = :book_id" );
			$stmt->bindParam( ":book_id", $book_id );
			$stmt->execute();
			return true;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function display_data_status_book() {
		try {
			$stmt = $this->db->prepare( "SELECT * FROM status_buku INNER JOIN buku ON status_buku.buku_id = buku.buku_id" );
			$stmt->execute();
			return $stmt;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function add_status_book( $id_status_buku, $book_id, $date, $information, $optional, $member_id, $biaya_ganti ) {
		try {
			$stmt = $this->db->prepare( "INSERT INTO `status_buku` ( `id_status_buku`, `buku_id`, `tanggal`, `keterangan`, `optional`, `anggota_id`, `biaya_ganti` ) VALUES ( ?, ?, ?, ?, ?, ?, ? )" );
			$stmt->bindParam( 1, $id_status_buku );
			$stmt->bindParam( 2, $book_id );
			$stmt->bindParam( 3, $date );
			$stmt->bindParam( 4, $information );
			$stmt->bindParam( 5, $optional );
			$stmt->bindParam( 6, $member_id );
			$stmt->bindParam( 7, $biaya_ganti );
			$stmt->execute();
			return true;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function get_data_status_book_by_id( $id_status_buku ) {
		try {
			$stmt = $this->db->prepare( "SELECT * FROM status_buku LEFT JOIN buku ON status_buku.buku_id = buku.buku_id WHERE id_status_buku = :id_status_buku" );
			$stmt->bindParam( ":id_status_buku", $id_status_buku );
			$stmt->execute();
			return $stmt;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function update_status_book( $stts_id, $book_id, $date, $information, $optional, $member_id, $biaya_ganti ) {
		try {
			$stmt = $this->db->prepare( 
				"UPDATE status_buku 
				SET buku_id 		 = :book_id, 
					tanggal 		 = :date_stts,
					keterangan		 = :info_stts,
					optional		 = :optional,
					anggota_id		 = :member_id,
					biaya_ganti		 = :biaya_ganti
				WHERE id_status_buku = :stts_id"
			);
			$stmt->bindParam( ":book_id", $book_id );
			$stmt->bindParam( ":date_stts", $date );
			$stmt->bindParam( ":info_stts", $information );
			$stmt->bindParam( ":optional", $optional );
			$stmt->bindParam( ":member_id", $member_id );
			$stmt->bindParam( ":biaya_ganti", $biaya_ganti );
			$stmt->bindParam( ":stts_id", $stts_id );
			$stmt->execute();
			return true;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function delete_status_book( $stts_book_id ) {
		try {
			$stmt = $this->db->prepare( "DELETE FROM status_buku WHERE id_status_buku = :stts_book_id" );
			$stmt->bindParam( ":stts_book_id", $stts_book_id );
			$stmt->execute();
			return true;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}
} // END: Class Books


/**
* -------------------------------------
* Class Member ( Anggota perpustakaan )
* -------------------------------------
*/
class Member extends My_Connection {
	public function __construct() {
		parent::connection();
	}

	public function display_member() {
		try {
			$stmt = $this->db->prepare( "SELECT * FROM anggota" );
			$stmt->execute();
			return $stmt;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function search_member() { 
		// do something ... 
	}

	public function add_member( $type_of_identity, $no_identity, $fullname, $gender, $phone, $email, $address_1, $address_2, $type_of_member, $name_of_institution, $address_of_institution, $deposit, $date_join ) {
		try {
			$stmt = $this->db->prepare( "INSERT INTO anggota ( jenis_identitas, no_identitas, nama_lengkap, jenis_kelamin, no_telp, email, alamat_asal, alamat_saat_ini, jenis_anggota, nama_institusi, alamat_institusi, deposit, tgl_pendaftaran ) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? )" );
			$stmt->bindParam( "1", $type_of_identity );
			$stmt->bindParam( "2", $no_identity );
			$stmt->bindParam( "3", $fullname );
			$stmt->bindParam( "4", $gender );
			$stmt->bindParam( "5", $phone );
			$stmt->bindParam( "6", $email );
			$stmt->bindParam( "7", $address_1 );
			$stmt->bindParam( "8", $address_2 );
			$stmt->bindParam( "9", $type_of_member );
			$stmt->bindParam( "10", $name_of_institution );
			$stmt->bindParam( "11", $address_of_institution );
			$stmt->bindParam( "12", $deposit );
			// $stmt->bindParam( "13", $photo );
			$stmt->bindParam( "13", $date_join );
			$stmt->execute();
			return true;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function get_data_member_by_id( $member_id ) {
		try {
			$stmt = $this->db->prepare( "SELECT * FROM anggota WHERE anggota_id = :member_id" );
			$stmt->bindParam( ":member_id", $member_id );
			$stmt->execute();
			return $stmt;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function update_member( $member_id, $type_of_identity, $no_identity, $fullname, $gender, $phone, $email, $address_1, $address_2, $type_of_member, $name_of_institution, $address_of_institution, $deposit ) {
		try {
			$stmt = $this->db->prepare( 
				"UPDATE anggota 
				SET jenis_identitas = :type_of_identity,
				no_identitas 		= :no_identity,
				nama_lengkap 		= :fullname,
				jenis_kelamin 		= :gender,
				no_telp 			= :phone,
				email 				= :email,
				alamat_asal 		= :address_1,
				alamat_saat_ini 	= :address_2,
				jenis_anggota 		= :type_of_member,
				nama_institusi 		= :name_of_institution,
				alamat_institusi	= :address_of_institution,
				deposit				= :deposit
				WHERE anggota_id 	= :member_id"
			);
			$stmt->bindParam( ":type_of_identity", $type_of_identity );
			$stmt->bindParam( ":no_identity", $no_identity );
			$stmt->bindParam( ":fullname", $fullname );
			$stmt->bindParam( ":gender", $gender );
			$stmt->bindParam( ":phone", $phone );
			$stmt->bindParam( ":email", $email );
			$stmt->bindParam( ":address_1", $address_1 );
			$stmt->bindParam( ":address_2", $address_2 );
			$stmt->bindParam( ":type_of_member", $type_of_member );
			$stmt->bindParam( ":name_of_institution", $name_of_institution );
			$stmt->bindParam( ":address_of_institution", $address_of_institution );
			$stmt->bindParam( ":deposit", $deposit );
			$stmt->bindParam( ":member_id", $member_id );
			$stmt->execute();
			return $stmt;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	// public function update_member_without_photo( $member_id, $type_of_identity, $no_identity, $fullname, $gender, $phone, $email, $address_1, $address_2, $type_of_member, $name_of_institution, $address_of_institution ) {
	// 	try {
	// 		$stmt = $this->db->prepare(
	// 			"UPDATE anggota 
	// 			SET jenis_identitas = :type_of_identity,
	// 			no_identitas 		= :no_identity,
	// 			nama_lengkap 		= :fullname,
	// 			jenis_kelamin 		= :gender,
	// 			no_telp 			= :phone,
	// 			email 				= :email,
	// 			alamat_asal 		= :address_1,
	// 			alamat_saat_ini 	= :address_2,
	// 			jenis_anggota 		= :type_of_member,
	// 			nama_institusi 		= :name_of_institution,
	// 			alamat_institusi	= :address_of_institution
	// 			WHERE anggota_id 	= :member_id" 
	// 		);
	// 		$stmt->bindParam( ":type_of_identity", $type_of_identity );
	// 		$stmt->bindParam( ":no_identity", $no_identity );
	// 		$stmt->bindParam( ":fullname", $fullname );
	// 		$stmt->bindParam( ":gender", $gender );
	// 		$stmt->bindParam( ":phone", $phone );
	// 		$stmt->bindParam( ":email", $email );
	// 		$stmt->bindParam( ":address_1", $address_1 );
	// 		$stmt->bindParam( ":address_2", $address_2 );
	// 		$stmt->bindParam( ":type_of_member", $type_of_member );
	// 		$stmt->bindParam( ":name_of_institution", $name_of_institution );
	// 		$stmt->bindParam( ":address_of_institution", $address_of_institution );
	// 		$stmt->bindParam( ":member_id", $member_id );
	// 		$stmt->execute();
	// 		return $stmt;
	// 	} catch( PDOException $e ) {
	// 		echo $e->getMessage();
	// 		return false;
	// 	}
	// }

	public function delete_member( $member_id ) {
		try {
			$stmt = $this->db->prepare( "DELETE FROM anggota WHERE anggota_id = :member_id" );
			$stmt->bindParam( ":member_id", $member_id );
			$stmt->execute();
			return true;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}
} // END: Class Member ( Anggota perpustakaan )


/**
* -------------------------------------
* Class Borrowing ( Peminjaman )
* -------------------------------------
*/
class Borrowing extends My_Connection {
	public function __construct() {
		parent::connection();
	}

	public function display_borrowing() {
		try {
			$stmt = $this->db->prepare( "SELECT * FROM peminjaman JOIN anggota ON peminjaman.anggota_id = anggota.anggota_id ORDER BY id_peminjaman DESC" );
			$stmt->execute();
			return $stmt;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function display_borrowing_filter_based_date( $start_date, $last_date ) {
		try {
			$stmt = $this->db->prepare( 
				"SELECT * FROM peminjaman 
				JOIN anggota ON peminjaman.anggota_id = anggota.anggota_id
				WHERE tgl_pinjam 
				BETWEEN '$start_date' AND '$last_date'"
			 );
			$stmt->execute();
			return $stmt;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function get_maxid_by_data_borrowing() {
		try {
			$stmt = $this->db->prepare( "SELECT max(id_peminjaman) AS max_id FROM peminjaman" );
			$stmt->execute();
			return $stmt;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function add_borrowing( $borrowing_id, $member_id, $date_borrowing, $due_date ) {
		try {
			$stmt = $this->db->prepare( "INSERT INTO peminjaman ( id_peminjaman, anggota_id, tgl_pinjam , tgl_jatuh_tempo, status_peminjaman ) VALUES ( ?, ?, ?, ?, '-1' )" );
			$stmt->bindParam( "1", $borrowing_id );
			$stmt->bindParam( "2", $member_id );
			$stmt->bindParam( "3", $date_borrowing );
			$stmt->bindParam( "4", $due_date );
			$stmt->execute();
			return true;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function get_data_borrowing_by_id( $borrowing_id ) {
		try {
			$stmt = $this->db->prepare( "SELECT * FROM peminjaman JOIN anggota ON peminjaman.anggota_id = anggota.anggota_id WHERE id_peminjaman = :borrowing_id" );
			$stmt->bindParam( ":borrowing_id", $borrowing_id );
			$stmt->execute();
			return $stmt;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function get_user_in_borrowing_based_status_borrowing( $member_id, $status_borrowing ) {
		try {
			$stmt = $this->db->prepare( "SELECT anggota_id FROM peminjaman WHERE anggota_id = :member_id AND status_peminjaman = :status_borrowing" );
			$stmt->bindParam( ":member_id", $member_id );
			$stmt->bindParam( ":status_borrowing", $status_borrowing );
			$stmt->execute();
			return $stmt;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function update_borrowing( $borrowing_id, $member_id, $date_borrowing, $due_date ) {
		try {
			$stmt = $this->db->prepare( 
				"UPDATE peminjaman 
				SET anggota_id 		= :member_id, 
					tgl_pinjam 		= :date_borrowing, 
					tgl_jatuh_tempo = :due_date 
				WHERE id_peminjaman = :borrowing_id"
			);
			$stmt->bindParam( ":member_id", $member_id );
			$stmt->bindParam( ":date_borrowing", $date_borrowing );
			$stmt->bindParam( ":due_date", $due_date );
			$stmt->bindParam( ":borrowing_id", $borrowing_id );
			$stmt->execute();
			return $stmt;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function update_status_borrowing( $borrowing_id, $status_borrowing ) {
		try {
			$stmt = $this->db->prepare( 
				"UPDATE peminjaman 
				SET status_peminjaman = :status_borrowing
				WHERE id_peminjaman	  = :borrowing_id"
			);
			$stmt->bindParam( ":status_borrowing", $status_borrowing );
			$stmt->bindParam( ":borrowing_id", $borrowing_id );
			$stmt->execute();
			return $stmt;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function delete_borrowing( $borrowing_id ) {
		try {
			$stmt = $this->db->prepare( "DELETE FROM peminjaman WHERE id_peminjaman = :borrowing_id" );
			$stmt->bindParam( ":borrowing_id", $borrowing_id );
			$stmt->execute();
			return true;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	// TAMBAH PEMINJAMAN DETAIL ( List peminjaman )
	public function add_detail_borrowing( $borrowing_id, $book_id, $session_id ) {
		try {
			$stmt = $this->db->prepare( "INSERT INTO detail_peminjaman ( id_peminjaman, buku_id, session_id ) VALUES ( ?, ?, ? )" );
			$stmt->bindParam( "1", $borrowing_id );
			$stmt->bindParam( "2", $book_id );
			$stmt->bindParam( "3", $session_id );
			$stmt->execute();
			return true;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function display_detail_borrowing() {
		try {
			$stmt = $this->db->prepare( "SELECT * FROM detail_peminjaman INNER JOIN buku ON detail_peminjaman.buku_id = buku.buku_id" );
			$stmt->execute();
			return $stmt;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	// Mengecek jumlah peminjaman buku
	public function get_count_book_detail_borrowing( $book_id, $session_id ) {
		try {
			$stmt = $this->db->prepare( "SELECT COUNT(detail_peminjaman.buku_id) AS count_book FROM detail_peminjaman WHERE id_peminjaman = '' AND buku_id = :book_id AND session_id = :session_id" );
			$stmt->bindParam( ":book_id", $book_id );
			$stmt->bindParam( ":session_id", $session_id );
			$stmt->execute();
			return $stmt;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	// Mendapatkan data detail peminjaman berdasarkan session id ( Session browser )
	public function get_detail_borrowing_by_sess_id( $session_id ) {
		try {
			$stmt = $this->db->prepare( "SELECT * FROM detail_peminjaman INNER JOIN buku ON detail_peminjaman.buku_id = buku.buku_id WHERE id_peminjaman = '' AND session_id = :session_id" );
			$stmt->bindParam( ":session_id", $session_id );
			$stmt->execute();
			return $stmt;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	// Mendapatkan data detail peminjaman berdasarkan id peminjaman
	public function get_detail_borrowing_by_borowing_id( $borrowing_id ) {
		try {
			$stmt = $this->db->prepare( "SELECT * FROM detail_peminjaman INNER JOIN buku ON detail_peminjaman.buku_id = buku.buku_id WHERE id_peminjaman = :borrowing_id" );
			$stmt->bindParam( ":borrowing_id", $borrowing_id );
			$stmt->execute();
			return $stmt;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function get_detail_borrowing_by_id( $detail_borrowing_id ) {
		try {
			$stmt = $this->db->prepare( "SELECT * FROM detail_peminjaman WHERE no = :detail_borrowing_id" );
			$stmt->bindParam( ":detail_borrowing_id", $detail_borrowing_id );
			$stmt->execute();
			return $stmt;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function update_id_peminjaman( $borrowing_id, $session_id ) {
		try {
			$stmt = $this->db->prepare( 
				"UPDATE detail_peminjaman 
				SET id_peminjaman	= :borrowing_id
				WHERE id_peminjaman = '' 
				AND session_id 		= :session_id" 
			);
			$stmt->bindParam( ":borrowing_id", $borrowing_id );
			$stmt->bindParam( ":session_id", $session_id );
			$stmt->execute();
			return true;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function delete_detail_borrowing( $detail_borrowing_id ) {
		try {
			$stmt = $this->db->prepare( "DELETE FROM detail_peminjaman WHERE no = :detail_borrowing_id" );
			$stmt->bindParam( ":detail_borrowing_id", $detail_borrowing_id );
			$stmt->execute();
			return true;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function delete_detail_borrowing_by_borrowing_id( $borrowing_id ) {
		try {
			$stmt = $this->db->prepare( "DELETE FROM detail_peminjaman WHERE id_peminjaman = :borrowing_id" );
			$stmt->bindParam( ":borrowing_id", $borrowing_id );
			$stmt->execute();
			return true;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	// public function delete_detail_borrowing_with_interval() {
	// 	try {
	// 		$stmt = $this->db->prepare( "DELETE FROM cart WHERE DATE_ADD(`time`, INTERVAL 2 HOUR) < NOW()" );  // interval 2 jam
	// 		// $stmt->bindParam( ":detail_borrowing_id", $detail_borrowing_id );
	// 		$stmt->execute();
	// 		return true;
	// 	} catch( PDOException $e ) {
	// 		echo $e->getMessage();
	// 		return false;
	// 	}
	// }
} // END: Class Borrowing ( Peminjaman )


/**
* -------------------------------------
* Class Returning ( Pengembalian )
* -------------------------------------
*/
class Returning extends My_Connection {
	public function __construct() {
		parent::connection();
	}

	public function display_returning() {
		try {
			$stmt = $this->db->prepare( "SELECT pengembalian.pengembalian_id, pengembalian.id_peminjaman, anggota.nama_lengkap, peminjaman.tgl_pinjam, 
												peminjaman.tgl_jatuh_tempo, pengembalian.tgl_kembali, pengembalian.denda
											FROM pengembalian 
											LEFT JOIN peminjaman ON pengembalian.id_peminjaman = peminjaman.id_peminjaman 
											LEFT JOIN anggota ON peminjaman.anggota_id = anggota.anggota_id 
											ORDER BY pengembalian.pengembalian_id DESC" );
			$stmt->execute();
			return $stmt;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function display_returning_filter_based_date( $start_date, $last_date ) {
		try {
			$stmt = $this->db->prepare( 
				"SELECT * FROM pengembalian 
				JOIN peminjaman ON pengembalian.id_peminjaman = peminjaman.id_peminjaman
				WHERE tgl_kembali 
				BETWEEN '$start_date' AND '$last_date'"
			 );
			$stmt->execute();
			return $stmt;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function insert_returning( $borrowing_id, $date_returning, $denda ) {
		try {
			$stmt = $this->db->prepare( "INSERT INTO pengembalian ( id_peminjaman, tgl_kembali, denda ) VALUES ( ?, ?, ? )" );
			$stmt->bindParam( "1", $borrowing_id );
			$stmt->bindParam( "2", $date_returning );
			$stmt->bindParam( "3", $denda );
			$stmt->execute();
			return true;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function get_returning_by_id( $returning_id ) {
		try {
			$stmt = $this->db->prepare( "SELECT * FROM pengembalian WHERE pengembalian_id = :returning_id" );
			$stmt->bindParam( ":returning_id", $returning_id );
			$stmt->execute();
			return $stmt;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function get_returning_by_borrowing_id( $borrowing_id ) {
		try {
			$stmt = $this->db->prepare( "SELECT pengembalian_id, id_peminjaman, tgl_kembali, denda FROM pengembalian WHERE id_peminjaman = :borrowing_id" );
			$stmt->bindParam( ":borrowing_id", $borrowing_id );
			$stmt->execute();
			return $stmt;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}
} // END: Class Returning ( Pengembalian )


/**
* -------------------------------------
* Class Kas
* -------------------------------------
*/
class Kas extends My_Connection {
	public function __construct() {
		parent::connection();
	}

	public function display_kas() {
		try {
			$stmt = $this->db->prepare( 
				"SELECT kas_perpus.id_kas, kas_perpus.kas, kas_perpus.id_status_buku, kas_perpus.pengembalian_id, anggota.nama_lengkap, peminjaman.id_peminjaman, status_buku.tanggal, pengembalian.tgl_kembali 
				FROM kas_perpus 
				LEFT JOIN status_buku ON kas_perpus.id_status_buku = status_buku.id_status_buku 
				LEFT JOIN pengembalian ON kas_perpus.pengembalian_id = pengembalian.pengembalian_id
				LEFT JOIN peminjaman ON pengembalian.id_peminjaman = peminjaman.id_peminjaman 
				LEFT JOIN anggota ON peminjaman.anggota_id = anggota.anggota_id"
			);
			$stmt->execute();
			return $stmt;
		} catch ( Exception $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function display_kas_filter_based_date( $start_date, $last_date ) {
		try {
			$stmt = $this->db->prepare( 
				"SELECT *
				FROM kas_perpus 
				LEFT JOIN status_buku ON kas_perpus.id_status_buku = status_buku.id_status_buku 
				LEFT JOIN pengembalian ON kas_perpus.pengembalian_id = pengembalian.pengembalian_id
				WHERE tanggal 
				BETWEEN '$start_date' AND '$last_date'
				OR tgl_kembali 
				BETWEEN '$start_date' AND '$last_date'"
			 );
			$stmt->execute();
			return $stmt;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function add_kas( $returning_id, $status_book_id, $kas ) {
		try {
			$stmt = $this->db->prepare( "INSERT INTO `kas_perpus` ( `pengembalian_id`, `id_status_buku`, `kas` ) VALUES ( ?, ?, ? )" );
			$stmt->bindParam( 1, $returning_id );
			$stmt->bindParam( 2, $status_book_id );
			$stmt->bindParam( 3, $kas );
			$stmt->execute();
			return true;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function update_kas_based_stts_book_id( $stts_book_id, $kas ) {
		try {
			$stmt = $this->db->prepare( 
				"UPDATE kas_perpus 
				SET kas	= :kas
				WHERE pengembalian_id = '0' 
				AND id_status_buku = :stts_book_id" 
			);
			$stmt->bindParam( ":kas", $kas );
			$stmt->bindParam( ":stts_book_id", $stts_book_id );
			$stmt->execute();
			return true;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function delete_kas_based_stts_book_id( $stts_book_id ) {
		try {
			$stmt = $this->db->prepare( "DELETE FROM kas_perpus WHERE pengembalian_id = '0' AND id_status_buku = :stts_book_id" );
			$stmt->bindParam( ":stts_book_id", $stts_book_id );
			$stmt->execute();
			return true;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}
} // END: Class Kas


/**
* -------------------------------------
* Class Messages
* -------------------------------------
*/
class Messages extends My_Connection {
	public function __construct() {
		parent::connection();
	}

	public function display_message() {
		try {
			$stmt = $this->db->prepare( "SELECT * FROM pesan" );
			$stmt->execute();
			return $stmt;
		} catch ( Exception $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function send_messages( $name, $email, $phone, $message ) {
		try {
			$stmt = $this->db->prepare( "INSERT INTO `pesan` ( `nama`, `email`, `telp`, `isi_pesan` ) VALUES ( ?, ?, ?, ? )" );
			$stmt->bindParam( 1, $name );
			$stmt->bindParam( 2, $email );
			$stmt->bindParam( 3, $phone );
			$stmt->bindParam( 4, $message );
			$stmt->execute();
			return true;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function delete_message( $message_id ) {
		try {
			$stmt = $this->db->prepare( "DELETE FROM pesan WHERE id_pesan = :message_id" );
			$stmt->bindParam( ":message_id", $message_id );
			$stmt->execute();
			return true;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}
} // END: Class Messages


/**
* -------------------------------------
* Class Banner Slider
* -------------------------------------
*/
class Slider extends My_Connection {
	public function __construct() {
		parent::connection();
	}

	public function display_slider() {
		try {
			$stmt = $this->db->prepare( "SELECT * FROM fitur_slider" );
			$stmt->execute();
			return $stmt;
		} catch ( Exception $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function add_slider( $title, $information, $image ) {
		try {
			$stmt = $this->db->prepare( "INSERT INTO `fitur_slider` ( `judul`, `keterangan`, `gambar` ) VALUES ( ?, ?, ? )" );
			$stmt->bindParam( 1, $title );
			$stmt->bindParam( 2, $information );
			$stmt->bindParam( 3, $image );
			$stmt->execute();
			return true;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}

	public function get_banner_img_by_id( $banner_id ) {
		try {
			$stmt = $this->db->prepare( "SELECT gambar FROM fitur_slider WHERE id_slider = :banner_id" );
			$stmt->bindParam( ":banner_id", $banner_id );
			$stmt->execute();
			return $stmt;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}


	public function delete_slider( $banner_id ) {
		try {
			$stmt = $this->db->prepare( "DELETE FROM fitur_slider WHERE id_slider = :banner_id" );
			$stmt->bindParam( ":banner_id", $banner_id );
			$stmt->execute();
			return true;
		} catch( PDOException $e ) {
			echo $e->getMessage();
			return false;
		}
	}
} // END: Class Slider