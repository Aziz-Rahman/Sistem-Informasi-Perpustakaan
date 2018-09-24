<?php
session_start();
include_once 'includes/class.php';

$logout = new Librarian();
$logout->logout();
echo "<meta http-equiv='refresh' content='0; url=login.php'>"; // redirect to page login
// END: Logout system