<?php
echo '<html>
		<head>
			<title> Seguridad </title>
			<meta charset="UTF-8"/>
		</head>
		<body>';
			setcookie("vamos", "0", time() - 1);
			echo 'Nos vemos pronto
				<br/><a href="proyecto_seg.php"> Volver al menú </a>';
echo	'</body>
	</html>';
?>