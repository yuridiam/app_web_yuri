<?php
	//se cambia el valor de la cookie para checar si en verdad se cerro sesión
	$_COOKIE["cerrar"]="1";
	if($_COOKIE["cerrar"]=="1"){
		header("Location: index.php");
	}
?>