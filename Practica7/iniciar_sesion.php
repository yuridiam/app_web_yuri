<?php
	//toma el usuario desde la url
	$usuario = isset( $_GET['usuario'] ) ? $_GET['usuario'] : '';
	//crea la cookie con el nombre de usuario
	setcookie("usu",$usuario);
	//crea la cookie que comprueba si la sesion esta abierta o no
	setcookie("cerrar","0");
	//direcciona al menu
	header("Location: menu.php");
?>