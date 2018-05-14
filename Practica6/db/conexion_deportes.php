<?php
	//conexion a la base de datos de deportes
	$dsn = 'mysql:dbname=deportes;host=localhost';
	$user = 'root';
	$password = '';
	try{
		$pdo = new PDO($dsn,$user,$password);
	}catch( PDOException $e ){
		echo 'Error al conectarnos: ' . $e->getMessage();
	}
?>

