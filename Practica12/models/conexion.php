<?php
//Clase conexion que permite acceder a la base de datos con PDO
	class Conexion{
		//unico metodo
		public function conectar(){
			$link = new PDO("mysql:host=localhost;dbname=inventario","root","");
			return $link;
		}
	}


?>