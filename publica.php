<?php 
	session_start();
	require 'database.php';

	if (isset($_SESSION['user_id'])) {
		$records = $conn->prepare('SELECT * FROM users WHERE id = :id');
		$records->bindParam(':id', $_SESSION['user_id']);
		$records->execute();
		$results = $records->fetch(PDO::FETCH_ASSOC);

		$user = null;

		if (count($results)>0) {
			$user = $results;
		}
	}
	/*if (isset($_SESSION['user_id'])) {
		header('Location: /web/Petry/login.php');
	}
*/
	$message = '';

	if (!empty($_POST['titulo']) && !empty($_POST['tipomascota']) && !empty($_POST['raza']) && !empty($_POST['vacunas']) && !empty($_POST['ciudad']) && !empty($_POST['barrio']) && !empty($_POST['cuidados']) && !empty($_POST['incluye']))
	{

		$sql = "INSERT INTO publicaciones (usuario_id,titulo,tipomascota,raza,edad,vacunas,ciudad,barrio,cuidados,incluye) VALUES (:usuario_id,:titulo,:tipomascota,:raza,:edad,:vacunas,:ciudad,:barrio,:cuidados,:incluye)";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':usuario_id', $_SESSION['user_id']);
		$stmt->bindParam(':titulo', $_POST['titulo']);
		
		$stmt->bindParam(':tipomascota', $_POST['tipomascota']);
		$stmt->bindParam(':raza', $_POST['raza']);
		$stmt->bindParam(':edad', $_POST['edad']);
		$stmt->bindParam(':vacunas', $_POST['vacunas']);
		$stmt->bindParam(':ciudad', $_POST['ciudad']);
		$stmt->bindParam(':barrio', $_POST['barrio']);
		$stmt->bindParam(':cuidados', $_POST['cuidados']);
		$stmt->bindParam(':incluye', $_POST['incluye']);
		//$stmt->bindParam(':imagen', $_POST['imagen']);

		if ($stmt->execute())
		{
			$message = 'Publicacion creada satisfactoriamente';
		}else {
			$message = 'Error creando su publicacion';
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Publica</title>
	<link rel="stylesheet" type="text/css" href="estilos/estilos.css">
</head>
<body>
	<?php require 'parciales/header.php' ?>

	<?php if (!empty($message)): ?>
		<p><?= $message ?></p>
	<?php endif ?>

	<center>
		<?php if (!empty($user)): ?>
		<br>
		<div class="datos-publicacion">
			<form action="publica.php" method="post" >
				<input type="text" name="titulo" placeholder="Titulo de tu publicacion">
				<input type="text" name="tipomascota" placeholder="Tipo de mascota: perro, gato, etc">
				<input type="text" name="raza" placeholder="Raza:">
				<input type="text" name="edad" placeholder="Edad:">
				<input type="text" name="vacunas" placeholder="Vacunas al dia: Si/No">
				<input type="text" name="ciudad" placeholder="Ciudad:">
				<input type="text" name="barrio" placeholder="Barrio:">
				<input type="text" name="cuidados" placeholder="Cuidados: ">
				<textarea name="incluye" placeholder="Incluye: alimento, cama, mantas, etc"></textarea>
				<!--<input type="file" name="foto" placeholder="Fotos">-->
                <br><br>
				<input type="submit" value="Publicar">
			</form>
		</div>
		<?php else: ?>
		<h1>Inicia sesión o registrate para publicar un anuncio</h1>
		<a href="login.php">Inicia sesión</a>
		<a href="registro.php">Registrate</a>
		<?php endif; ?>
	</center>
</body>
</html>