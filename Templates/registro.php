<?php
	if(!isset($_POST['nombre']))
	{
echo	'<form action="registro.php" method="POST">
			Nombre de usuario: <input type="text" maxleght="15" name="nombre" required/><small> Tu nombre puede tener números y letras, pero no caracteres especiales, y puede ser de 5 a 15 caracteres </small><br/>
			Contraseña: <input type="password" name="password" maxleght="15" required/>
			<small> Puede contener letras, números, y algunos carácteres especiales como: ( _ / . / - / @ ). Debe de tener una longitud mínima de 8 caracters y puede llegar hasta 15 </small><br/>
			<input type="submit" value="Registrarse">
		</form>';
	}
	else
	{
		$nombre = $_POST['nombre'];
		$pass = $_POST['password'];
		$conect = mysqli_connect("localhost","root");
		if(mysqli_select_db($conect,"seg"))
		{
			$search = mysqli_query($conect,"SELECT nombre FROM user WHERE nombre LIKE '%$nombre%';");
			if(mysqli_fetch_array($search))
				echo "Nombre ya existente";
			else
			{
					$nc = "/\w{5,15}/";
					$pc = "/[a-zA-Z0-9\@\_\.\-]{8,15}/";
					$compn = preg_match($nc, $nombre);
					$compp = preg_match($pc, $pass);
					if($compn != 0)
						if($compp == 0)
							echo 'Tu cadena no es válida';
						else
						{
							echo "Bienvenid@: ".$nombre;
							mysqli_query($conect, "INSERT INTO user VALUES ('$nombre','$pass')");
						}
					else
						echo 'Tu cadena no es válida';
			}
		}
		else
			echo "No esta bien";
		mysqli_close($conect);
	}
?>