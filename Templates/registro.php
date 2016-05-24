<?php
	function cifrar($p)
	{
		for($i=0;$i<5;$i++)
		{
			$x1 = rand(36,62);
			$c1 = chr($x1+$x1);
			$x2 = rand(16,62);
			$c2 = chr($x2+$x2);
			if(!isset($ascii1))
				$ascii1 = $c1;
			else
				$ascii1 = $ascii1 . $c1;
			
			if(!isset($ascii2))
				$ascii2 = $c2;
			else
				$ascii2 = $ascii2 . $c2;
		}
		echo "<br/>".$ascii1."<br/>";
		echo $ascii2."<br/>";
		
		$c = strlen($p);
		for($i=0;$i<$c;$i++)
		{
			$concat = substr($p, $i, 1);
			$ascii = ord($concat);
			$ascii = $ascii+10;
			$resul = chr($ascii);
			if(!isset($r))
				$r = $resul;
			else
				$r = $r . $resul;
		}
		echo '<br/>'.$r.'<br/>';
		$r = $ascii1 . $r;
		$r = $r . $ascii2;
		echo $r.'<br/>';
		return;
	}
	if(!isset($_POST['nombre']))
	{
echo	'<title> Seguridad </title>
		<form action="registro.php" method="POST">
			Nombre de usuario: <input type="text" maxleght="15" name="nombre" required/><small> Tu nombre puede tener números y letras, pero no caracteres especiales, y puede ser de 5 a 15 caracteres </small><br/>
			Contraseña: <input type="password" name="password" maxleght="15" required/>
			<small> Puede contener letras, números, y algunos carácteres especiales como: ( _ / . / - / @ ). Debe de tener una longitud mínima de 8 caracters y puede llegar hasta 15 </small><br/>
			<input type="submit" value="Registrarse">
		</form>';
		$value = rand(1,10);
		setcookie("Inicio", $value, time() + 10);
	}
	else//if(isset($_COOKIE['Inicio']))
	{
		//Borra la cookie para la siguiente visita.
		
		setcookie("Inicio", "0", time() - 1);
		
		//.
		
		//Escapar caracteres especiales.
		
		$nombre = htmlspecialchars($_POST['nombre']);
		$nombre = addslashes($nombre);
		$pass = htmlspecialchars($_POST['password']);
		$pass = addslashes($pass);
		$conect = mysqli_connect("localhost","root");
		
		//.
		
		
		// Busquedas y validacones a la base de datos
		
		if(mysqli_select_db($conect,"seg"))
		{
			$search = mysqli_query($conect,"SELECT nombre FROM user WHERE nombre LIKE '%$nombre%';");
			if(mysqli_fetch_array(mysqli_query($conect,"SELECT nombre FROM user WHERE nombre LIKE '%$nombre%';")))
				echo "Nombre ya existente
				<a href='registro.php'> Volver a intentar </a>";
			else
			{
				$nc = "/\w{5,15}/";
				$pc = "/[a-zA-Z0-9\@\_\.\-]{8,15}/";
				$compn = preg_match($nc, $nombre);
				$compp = preg_match($pc, $pass);
				if($compn != 0)
					if($compp == 0)
						echo 'Tu cadena no es válida
						<a href="registro.php"> Volver a intentar </a>';
					else
					{
						//echo 'Bienvenid@: '.$nombre.
						//'<a href="proyecto_seg.html"> Continuar </a>';
						cifrar($pass);
						//echo "contra";
						//mysqli_query($conect, "INSERT INTO user VALUES ('$nombre','$contra')");
					}
				else
					echo 'Tu cadena no es válida
					<a href="registro.php"> Volver a intentar </a>';
			}
		}
		else
			echo "No esta bien";
		mysqli_close($conect);
		
		//.
	}
	/*else
	{
echo	'Hubo un error en nuestra página por tu seguridad no podras continuar con el proceso, esto para 
		preservar tu información y la de los démas usuario.
		<a href="proyecto_seg.html"> Volver </a>';
	}*/
?>