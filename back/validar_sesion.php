<?php 
	session_start();
	
	if (!isset($_SESSION['email'])) {
		header('Location: ../back/salir.php');
	}
?>