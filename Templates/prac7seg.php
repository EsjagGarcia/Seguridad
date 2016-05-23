<?php
function empieza($h)
{
	$count = strlen($h);
	for($i=0;$i<$count;$i++)
	{
		$h2[$i] = substr($h,$i,1);
	}
	foreach($h2 as $k)
		$ascii = ord($k);
	$hash = decbin($ascii);
	$c1 = strlen($hash/2);
	$r1 = substr($hash, 1, $c1);
	$r2 = substr($hash, $c1, $c1);
	$c2 = strlen($r1/2);
	$r3 = substr($r1, 1, $c2);
	$r4 = substr($r1, $c2, $c2);
	$rb1 = $r4.$r3;
	$rb2 = $r2.$rb1;
	$rhash = bindec ($rb2);
	$rhash = $rhash + 32;
	$rascii = chr($rhash);
	return $rascii;
}
echo '<!DOCTYPE html>
<html>
	<head>
		<title> Práctica 7 </title>
		<meta charset="UTF-8">
	</head>
	<body>';
		if(!isset($_POST['algo']))
		{
echo		'<form method="POST" action="prac7seg.php">
				Algo: <input type="text" name="algo" required focus="on"/></br>
				<input type="submit" value="Vamos!"/><br/>
			</form>';
		}
		else
		{
			$h = $_POST['algo'];
			$rt = empieza($h);
			echo $rt;
		}
echo '</body>
<html>';
?>