<?php
function empieza($h)
{
	$count = strlen($h);
	for($i=0;$i<$count;$i++)
	{
		$h1 = substr($h,$i,1); 
		$c = ord ($h1);
		$text[$i] = $c;
	}
	print_r($text);
	$tr = 0;
	foreach($text as $x)
	{
		$tr = $tr . $x;
	}
	echo "<br/>".$tr;
}
echo '<!DOCTYPE html>
<html>
	<head>
		<title> Práctica 8 </title>
		<meta charset="UTF-8">
	</head>
	<body>';
		if(!isset($_POST['algo']))
		{
echo		'<form method="POST" action="prac8seg.php">
				Algo: <input type="text" name="algo" required focus="on"/></br>
				<input type="submit" value="Vamos!"/><br/>
			</form>';
		}
		else
		{
			$h = $_POST['algo'];
			$rt = empieza($h);
		}
echo '</body>
<html>';
?>