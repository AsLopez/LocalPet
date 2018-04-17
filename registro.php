<?php
	session_start();
	require 'database.php';

	if (isset($_SESSION['user_id'])) {
		header('Location: /web/Petry');
	}

	$message = '';

	if (!empty($_POST['email']) && !empty($_POST['password'])) {
		$sql = "INSERT INTO users (email,password) VALUES (:email, :password)";
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
?>

<!DOCTYPE html>
<html>
<head>
	<title>Registro</title>
	<link rel="stylesheet" type="text/css" href="estilos/estilos.css">
</head>
<body>
	<?php require 'parciales/header.php' ?>

	<?php if (!empty($message)): ?>
		<p><?= $message ?></p>
	<?php endif ?>


	<h1>Registrate</h1>
	<span>o <a href="login.php">Inicia sesion</a></span>

	<center>
		<form action="registro.php" method="post">
			<input type="text" name="email" placeholder="Ingrese su email">
			<input type="password" name="password" placeholder="Ingrese contraseña">
			<input type="password" name="confirm_password" placeholder="Confirma tu contraseña">
			<input type="submit" value="Enviar">
		</form>
	</center>
</body>
</html>
