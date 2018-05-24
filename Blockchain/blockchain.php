<?php 
    session_start();
    require '../database.php';
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
	<title>Blockchain</title>

	<script src="blockchain.js"></script>
    <script src="DBC.js"></script>
	<!-- Bootswatch Theme -->
    <link rel="stylesheet" href="https://bootswatch.com/4/litera/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../estilos/estilos.css">
</head>
<body>
    
    <?php require '../parciales/header.php' ?>

	<!-- Navigation -->
    <!--<nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="#">Products App</a>
    </nav>-->

    

    document.getElementById("Moneda.");



    Moneda.createTransaction(new Transaction('Jose', 'Poli', 'Gato'));

    <div class="container">
        <!-- APPLICATION -->
        <div id="App" class="row pt-5">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4>blockchain</h4>
                        document.getElementById("demo").innerHTML = person.firstName + " " + person.lastName;
                        JSON.stringify(Moneda, null, 4);
                    </div>
                    <form id="product-form" class="card-body">
                        <div class="form-group">
                            <input type="text" id="item1" placeholder="item1 Name" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="number" id="item2" step="0.01" placeholder="item1 Name" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="number" id="year" min="1900" max="2099" step="1" value="2018" class="form-control">
                        </div>
                        <input type="submit" value="Save" class="btn btn-primary btn-block">
                    </form>
                </div>
            </div>

            <div id="lista" class="col-md-8"></div>
        </div>
    </div>
/*<!--	<div class="container">
		<div id="Blockchain" class="row pt-5">
			<div class="col md-4">
				<div class="card">
					<div class="header">
						<h4>Lista Block</h4>
					</div>
					<form class="card-body">
						<div class="form-group">
							<input type="text" name="name" placeholder="Nombre ">
						</div>
					</form>
				</div>
				<h1>Aplicacion Blockchain</h1>
			</div>
			<div class="col md-8">
				
			</div>
		</div>
	</div>-->*/
</body>
</html>