<?php
//Se manda a llamar el archivo que contiene la conexion a la base de datos
require_once("conexion.php");

//Clase general que contiene todos los modelos que consume el controlador principal y que exitene la clase conexion que se encuentra en el modelo conexion
Class Datos extends Conexion{

	//Modelo que selecciona los datos de un maestro si este ya esta registrado
	/*public function ingresoUsuarioModel($datosModel, $tabla){
		//se obtiene el correo que sera la condicion con la que se buscara
		$e = $datosModel["correo"];
		//Se prepara la consulta
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE email = '$e' AND eliminado=0");
		//Se ejecuta la consulta
		$stmt->execute();
		//Se retorna la fila si es que existe
		return $stmt->fetch();
		//se cierra la consulta
		$stmt->close();

	}*/

	
}

?>
