<?php
$page = isset( $_GET['p'] ) ? $_GET['p'] : '';

if ( $page == "" ) {
	include "dashboard.php";
}
elseif ( $page == "petugas" ) {
	include "petugas.php";
}
elseif ( $page == "buku" ) {
	include "buku.php";
}
elseif ( $page == "edit-buku" ) {
	include "buku-edit.php";
}
elseif ( $page == "kategori" ) {
	include "kategori.php";
}
elseif ( $page == "edit-kategori" ) {
	include "kategori-edit.php";
}
elseif ( $page == "anggota" ) {
	include "anggota.php";
}
elseif ( $page == "edit-anggota" ) {
	include "anggota-edit.php";
}
elseif ( $page == "peminjaman" ) {
	include "peminjaman.php";
}
elseif ( $page == "detail-peminjaman" ) {
	include "peminjaman-detail.php";
}
elseif ( $page == "list-peminjaman" ) {
	include "peminjaman-list.php";
}
elseif ( $page == "edit-peminjaman" ) {
	include "peminjaman-edit.php";
}
elseif ( $page == "pengembalian" ) {
	include "pengembalian.php";
}
elseif ( $page == "edit-pengembalian" ) {
	include "pengembalian-edit.php";
}
elseif ( $page == "profile" ) {
	include "pengaturan-profile-petugas.php";
}
elseif ( $page == "data-status-buku" ) {
	include "data-status-buku.php";
}
elseif ( $page == "edit-status-buku" ) {
	include "data-status-buku-edit.php";
}
elseif ( $page == "kas-perpus" ) {
	include "kas-perpus.php";
}
elseif ( $page == "laporan" ) {
	include "laporan.php";
}
elseif ( $page == "pesan-masuk" ) {
	include "pesan-masuk.php";
}
elseif ( $page == "slideshow" ) {
	include "slideshow.php";
}
else {
	include "404.php";
}
