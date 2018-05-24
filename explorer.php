<?php 
	session_start();
	require 'database.php';
/*
	if (isset($_SESSION['user_id'])) {
		header('Location: /web/Petry/login.php');
	}
*/
	if (isset($_SESSION['user_id'])) {
		$records = $conn->prepare('SELECT * FROM adopciones');
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
	<title>EXPLORADOR</title>
	<link rel="stylesheet" type="text/css" href="estilos/estilos.css">
</head>
<body>
	<?php require 'parciales/header.php' ?>
	<?php $id=$_REQUEST['id']; ?>

	<center>
		<?php
		$sql = "INSERT INTO adopciones (usuario_id,publicacion_id) VALUES (:usuario_id,:publicacion_id)";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':usuario_id', $_SESSION['user_id']);
		$stmt->bindParam(':publicaion_id', $_REQUEST['id']);

		if ($stmt->execute())
		{
			$message = 'Publicacion creada satisfactoriamente';
		}else {
			$message = 'Error creando su publicacion';
		}
		?>
		<div class="publicaciones">
			<table style="width:100%">
				<tr>
					    <th>Numero de adopcion</th>
					    <th>Usuario adoptante</th> 
					    <th>Adopto</th>
					    <th align="center">Mas información</th>
				</tr>
			<?php
			$consulta = $conn->prepare('SELECT id_adopcion,usuario_id,publicacion_id FROM adopciones');
			$consulta->execute();
			?>
			<?php while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) { ?>
				<div>
					  <tr>
					  	<td><?php echo $fila['id_adopcion']; ?></td>
					  	<td><?php echo $fila['usuario_id']; ?></td>
					  	<td><?php echo $fila['publicacion_id']; ?></td>
					  	<td align="center"><input type="submit" value="+"></td>
				</div>
			<?php } ?>
			<?php if (!empty($user))
						{
							$sql = "INSERT INTO adopciones (usuario_id,publicacion_id) VALUES (:usuario_id,:publicacion_id)";
							$stmt = $conn->prepare($sql);
							$stmt->bindParam(':usuario_id', $_SESSION['user_id']);
							$stmt->bindParam(':publicacion_id', $id);
							if ($stmt->execute()){
									$message = 'Añadido satisfactoriamente';
							}else {
								$message = 'Error adoptando mascota';
							}
						}
						?>
			</tr>
		</div>
	</center>
</body>
</html>