<?php
//Se manda a llamar el archivo que contiene la conexion a la base de datos
require_once("conexion.php");

//Clase general que contiene todos los modelos que consume el controlador principal y que exitene la clase conexion que se encuentra en el modelo conexion
Class Datos extends Conexion{

	//Modelo que consulta los datos que se mandaron desde el controlador en la base de datos
	public function ingresoUsuarioModel($datosModel, $tabla){
		//Se almacenan los datos del array datosModel en variables separadas
		$u = $datosModel["usuario"];
		$c = $datosModel["contra"];
		//Se prepara la consulta
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE usuario = '$u' AND pass = '$c'");
		//Se ejecuta la consulta
		$stmt->execute();
		//Se retorna la fila si es que existe
		return $stmt->fetch();
		//se cierra la consulta
		$stmt->close();

	}

}

?>
