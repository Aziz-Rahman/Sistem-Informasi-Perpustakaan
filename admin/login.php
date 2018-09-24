<?php
session_start();
include_once 'includes/class.php';

$ad = new Librarian(); // instansiasi obj
$admin = $ad->get_sessi(); // get session

if ( $admin ) {
	echo "<script>location='./';</script>"; // jika ada sessi mk akan diriderect langsuk ke halaman admin
}

if ( isset( $_POST['btn-login'] ) ) {
	$login = $ad->check_login( $_POST['username'], $_POST['password'] );
	if ( $login ) {
		echo "<script>location='./';</script>";
	} else {
		echo "<script>alert('Username atau password salah !'); location='login.php';</script>";
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Login halaman admin</title>

	<!-- Bootstrap core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="fonts/css/font-awesome.min.css" rel="stylesheet">
	<link href="css/custom.css" rel="stylesheet">

</head>

<body class="login-page">
	<div id="wrapper-login">
		<div id="login">
			<section class="login_content">
				<form action="" method="post" role="form">
					<h1 class="login-title">Login Administrator</h1>
                    <div>
						<input type="text" name="username" class="form-control" placeholder="Username">
					</div>
					<div>
						<input type="password" name="password" class="form-control" placeholder="Password">
					</div>
					<div>
						<input type="submit" name="btn-login" class="btn btn-danger" value="Sign In">
						<a class="reset_pass" href="#">Lupa password ?</a>
					</div>
					<div class="clearfix"></div>
					<div class="separator">
						<p><?php echo '©'. date( 'Y' ); ?> All Rights Reserved. Perpustakaan Nusantara</p>
						<div class="clearfix"></div>
						<br />
					</div>
				</form>
			<!-- form -->
			</section>
		<!-- content -->
		</div>
	</div>
</body>
</html>