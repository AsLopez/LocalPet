<?php 
	session_start();
	require 'database.php';
/*
	if (isset($_SESSION['user_id'])) {
		header('Location: /web/Petry/login.php');
	}
*/
	if (isset($_SESSION['user_id'])) {
		$records = $conn->prepare('SELECT * FROM publicaciones WHERE id_publicacion = :id');
		$records->bindParam(':id', $_SESSION['user_id']);
		$records->execute();
		$results = $records->fetch(PDO::FETCH_ASSOC);

		$user = null;

		if (count($results)>0) {
			$user = $results;
		}
	}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Bienvenido a PETRY</title>
	<link rel="stylesheet" type="text/css" href="estilos/estilos.css">
</head>
<body>
	<?php require 'parciales/header.php' ?>	


	<?php 
	$nombre = $conn->prepare('SELECT * FROM users WHERE id = :id');
	$nombre->bindParam(':id', $_SESSION['user_id']);
	$nombre->execute();
	$nombre = $nombre->fetch(PDO::FETCH_ASSOC);

	if (!empty($user)): ?>
		<h1>MIS PUBLICACIONES</h1>
		<center>
			<div class="publicaciones">
				<?php
				$consulta = $conn->prepare('SELECT titulo,raza,ciudad FROM publicaciones WHERE usuario_id = :id');
				$consulta->bindParam(':id', $_SESSION['user_id']);
				$consulta->execute();
				?>
				<?php while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) { ?>
					<div class="publicacion">
						<!--<br><b>Titulo:</b> <?= $user['titulo'] ?>
						<br><b>Raza:</b> <?= $user['raza'] ?>
						<br><b>Ciudad:</b> <?= $user['ciudad'] ?>
						<br><a href="#">+</a></b>-->
						<br><b>Titulo:</b>
					 	<?php echo $fila['titulo']; ?>
					 	<br><b>Raza:</b>
					 	<?php echo $fila['raza']; ?>
					 	<br><b>Ciudad:</b>
					 	<?php echo $fila['ciudad']; ?>
					 	<center>
				 		<a href="#">+</a>
						</center>
					</div>
				<?php } ?>
			</div>
		</center>

		<a href="logout.php">Logout</a>
	<?php else: ?>
		<h1>Inicia sesión o registrate</h1>
		<a href="login.php">Inicia sesión</a>
		<a href="registro.php">Registrate</a>
	<?php endif; ?>

</body>
</html>