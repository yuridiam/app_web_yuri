<?php
	//conexion a la bd de usuarios
	$dsn = 'mysql:dbname=ventas;host=localhost';
	$user = 'root';
	$password = '';
	try{
		$pdo = new PDO($dsn,$user,$password);
	}catch( PDOException $e ){
		echo 'Error al conectarnos: ' . $e->getMessage();
	}
?>

