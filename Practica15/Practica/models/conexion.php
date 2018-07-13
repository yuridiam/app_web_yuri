<?php
//Clase conexion que permite acceder a la base de datos con PDO
	class Conexion{
		//unico metodo
		public function conectar(){
			$link = new PDO("mysql:host=localhost;dbname=cai","root","jonasyuridia");
			return $link;
		}
	}


?>