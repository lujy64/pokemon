<?php 
	require('function.php');

	$nombre=$_POST['nombre'];
	//echo '<pre>'; print_r($nombre); echo '</pre>';
	$email=$_POST['email'];
	//echo '<pre>'; print_r($email); echo '</pre>';
	$pass=$_POST['pass'];

	$pass_encriptado=crypt($email, $pass); 
	//echo '<pre>'; print_r($pass_encriptado); echo '</pre>';

	$conexion=base_de_datos();
	//echo '<pre>'; print_r($conexion); echo '</pre>';

	$buscar_usuario = mysqli_query($conexion, "SELECT * FROM usuarios where email = '$email'");

	mysqli_data_seek ($buscar_usuario, 0);

	$extraer_datos= mysqli_fetch_array($buscar_usuario);
	//echo '<pre>'; print_r($extraer_datos); echo '</pre>';

	if (isset($extraer_datos['email'])) {

		$email_BD=$extraer_datos['email'];

		if ($email_BD==$email) {

			echo 'Su email ya se encuentra registrado';

		} else {

			$agregar_usuario=agregar_usuarios($conexion, $nombre, $email, $pass_encriptado);
			echo $agregar_usuario;
		}

	} else {

		$agregar_usuario=agregar_usuarios($conexion, $nombre, $email, $pass_encriptado);
		echo $agregar_usuario;

	}
?>