<?php
function ISBN10($y)
{
	$count = strlen($y);
	for($i=0;$i>$count;$i++)
	{
		$a = substr($y,$i,1);
		$r = $a($i+1);
	}
	echo $r;
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
				Algo: <input type="number" name="algo" required focus="on"/></br>
				<select name="ISBN">
					<option value="10"> ISBN 10 </option>
					<option value="13"> ISBN 13 </option>
				</select><br/>
				<input type="submit" value="Vamos!"/><br/>
			</form>';
		}
		else
		{	
			$x = $_POST['ISBN'];
			$y = $_POST['algo'];
			if($x == '10')
			{
				$r = ISBN10($y);
			}
		}
echo '</body>
<html>';
?>