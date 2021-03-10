<?php 
	

	function base_de_datos(){
		$servername = "localhost";
		$username = "root";
		$password = "";
		$base_de_datos = "pokemon";

		// Create connection
		$nombreConexion = mysqli_connect($servername , $username , $password);
		// Check connection
		mysqli_select_db($nombreConexion, "pokemon");
		return $nombreConexion;
	}

	function agregar_usuarios($conexion, string $nombre, string $email, string $pass_encriptado){
		$agregar_usuario = mysqli_query($conexion, "INSERT INTO `usuarios`(`nombre`, `email`, `pass`) VALUES ('$nombre','$email','$pass_encriptado')");
		//echo '<pre>'; print_r($agregar_usuario); echo '</pre>';

		if ($agregar_usuario=='1') {

			session_start();

			$_SESSION['nombre']= $nombre;
			$_SESSION['email']= $email;
			$_SESSION['pass']= $pass_encriptado;

			$mensaje='Su cuenta se creo con exito';

			return $mensaje;

		} else {

			$mensaje='Hubo un error';

			return $mensaje;
		}
	}

	function agregar_equipos($conexion, int $id, string $nombre, string $seleccion_favorito, string $checks){
		$agregar_equipos= mysqli_query($conexion, "INSERT INTO `equipo`(`id_usuario`, `nombre`, `pokemon`, `favorito`) VALUES ('$id','$nombre','$checks','$seleccion_favorito')");

		if ($agregar_equipos=='1') {

			$mensaje='Su equipo '.$nombre.' se creo con exito';

			return $mensaje;

		} else {

			$mensaje='Hubo un error';

			return $mensaje;
		}
	}

	function obtener_registros(){

		$conexion=base_de_datos();
		
		$obtener_registros= mysqli_query($conexion, "SELECT * FROM competencia ");

		return $obtener_registros;
	}

	function agregar_registros($conexion, string $usuarios, string $equipos, string $ganador){

		$fecha=date("Y/m/d");

		$agregar_registros= mysqli_query($conexion, "INSERT INTO competencia (`usuarios`, `equipos`, `ganador`, `fecha`) VALUES ('$usuarios','$equipos','$ganador','$fecha')");

		if ($agregar_registros=='1') {

			$mensaje='ok';

			return $mensaje;

		} else {

			$mensaje='Hubo un error';

			return $mensaje;
		}
	}

	function agregar_oponente($conexion, int $id, string $nombre_entrenador, string $nombre, string $checks){
		$agregar_oponente= mysqli_query($conexion, "INSERT INTO `usuario_para_competir`(`id_usuario`, `usuario`, `nombre_equipo`, `pokemon`) VALUES ('$id','$nombre_entrenador','$nombre','$checks')");

		if ($agregar_oponente=='1') {

			$mensaje='oponente agregado';

			return $mensaje;

		} else {

			$mensaje='Hubo un error';

			return $mensaje;
		}
	}

	function actualizar_oponente($conexion, int $id, string $nombre, string $nombre_entrenador, string $checks){

		$buscar_oponente = mysqli_query($conexion, "SELECT * FROM usuario_para_competir where id_usuario = '$id'");

		mysqli_data_seek ($buscar_oponente, 0);

		$extraer_datos= mysqli_fetch_array($buscar_oponente);

		if (isset($extraer_datos['id'])) {

			$modificar_equipo= mysqli_query($conexion, "UPDATE `usuario_para_competir` SET `nombre_equipo`='$nombre',`pokemon`='$checks' WHERE id_usuario = '$id'");

			if ($modificar_equipo=='1') {

				$mensaje='oponente actualizado';

				return $mensaje;

			} else {

				$mensaje='Hubo un error';

				return $mensaje;
			}

		} else {

			$agregar_oponente=agregar_oponente($conexion, $id, $nombre_entrenador, $nombre, $checks);
			echo $agregar_oponente;


		}
	}

	function obtener_equipos(int $id){

		$conexion=base_de_datos();

		$obtener_equipos = mysqli_query($conexion, "SELECT * FROM equipo where id_usuario = '$id'");

		mysqli_data_seek ($obtener_equipos, 0);

		return $obtener_equipos;
	}

	function obtener_oponentes(int $id){

		$conexion=base_de_datos();

		$obtener_oponentes = mysqli_query($conexion, "SELECT * FROM usuario_para_competir where (NOT id_usuario = '$id')");

		return $obtener_oponentes;
	}

	function obtener_competencia(int $id){

		$conexion=base_de_datos();

		$obtener_oponentes = mysqli_query($conexion, "SELECT * FROM usuario_para_competir where id_usuario = '$id'");

		return $obtener_oponentes;
	}

	function obtener_pokemon(){
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://pokeapi.co/api/v2/pokemon/?offset=0&limit=10",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
			  "cache-control: no-cache",
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			$response=json_decode($response);
		}

		return $response;

	}
	function obtener_info_pokemon(string $id){

		$curl = curl_init();

          curl_setopt_array($curl, array(
            CURLOPT_URL => "https://pokeapi.co/api/v2/pokemon/".$id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
              "cache-control: no-cache",
            ),
          ));

          $response = curl_exec($curl);
          $err = curl_error($curl);

          curl_close($curl);

          if ($err) {
            echo "cURL Error #:" . $err;
          } else {
            $response=json_decode($response);
            return $response;
          }
	}


?>