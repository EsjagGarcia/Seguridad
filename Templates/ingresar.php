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
		
		//....
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
		
		//Caracteres aleatorios de la cadena
		
		$rn = t2($r);
		for($i=0;$i<3;$i++)
		{
			$h = rand(0,$c);
			$new = substr($r,$h,1);
			
			if(!isset($n))
				$n = $new;
			else
				$n = $n . $new;
		}
		
		//....
		
		//....
		
		return $rn;
	}
	
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
	
	function comparar($pass, $conect, $nombre)
	{
		$n = mysqli_fetch_array(mysqli_query($conect,"SELECT * FROM user WHERE nombre LIKE '%$nombre%';"));
		$n1 = $n['1'];
		$count = strlen($n1);
		for($i=5;$i<$count-8;$i++)
		{
			$newp = substr($n1,$i,1);
			if(!isset($c))
				$c = $newp;
			else
				$c = $c . $newp;
		}
		return $c;
	}
	
	// termina el hash.
	
echo '<!DOCTYPE html>
	<html>
		<head>
			<title> Seguridad </title>
		</head>
		<body>';
		
	if(isset($_COOKIE['go']))
	{
		if(!isset($_POST['nombre']))
		{
		
echo		'<form action="ingresar.php" method="POST">
				Nombre de usuario: <input type="text" maxleght="15" name="nombre" required autofocus /><br/>
				Contraseña: <input type="password" name="password" maxleght="15" required/><br/>
				<input type="submit" value="Entrar"/>
				<br/><a href="proyecto_seg.php"> Volver al menú </a>
			</form>';			
		}
		else//if(isset($_COOKIE['Inicio']))
		{
		
			//Borra la cookie para la siguiente visita.
		
			setcookie("go", "0", time() - 1);
		
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
				$na = mysqli_fetch_array(mysqli_query($conect,"SELECT nombre FROM user WHERE nombre LIKE '%$nombre%';"));
				$name = $na['nombre'];
								
				// Validación para pasar a bd
			
				if($nombre == $name)
				{
					// Introduce en la base de datos
						
					$contra = cifrar($pass);
					$dev = comparar($contra, $conect, $name);
					if($dev == $contra)
					{
echo					"<br/>Todo en orden
						<br/><a href='menu.php'> Entrar </a>";
					}
					else
					{
echo					"<br/> Tu contraseña es incorrecta
						<br/><a href='ingresar.php'> Reintentar </a><br/>";
					}
					
					//....(introduce)
							
				}	//(bd)
				else	// Cuando no se cumpla
				{
						
					echo "El usuario no existe.
					<br/><a href='ingresar.php'> Volver a intentar </a>
					<a href='registro.php'> Registrarse </a>";
						
				}	//....(bd/si no)
			}		
			else
			{
echo			 "Algo no va bien;
				<br/><a href='proyecto_seg.php'> Volver a intentar </a>";
			}
		
			mysqli_close($conect);
			
			//.
			
			setcookie("go", 0, time() - 1);
			$value = rand(1,100);
				setcookie("vamos", $value, time() + 10);
		}
	}
	else
	{
echo	'Hubo un error en nuestra página, es posible que estes ingresando de una página falsa o el 		
		tiempo de espera de la conección a caducado. Por tu seguridad no podras continuar con el 
		proceso, esto para preservar tu información y la de los demás usuario.
		<a href="proyecto_seg.php"> Volver </a>';
	}
		
echo 	'</body>
	</html>'

?>