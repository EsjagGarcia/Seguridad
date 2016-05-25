<?php
echo '<!DOCTYPE html>
	<html>
		<head>
			<title> Seguridad </title>
			<meta charset="UTF-8">
		</head>
		<body>';
			if(isset($_COOKIE['vamos']))
			{
echo			'<ul>
					<li> <a href="prac2seg.php"> Práctica 2 </li>			
					<li> <a href="prac4seg.php"> Práctica 4 </li>
					<li> <a href="prac5seg.php"> Práctica 5 </li>
					<li> <a href="prac6seg.php"> Práctica 6 </li>
					<li> <a href="prac7seg.php"> Práctica 7 </li>
					<li> <a href="prac8seg.php"> Práctica 8 </li>
					<li> <a href="prac9seg.php"> Práctica 9 </li>
					<a href="adios.php"> Salir </a>
				</ul>';
				$value = rand(1,100);
					setcookie("vamos", $value, time() + 10);
			}
			else
			{
echo			'Hubo un error en nuestra página, es posible que estes ingresando de una página falsa o	
				el tiempo de espera de la conección a caducado. Por tu seguridad no podras continuar  
				con el proceso, esto para preservar tu información y la de los demás usuario.
				<a href="proyecto_seg.php"> Volver </a>';
			}
echo	'</body>
	</html>';
?>