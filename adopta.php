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
	<title>ADOPTA</title>
	<link rel="stylesheet" type="text/css" href="estilos/estilos.css">
</head>
<body>
	<?php require 'parciales/header.php' ?>

	<center>
	<!--
					<div class="publicaciones">
					<div class="publicacion">
						<br><b>Titulo:</b> <?= $user['titulo'] ?>
						<br><b>Raza:</b> <?= $user['raza'] ?>
						<br><b>Ciudad:</b> <?= $user['ciudad'] ?>
						<br><a href="#">+</a></b>
					</div>
					<div class="publicacion">
						<br><b>Titulo:</b> <?= $user['titulo'] ?>
						<br><b>Raza:</b> <?= $user['raza'] ?>
						<br><b>Ciudad:</b> <?= $user['ciudad'] ?>
						<br><b><a href="#">+</a></b>
					</div>
	-->
		<div class="publicaciones">
			<?php
			$consulta = $conn->prepare('SELECT id_publicacion,titulo,raza,ciudad FROM publicaciones');
			$consulta->bindParam(':id', $_SESSION['user_id']);
			$consulta->execute();
			?>
			<?php while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) { ?>
				<div class="publicacion">
					
					<br><b>Titulo:</b>
				 	<?php echo $fila['titulo']; ?>
				 	<br><b>Raza:</b>
				 	<?php echo $fila['raza']; ?>
				 	<br><b>Ciudad:</b>
				 	<?php echo $fila['ciudad']; ?>
				 	<br><b>Id:</b>
				 	<?php echo $fila['id_publicacion']; ?>
				 	<center>
				 		<input type="submit" value="+" id="btn-adoptar">
			 			<!--
			 			//<a href="explorer.php?id=<?php echo $fila['id_publicacion']; ?>">+</a>
			 			-->
					</center>
				</div>
			<?php } ?>
			<div id="resultado">
				<h3>Aqui </h3>
			</div>
			<?php if (!empty($user) ){
				$sql = "INSERT INTO adopciones (usuario_id,publicacion_id) VALUES (:usuario_id,:publicacion_id)";
				$stmt = $conn->prepare($sql);
				$stmt->bindParam(':usuario_id', $_SESSION['user_id']);
				$stmt->bindParam(':publicacion_id', $_SESSION['id_publicacion']);
				if ($stmt->execute()){
					$message = 'Añadido satisfactoriamente';
				}else {
					$message = 'Error adoptando mascota';
				}
			}
			?>
		</div>
	</center>
</body>
</html>