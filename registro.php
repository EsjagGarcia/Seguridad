<?php
	if(!isset($_POST['nombre']))
	{
echo	'<form action="registro.php">
			Nombre: <input type="text" maxleght="15" pattern="^[a-zA-Z0-9_\.\-\@]{8,17}" required/><br/>
			Contraseña: <input type="password" maxleght="15" pattern="^[a-zA-Z0-9_\.\-\@]{8,17}" required/><br/>
			<input type="submit" value="Registrarse">
		</form>';
	}
?>