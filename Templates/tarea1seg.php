<?php
echo '<!DOCTYPE html>
	<html>
		<head>
			<title> Tarea 1 </title>
			<meta charset="UTF-8">
		</head>
		<body>
			<form method="POST" action="tarea1seg.php">
				Texto: <input type="text" name="text" required/> </br>
				<input type="number" name="number" required/></br>
				<input type="submit"/><br/>
				<input type="checkbox"> Cifrar
			</form>';
				if(isset($_POST['text']))
				{
					$t = $_POST['text'];
					echo $t.'<br/>';
					$n = $_POST['number'];
					echo $n.'<br/>';
					$cont = strlen($t);
					$j = 0;
					while($j != $cont)
					{
						for($i=0;$i<=($n-1);$i++)
						{
							echo $i.'<br/>';
							$ca = substr($t,$i,1);
							$cad[$i] = $ca;
							echo $ca.'<br/>';
							//$s = strpos($t,$ca);
							echo $t.'<br/>';
						}
						$j++;
					}
					echo $t.'<br/>';
					echo '<br/>';
					print_r($cad);
				}
echo	'</body>
	</html>'
?>