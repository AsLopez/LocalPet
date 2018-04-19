<?php 
	session_start();
	require 'database.php';

	if (isset($_SESSION['user_id'])) {
		header('Location: /web/Petry/login.php');
	}

	$message = '';
/*
	if (!empty($_POST['email']) && !empty($_POST['password'])) {
		$sql = "INSERT INTO users publicaciones (usuario_id,titulo,fecha,tipomascota,raza,edad,vacunas,ciudad,barrio,cuidados,incluye,imagen) VALUES (:usuario_id,:titulo,:fecha,:tipomascota,:raza,:edad,:vacunas,:ciudad,:barrio,:cuidados,:incluye,:imagen)";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':email', $_POST['email']);
		$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
		$stmt->bindParam(':password', $password);

		if ($stmt->execute()) {
			$message = 'Usuario creado satisfactoriamente';
		}else {
			$message = 'Error creando su contraseña';
		}
	}

	$subir = mysql_query("INSERT INTO  values ('".$_SESSION['id']."','$titulo,now()','$tipomascota','$raza','$edad,'vacunas','$ciudad','$barrio','$cuidados','$incluye','$imagen')");
                if($subir) {echo '<script>window.location="index.php"</script>';}
*/
?>

<!DOCTYPE html>
<html>
<head>
	<title>PRACTICA</title>
	<link rel="stylesheet" type="text/css" href="estilos/estilos.css">
</head>
<body>
	<?php require 'parciales/header.php' ?>

	<?php if (!empty($message)): ?>
		<p><?= $message ?></p>
	<?php endif ?>

	<h1>Publica un anuncio de adopción</h1>


	<center>
		<div class="datos-publicacion">
			<form action="" method="post" enctype="multipart/form-data">
				<input type="text" name="titulo" placeholder="Titulo de tu publicacion">
				<input type="text" name="tipomascota" placeholder="Tipo de mascota: perro, gato, etc">
				<input type="text" name="raza" placeholder="Raza:">
				<input type="int" name="edad" placeholder="Edad:">
				<input type="text" name="vacunas" placeholder="Vacunas al dia: Si/No">
				<input type="text" name="ciudad" placeholder="Ciudad:">
				<input type="text" name="barrio" placeholder="Barrio:">
				<input type="text" name="cuidados" placeholder="Cuidados: ">
				<textarea name="incluye" placeholder="Incluye: alimento, cama, mantas, etc"></textarea>
				<!-- <input type="file" name="foto" placeholder="Fotos"> -->
				<br><br>
				<!-- START Input file nuevo diseño .-->
				<input type="file" name="foto" id="file-1" class="inputfile inputfile-1" data-multiple-caption="{count} files selected"/>
				<label for="file-1"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Sube una foto</span></label>
				<!-- END Input file nuevo diseño .-->
                <br><br>
                <button type="submit" name="publicar" class="btn btn-primary btn-flat">Publicar</button>
				<!-- <input type="submit" value="Publicar"> -->
			</form>
			<?php 
			if(isset($_POST['publicar']))
			{
				$titulo = mysql_real_escape_string($_POST['titulo']);
				$tipomascota = mysql_real_escape_string($_POST['tipomascota']);
				$raza = mysql_real_escape_string($_POST['raza']);
				$edad = mysql_real_escape_string($_POST['edad']);
				$vacunas = mysql_real_escape_string($_POST['vacunas']);
				$ciudad = mysql_real_escape_string($_POST['ciudad']);
				$barrio = mysql_real_escape_string($_POST['barrio']);
				$cuidados = mysql_real_escape_string($_POST['cuidados']);
				$incluye = mysql_real_escape_string($_POST['incluye']);

				$result = mysql_query("SHOW TABLE STATUS WHERE `Name` = 'publicaciones'");
				$data = mysql_fetch_assoc($result);
				$next_increment = $data['Auto_increment'];
				$alea = substr(strtoupper(md5(microtime(true))), 0,12);
				$code = $next_increment.$alea;

				$type = 'jpg';
				$rfoto = $_FILES['foto']['tmp_name'];
				$name = $code.".".$type;
				if(is_uploaded_file($rfoto))
				{
					$destino = "publicaciones/".$name;
					$imagen = $name;
					copy($rfoto, $destino);
					/*
					$llamar = mysql_num_rows(mysql_query("SELECT * FROM albumes WHERE usuario ='".$_SESSION['id']."' AND nombre = 'Publicaciones'"));
					if($llamar >= 1) {} else {
						$crearalbum = mysql_query("INSERT INTO albumes (usuario,fecha,nombre) values ('".$_SESSION['id']."',now(),'Publicaciones')");
					}
					$idalbum = mysql_query("SELECT * FROM albumes WHERE usuario ='".$_SESSION['id']."' AND nombre = 'Publicaciones'");
					$alb = mysql_fetch_array($idalbum);
					$subirimg = mysql_query("INSERT INTO fotos (usuario,fecha,ruta,album,publicacion) values ('".$_SESSION['id']."',now(),'$nombre','".$alb['id_alb']."','$next_increment')");
					$llamadoimg = mysql_query("SELECT id_fot FROM fotos WHERE usuario = '".$_SESSION['id']."' ORDER BY id_fot desc");
					$llaim = mysql_fetch_array($llamadoimg);
					*/
                }
                else
                {
                	$imagen = '';
                }
                $subir = mysql_query("INSERT INTO publicaciones (usuario_id,titulo,fecha,tipomascota,raza,edad,vacunas,ciudad,barrio,cuidados,incluye,imagen) VALUES ('".$_SESSION['user_id']."','$titulo',now(),'$tipomascota','$raza','$edad','$vacunas','$ciudad','$barrio','$cuidados','$incluye','$imagen')");
                if($subir) {echo '<script>window.location="index.php"</script>';}
			}
			?>
		</div>
	</center>
</body>
</html>
