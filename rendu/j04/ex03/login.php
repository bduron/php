<?php
include('auth.php');
session_start();

$_SESSION['loggued_on_user'] = (auth($_GET['login'], $_GET['passwd'])) ? $_GET['login'] : ''; 

if ($_SESSION['loggued_on_user'] != '')
	echo "OK\n";
else
	echo "ERROR\n";
?>
