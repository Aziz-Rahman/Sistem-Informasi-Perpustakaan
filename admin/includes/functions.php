<?php
/**
 * Functions / My library
 * ----------------------------------------
 * By Aziz Rahman Aji
 * ----------------------------------------
 */


/**
 * ----------------------------------------
 * ANTI INJECTION
 * ----------------------------------------
 */
if ( ! function_exists( 'anti_injection' ) ) {
	function anti_injection( $data ) {
		$filter = stripslashes( strip_tags( htmlspecialchars( $data,ENT_QUOTES ) ) );
		return $filter;
	}
}


/**
 * ----------------------------------------
 * ENCYRPTION PASSWORD
 * ----------------------------------------
 */
if ( ! function_exists( 'encyript_password' ) ) {
	function encyript_password( $password ) {
		$salt = '!@#$%^&*()<>?:9876543210';
		return md5( $password.md5( $password.$salt ) );
	}
}


/**
 * ----------------------------------------
 * HITUNG DENDA
 * ----------------------------------------
 */
if ( ! function_exists( 'hitung_denda' ) ) {
	function hitung_denda( $tgl_kembali, $tgl_jatuh_tempo ) {
	    if ( strtotime( $tgl_kembali ) > strtotime( $tgl_jatuh_tempo ) ) {
	        $kembali = new DateTime( $tgl_kembali ); 
	        $jatuh_tempo = new DateTime( $tgl_jatuh_tempo ); 

	        $selisih = $kembali->diff( $jatuh_tempo );
	        $selisih = $selisih->format( '%d' );

	        $denda = 2000 * $selisih;
	    } else {
	        $denda = 0;
	    }
	    return $denda;
	}
}


/**
 * ----------------------------------------
 * RANDOM CHAR
 * ----------------------------------------
 */
if ( ! function_exists( 'random_char' ) ) {
	function random_char( $filename, $length ) {
		$char = 'abcdefghijklmnopqrstuvwqyz1234567890'. $filename;
		$str_replace = str_replace( array( ' ', '.', ',', '+', ':', '/', '*', '^', '%', '$', '#', '(', ')', '_', '-' ), '', $char );
		$shuffle_string = substr( str_shuffle( $str_replace ), 0, $length ); // exp use substr ->> substr( $str, 0, 5 );
		return $shuffle_string;
	}
}
// str_shuffle -> random character
// shuffle -> random char with array, 
// ex: $my_array = array("red","green","blue","yellow","purple"); shuffle( $my_array );


/**
 * ----------------------------------------
 * LIMIT CHAR
 * ----------------------------------------
 */
if ( ! function_exists( 'limitChar' ) ) {
	function limitChar( $content, $limit ) {
	    if ( strlen( $content ) <= $limit ) {
	        return $content;
	    } else {
	        $excerpt = substr( $content, 0, $limit );
	        return $excerpt ." ... ";
	    }
	}
}


/**
 * ----------------------------------------
 * LIMIT WORD
 * ----------------------------------------
 */
if ( ! function_exists( 'limitWord' ) ) {
	function limitWord( $string, $word_limit ) {
	   $words = explode( " ", $string );
	   return implode( " ", array_splice( $words, 0, $word_limit ) );
	}
}


/**
 * ----------------------------------------
 * FORMAT NUMBER (RUPIAH)
 * ----------------------------------------
 */
if ( ! function_exists( 'idr' ) ) {
	function idr( $number ) {
		$money = "Rp ". number_format( $number,2,',','.' );
	return $money;
	}
}


/**
 * ----------------------------------------
 * GET BASE URL
 * ----------------------------------------
 */
if ( ! function_exists( 'base_url' ) ) {
	function base_url() {
		return sprintf(
			"%s://%s%s",
			isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
			$_SERVER['SERVER_NAME'],
			$_SERVER['REQUEST_URI']
		);
	}
}
// echo base_url();
