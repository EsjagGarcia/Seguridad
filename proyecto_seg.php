<?php
echo '<html>
		<head>
			<title> Seguridad </title>
		</head>
		<body>
			<form method="POST" action="proyecto_seg.php">
				<button name="entrar" type="button"> INGRESAR </button>
				<button name="registro" type="button"> REGISTRARSE </button>
			</form>';
			if(isset($_POST['entrar']))
				echo 'hola';
echo	'</body>
	</html>';
?>