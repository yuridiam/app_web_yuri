<?php
	//se manda a llamar los datos de la conexion a la bd
	require_once("database_credentials.php");
	//se crea una instancia de conexion de la bd
	$con = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);
	if($con->connect_errno){
		echo "Error al conectarse {$con->connect_errno}";
		die();
	}
	//funcion que ejecuta una consulta sql que muestra todos los registros existentes
	function run_app(){
		global $con;
		$query = "select * from user";
		$res=$con->query($query);
		return $res;
	}
	//funcion que añade un usuario a la bd
	function add($email, $password){
		global $con;
		$query = "insert into user(email,password) values('$email','$password')";
		$res=$con->query($query);
		return $res;
	}
	//funcion que modifica un registro existente de la bd
	function modify($id, $email, $password){
		global $con;
		$query = "update user set email = '$email', password='$password' where id='$id'";
		$res=$con->query($query);
		return $res;
	}
	//funcion que busca los datos de un registro por su id
	function search($id){
		global $con;
		$query = "select * from user where id = '$id'";
		$res=$con->query($query);
		return $res;
	}
	//funcion que eliminar un registro de la bd
	function delete($id){
		global $con;
		$query = "delete from user where id = '$id'";
		$res=$con->query($query);
		return $res;
	}

?>