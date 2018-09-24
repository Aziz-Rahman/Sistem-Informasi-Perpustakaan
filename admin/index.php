<?php
session_start();
require_once 'includes/functions.php';
include_once 'includes/class.php';

$ad = new Librarian(); // instansiasi obj
$admin = $ad->get_sessi(); // get session
$admin_name = $ad->get_name_and_photo_librarian_by_id( $admin );
$adminLogin = $admin_name->fetch( PDO::FETCH_ASSOC );

if ( ! $admin ) {
    header( 'location:login.php' );
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Administrator</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/select/select2.min.css" rel="stylesheet">
    <link href="css/datatables/tools/css/dataTables.tableTools.css" rel="stylesheet">
    <link href="css/floatexamples.css" rel="stylesheet" />
    <link href="css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    <!-- Js -->
    <script src="js/jquery.min.js"></script>
</head>

<body class="nav-md">
    <div id="preloader">
        <img src="images/loading.gif" alt="Preloader">
    </div>

    <div class="container body">
        <div class="main_container">
            <?php include 'top.php'; ?>
            <?php include 'sidebar.php'; ?>

            <div class="right_col" role="main">
                 <?php include 'includes/load-pages.php'; // Load pages ?>
            </div>
        </div>
    </div>

    <script src="js/bootstrap.min.js"></script>
    <script src="js/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="js/datepicker/bootstrap-datepicker.min.js"></script>
    <script src="js/select/select2.full.js"></script>
    <script src="js/datatables/js/jquery.dataTables.js"></script>
    <script src="js/pace/pace.min.js"></script>
    <script src="js/highcharts.js"></script>
    <!-- <script src="js/exporting.js"></script> -->
    <script src="js/functions.js"></script>
     
</body>
</html>