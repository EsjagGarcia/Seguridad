<?php
function prikey($k)
{
	$kd = chr($k);
	return $kd;
}
echo '<!DOCTYPE html>
<html>
	<head>
		<title> Práctica 6 </title>
		<meta charset="UTF-8">
	</head>
	<body>';
		if(!isset($_POST['algo']))
		{
echo		'<form method="POST" action="prac6seg.php">
				Algo: <input type="text" name="algo" required focus="on"/></br>
				Llave: <input type="number" name="key" required/></br>
				<input type="submit" value="Vamos!!"/><br/>
				<input type="checkbox" value="si" name="cifrar"/> Descifrar
			</form>';
		}
		else
		{
			$text = $_POST['algo'];
			$kp = $_POST['key'];
			$count = strlen($text);
			$kd = prikey($kp);
			$kd = strtoupper($kd);
			if($kd == 'A')
			{
				$r = strrev($text);
				echo $r;
			}
			elseif($kd == 'B')
				{
					$c = $count / 2;
					$c1 = substr($text, $c, $count);
					$c2 = substr($text, 0, $c);
					$r = $c1 . $c2;
					echo $r;
				}elseif($kd == 'C')
					{
						$r = strrev($text);
						echo $r;
					}elseif($kd == 'D')
						{
							$c = $count / 2;
							$c1 = substr($text, $c, $count);
							$c2 = substr($text, 0, $c);
							$r = $c1 . $c2;
							echo $r;
						}elseif($kd == 'E')
						{
							$r = strrev($text);
							echo $r;
						}
		}
echo '</body>
<html>';
?>