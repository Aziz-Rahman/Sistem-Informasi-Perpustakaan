<?php
include_once 'admin/includes/functions.php';
include_once 'admin/includes/class.php';
$msg = new Messages();

$name = anti_injection( $_POST['name'] );
$email = anti_injection( $_POST['email'] );
$phone = anti_injection( $_POST['phone'] );
$message = anti_injection( $_POST['messages'] );

if ( empty( $name ) || empty( $email ) || empty( $phone ) || empty( $message ) ) {
	echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><i class="fa fa-exclamation-triangle"></i> Silahkan isi data dengan lengkap dan benar.</div>';
}
elseif ( !preg_match( "/^[a-zA-Z ]*$/",$name ) ) {
	echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><i class="fa fa-exclamation-triangle"></i> Nama tidak valid.</div>';
}
elseif ( filter_var( $email, FILTER_VALIDATE_EMAIL) === false ) {
	echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><i class="fa fa-exclamation-triangle"></i> Alamat email tidak valid.</div>';
} 
elseif ( ! is_numeric( $phone ) ) {
	echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><i class="fa fa-exclamation-triangle"></i> No. Telepon tidak valid</div>';
}
else {
	//if success
	$send = $msg->send_messages( $name, $email, $phone, $message );

	if ( $send ) {
		echo '<div class="alert alert-success">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><i class="fa fa-check"></i> 
			Pesan Anda telah kami terima. Kami akan membalas melalui email/ no. telepon Anda.</div>';
			echo '<script>$("#contact-messages")[0].reset();</script>'; // reset empty
	} else {
	    echo "Gagal terkirim !";
	}
}
