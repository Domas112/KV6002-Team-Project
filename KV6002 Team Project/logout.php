<?php 
session_start();
//used to destroy session once logged out
	session_destroy();
	header('location:../index.php?logout=true');
	exit;
?>