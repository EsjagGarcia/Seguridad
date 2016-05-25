<html>
	<head>
		<title> Seguridad </title>
	</head>
	<body>
	<?php
	
echo	'<form method="POST" action="proyecto_seg.php">
			<button name="entrar" type="button"><a href="ingresar.php"> INGRESAR </a></button>
			<button name="registro" type="button"><a href="registro.php"> REGISTRARSE </a></button>
		</form>';
		
		$value = rand(1,100);
		if(!isset($_COOKIE['inicio']))
			setcookie("Inicio", $value, time() + 10);
		if(!isset($_COOKIE['go']))
			setcookie("go", $value, time() + 10);	
	?>
	</body>
</html>
