<!DOCTYPE html>
<html>
<head>
	<title>Prueba de BC</title>
	<!--	
	<script type="text/javascript" src="bc.js"></script>-->
</head>
<body>
	<script language="javascript" type="text/javascript">
		function MiFuncionJS(a,b){
			let c = 0;
			this.a=a;
			this.b=b;
			return c === a+b;
			alert ("EXITO ");
			
		}
		console.log('c' );
	</script>
	<form id="prueba" method="post">
		<input type="number" name="a" placeholder="a" id="a">
		<input type="number" name="b" placeholder="b" id="b">
	</form>
	<?php
	
	echo "<input type='button' value='Click' onClick='MiFuncionJS(a,b);' /><br>";
	?>
</body>
</html>