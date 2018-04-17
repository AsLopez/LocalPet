<?php  
	session_start();

	if (isset($_SESSION['user_id'])) {
		header('Location: /web/Petry');
	}

	require 'database.php';

	if (!empty($_POST['email']) && !empty($_POST['password'])) {
		$records = $conn->prepare('SELECT id, email, password FROM users WHERE email=:email');
		$records->bindParam(':email', $_POST['email']);
		$records->execute();
		$results = $records->fetch(PDO::FETCH_ASSOC);

		$message = '';

		if (count($results)>0 && password_verify($_POST['password'], $results['password'])) {
			$_SESSION['user_id'] = $results['id'];
			header('Location: /web/Petry');
		}else{
			$message ='Estos datos no coninciden, intente de nuevo';
		}
	}
?>



<!DOCTYPE html>
<html>
<head>
	<title>Inicio sesión</title>
	<link rel="stylesheet" type="text/css" href="estilos/estilos.css">
</head>
<body>

	<?php require 'parciales/header.php' ?>

	<h1>Login</h1>

	<span>or <a href="registro.php">Registrate</a></span>

	<?php if (!empty($message)) : ?>
		<p><?= $message ?></p>
	<?php endif; ?>

	<center>
		<form action="login.php" method="post">
			<input type="text" name="email" placeholder="Ingrese su email">
			<input type="password" name="password" placeholder="Ingrese contraseña">
			<input type="submit" value="Enviar">
			
		</form>
	</center>
</body>
</html>