<?php 
	session_start();

	require('function.php');

	$id_equipo=$_GET['id'];

	$conexion=base_de_datos();

	$id_usuario=intval($_SESSION['id']);

	$eliminar_equipos = mysqli_query($conexion, "DELETE FROM equipo where id = '$id_equipo'");

	if ($eliminar_equipos=='1') {
		header('Location: ../front/panel.php?e=o');
	} else {
		header('Location: ../front/panel.php?e=e');
	}
	
?>