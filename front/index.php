<?php 
	include('back/url.php'); 
?>
<!DOCTYPE html>
<html>
<head>
	<?php include('front/etiquetas/head.php'); ?>
</head> 
<body id="sesion">
	<div class="form-signin">
		<h1 class="h3 mb-3 fw-normal">Bienvenido Entrenador!</h1>
		<label for="email" class="visually-hidden">Email</label>
		<input type="email" id="email" class="form-control" placeholder="Email" required="" autofocus="">

		<label for="pass" class="visually-hidden">Contraseña</label>
		<input type="password" id="pass" class="form-control" placeholder="Contraseña" required="">

		<button class="w-100 btn btn-lg btn-primary" type="submit" id="ingresar">Ingresar</button>
		<div><a href="<?php echo $host ?>front/registrar_usuarios.php">No tengo cuenta!</a></div>
	</div> 
</body>
<?php include('front/etiquetas/js.php'); ?>
</html>