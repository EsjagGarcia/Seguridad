<?php
echo '<!DOCTYPE html>
<html>
	<head>
		<title> Práctica 4 </title>
		<meta charset="UTF-8">
	</head>
	<body>';
		if(!isset($_POST['msj']))
		{
echo		'<form method="POST" action="prac4seg.php">
				Cualquier cosa: <input type="text" name="msj" required/></br>
				Llave: <input type="text" name="key" required/></br>
				<input type="submit"/><br/>
				<input type="checkbox" value="si" name="cifrar"/> Cifrado
			</form>';
		}
		else
		{
			$m = $_POST['msj'];
			$k = $_POST['key'];
			$c1 = strlen($m);
			$c2 = strlen($k);
			if($c1 > $c2)
			{
					$c = $c1 / 2;
					$r1 = substr($m, $c, $c1);
					$r2 = substr($m, 0, $c);
					$r = $r1 . $r2;
					echo $r;
			}
			elseif($c1 < $c2)
				{
					$r = strrev($m);
					echo $r;
				}
		}
echo '</body>
<html>';
?>