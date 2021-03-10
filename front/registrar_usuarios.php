<?php 
	include('../back/url.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include('etiquetas/head.php'); ?>
</head>
<body id="sesion">
	<div class="form-signin">
	      <h1 class="h3 mb-3 fw-normal">Registrar Entrenador!</h1>
	      <label for="name" class="visually-hidden">Nombre</label>
	      <input type="text" id="name" class="form-control" placeholder="Nombre de entrenador" required="">

	      <label for="email" class="visually-hidden">Email</label>
	      <input type="email" id="email" class="form-control" placeholder="Email" required="" autofocus="">

	      <label for="pass" class="visually-hidden">Contraseña</label>
	      <input type="password" id="pass" class="form-control" placeholder="Contraseña" required="">

	      <button class="w-100 btn btn-lg btn-primary" id="registrar" type="submit">Registrarme</button>
	      <div><a href="<?php echo $host ?>">Tengo cuenta!</a></div>
	</div> 
</body>
<?php include('etiquetas/js.php'); ?>
</html>
