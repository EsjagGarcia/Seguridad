<?php
	if(!isset($_POST['nombre']))
	{
echo	'<form action="registro.php" method="POST">
			Nombre: <input type="text" maxleght="15" name="nombre" pattern="^[a-zA-Z0-9_\.\-\@]{5,10}" required/><br/>
			Contraseña: <input type="password" name="password" maxleght="15" pattern="^[a-zA-Z0-9_\.\-\@]{8,15}" required/><br/>
			<input type="submit" value="Registrarse">
		</form>';
	}
	else
	{
		$conect = mysqli_connect("localhost","root");
		if(mysqli_select_db($conect,"seg"))
			echo "Todo esta bien";
		else
			echo "No esta bien";
		$a = mysqli_query($conect,"SELECT nombre FROM user;");
		if($a == TRUE)
		{
			$extraido = mysqli_fetch_array($a);
			$res = mysqli_data_seek($a, 1);
			echo "<br/>".$extraido['nombre'].'<br/>';
			print_r($extraido);
		}
		else
			echo "No se realizo la consulta";
		mysqli_close($conect);
	}
?>