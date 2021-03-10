<?php 
	require('function.php');

	$email=$_POST['email'];
	//echo '<pre>'; print_r($email); echo '</pre>';
	$pass=$_POST['pass'];

	$pass_encriptado=crypt($email, $pass); 
	//echo '<pre>'; print_r($pass_encriptado); echo '</pre>';

	$conexion=base_de_datos();
	//echo '<pre>'; print_r($conexion); echo '</pre>';

	$buscar_usuario = mysqli_query($conexion, "SELECT * FROM usuarios where email = '$email'");
	//echo '<pre>'; print_r($buscar_usuario); echo '</pre>';

	mysqli_data_seek ($buscar_usuario, 0);

	$extraer_datos= mysqli_fetch_array($buscar_usuario);
	//echo '<pre>'; print_r($extraer_datos); echo '</pre>';

	if (isset($extraer_datos['email'])) {

		$email_BD=$extraer_datos['email'];
		//echo '<pre>'; print_r($email_BD); echo '</pre>';
		$pass_BD=$extraer_datos['pass'];
		//echo '<pre>'; print_r($pass_BD); echo '</pre>';
		$id_BD=$extraer_datos['id'];
		//echo '<pre>'; print_r($id_BD); echo '</pre>';
		$nombre_BD=$extraer_datos['nombre'];
		//echo '<pre>'; print_r($nombre_BD); echo '</pre>';

		if ($pass_encriptado===$pass_BD) {

			session_start();

			$_SESSION['nombre']= $nombre_BD;
			$_SESSION['email']= $email_BD;
			$_SESSION['pass']= $pass_BD;
			$_SESSION['id']= $id_BD;

			echo 'Contraseña coinciden';

		} else {
			echo "Contraseña incorrecta";
		}
	


	} else {
		echo "No esta registrado";

	}
?>