<?php

$page = isset( $_GET['p'] ) ? $_GET['p'] : '';
if ( $page == "" ) {
	include "homepage.php";
}
elseif ( $page == "tentang-kami" ) {
	include "tentang-kami.php";
}
elseif ( $page == "buku-perpustakaan" ) {
	include "buku-perpustakaan.php";
}
elseif ( $page == "detail-buku" ) {
	include "detail-buku.php";
}
// elseif ( $page == "pencarian" ) {
// 	include "search.php";
// }
else {
	include "404.php";
}
