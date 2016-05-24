<?php
	function cifrar($p)
	{
		// Selecciona la sal y pimienta
		
		for($i=0;$i<5;$i++)
		{
			$x1 = rand(36,62);
			$c1 = chr($x1+$x1);
			
			$x2 = rand(32,62);
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
		
		//.
		
		// Cifra el código de la contraseña
		
		$c = strlen($p);
		for($i=0;$i<$c;$i++)
		{
			$concat = substr($p, $i, 1);
			$ascii = ord($concat);
			$ascii = $ascii+5;
			if($ascii > 122)
				$ascii = $ascii-85;
			$resul = chr($ascii);
			if(!isset($r))
				$r = $resul;
			else
				$r = $r . $resul;
		}
		$rn = t2($r);
		$rn = $ascii1 . $rn;
		$rn = $rn . $ascii2;
		
		return $rn;
	}
	
	//.
	
	// Se usa un hash y se pierde cierta información al sumar los valores en ascii de dos números
	
	function t2($res)
	{
		$a = strlen($res);
		if($a%2 == 0)
		{
			for($i=0;$i<$a;$i+=2)
			{
				$r = substr($res,$i,2);
				for($j=0;$j<=1;$j++)
				{
					$s = substr($r,$j,1);
					if(!isset($t1))
						$t1 = $s;
					else
						$t2 = $s;
				}
				$d1 = ord($t1);
				$d2 = ord($t2);
				$d = $d1 + $d2;
				if($d >	 126)
					$d = $d - 134;
				$e = chr($d);
				if(!isset($rn))
					$rn = $e;
				else
					$rn = $rn . $e;
			}
		}
		else
		{
			for($i=0;$i<$a+1;$i+=2)
			{
				$r = substr($res,$i,2);
				for($j=0;$j<=1;$j++)
				{
					$s = substr($r,$j,1);
					if(!isset($t1))
						$t1 = $s;
					else
						$t2 = $s;
				}
				$d1 = ord($t1);
				$d2 = ord($t2);
				$d = $d1 + $d2;
				if($d >	 126)
					$d = $d - 134;
				$e = chr($d);
				if(!isset($rn))
					$rn = $e;
				else
					$rn = $rn . $e;
			}
		}
		return $rn;
	}
	
	// termina el hash.
	
echo '<title> Seguridad </title>';
		
	if(!isset($_POST['nombre']))
	{
echo	'<form action="registro.php" method="POST">
			Nombre de usuario: <input type="text" maxleght="15" name="nombre" required/><small> Tu nombre puede tener números y letras, pero no caracteres especiales, y puede ser de 5 a 15 caracteres </small><br/>
			Contraseña: <input type="password" name="password" maxleght="15" required/>
			<small> Puede contener letras o números. Debe de tener una longitud mínima de 8 caracters y puede llegar hasta 15 </small><br/>
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
				$nc = "/[a-zA-Z0-9\@]{5,15}/";
				$pc = "/[a-zA-Z0-9]{8,15}/";
				$compn = preg_match($nc, $nombre);
				$compp = preg_match($pc, $pass);
				if($compn != 0)
					if($compp == 0)
						echo 'Tu cadena no es válida
						<a href="registro.php"> Volver a intentar </a>';
					else
					{
						echo 'Bienvenid@: '.$nombre.
						'<a href="proyecto_seg.html"> Continuar </a>';
						$contra = cifrar($pass);
						mysqli_query($conect, "INSERT INTO user VALUES ('$nombre','$contra')");
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