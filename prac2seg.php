<?php
echo '<!DOCTYPE html>
<html>
	<head>
		<title> Práctica 2 </title>
		<meta charset="UTF-8">
	</head>
	<body>';
		if(!isset($_POST['number']))
		{
echo		'<form method="POST" action="prac2seg.php">
				Número de cuenta: <input type="number" name="number" required focus="on""/></br>
				<input type="submit"/><br/>
				<input type="checkbox" value="si" name="cifrar"/> Descifrar
			</form>';
		}
		else
		{
			if(isset($_POST['number']))
			{
				$n = $_POST['number'];
				$r = strrev($n);
			}
			if(isset($_POST['cifrar']) == 'si')
			{
				$n = $_POST['number'];
				$r = strrev($n);
			}
			echo $r;
		}
echo '</body>
<html>';
?>