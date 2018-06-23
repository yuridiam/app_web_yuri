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

	//Registra un grupo en la base de datos
	public function registroGrupoModel($grupo){
		$stmt = Conexion::conectar()->prepare("INSERT INTO grupos (nombre_grupo) VALUES('$grupo')");
		return $stmt->execute();
		$stmt->close();
	}

	//Obtiene los grupos de la base de datos
	public function vistaGrupoModel(){
		//Se prepara la consulta
		$stmt = Conexion::conectar()->prepare("SELECT * FROM grupos WHERE eliminado=0");
		//Se ejecuta la consulta
		$stmt->execute();
		//Se retorna la fila si es que existe
		return $stmt->fetchAll();
		//se cierra la consulta
		$stmt->close();
	}

	//Busca un grupo por su id
	public function buscarGrupoModel($id){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM grupos WHERE id_grupo = '$id'");
		//Se ejecuta la consulta
		$stmt->execute();
		//Se retorna la fila si es que existe
		return $stmt->fetch();
		//se cierra la consulta
		$stmt->close();
	}

	//Modifica un grupo 
	public function modificarGrupoModel($id, $grupo){
		$stmt = Conexion::conectar()->prepare("UPDATE grupos SET nombre_grupo='$grupo' WHERE id_grupo='$id'");
		//Se ejecuta la consulta
		return $stmt->execute();
		//se cierra la consulta
		$stmt->close();
	}

	//Elimina un grupo logicamente
	public function eliminarGrupoModel($id){

		$stmt = Conexion::conectar()->prepare("UPDATE grupos SET eliminado=1 WHERE id_grupo='$id'");
		//Se ejecuta la consulta
		$r = $stmt->execute();
		if($r){
			//Se prepara la segunda consulta
			$stmt2 = Conexion::conectar()->prepare("UPDATE alumnas SET eliminado=1 WHERE grupo_alumna='$id'");
			//Se ejecuta la consulta
			return $stmt2->execute();
			//Se cierra la consulta
			$stmt2->close();
		}
		//se cierra la consulta
		$stmt->close();

	}

	//Regitra una alumna a la base de datos
	public function registrarAlumnaModel($nombre,$apellido,$grupo,$fecha){
		//Se prepara la consulta
		$stmt = Conexion::conectar()->prepare("INSERT INTO alumnas (nombre_alumna,grupo_alumna,apellidos_alumna,fecha_nac) VALUES('$nombre','$grupo','$apellido','$fecha')");
		//Se ejecuta la consulta
		return $stmt->execute();
		//Se cierra la consulta
		$stmt->close();

	}

	//Obtiene los datos de las alumnas
	public function vistaAlumnasModel(){
		//Se prepara la consulta
		$stmt = Conexion::conectar()->prepare("SELECT * FROM alumnas WHERE eliminado=0");
		//Se ejecuta la consulta
		$stmt->execute();
		//Se retorna la fila si es que existe
		return $stmt->fetchAll();
		//se cierra la consulta
		$stmt->close();
	}

	//Busca una alumna en la base de datos por su id
	public function buscarAlumnaModel($id){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM alumnas WHERE id_alumna = '$id'");
		//Se ejecuta la consulta
		$stmt->execute();
		//Se retorna la fila si es que existe
		return $stmt->fetch();
		//se cierra la consulta
		$stmt->close();

	}

	//Modifica los datos de una alumna
	public function modificarAlumnaModel($id,$nombre,$apellido,$grupo,$fecha){
		$stmt = Conexion::conectar()->prepare("UPDATE alumnas SET nombre_alumna='$nombre', grupo_alumna='$grupo', apellidos_alumna='$apellido',fecha_nac='$fecha' WHERE id_alumna='$id'");
		//Se ejecuta la consulta
		return $stmt->execute();
		//se cierra la consulta
		$stmt->close();

	}

	//Elimina una alumna logicamente de la base de datos
	public function eliminarAlumnaModel($id){
		$stmt = Conexion::conectar()->prepare("UPDATE alumnas SET eliminado=1 WHERE id_alumna='$id'");
		//Se ejecuta la consulta
		return $stmt->execute();
		//Se cierra la consulta
		$stmt->close();
	}

	//Muestra los pagos existentes
	public function vistaPagosModel(){
		//Se prepara la consulta
		$stmt = Conexion::conectar()->prepare("SELECT * FROM pagos WHERE eliminado=0");
		//Se ejecuta la consulta
		$stmt->execute();
		//Se retorna la fila si es que existe
		return $stmt->fetchAll();
		//se cierra la consulta
		$stmt->close();
	}

	//Busca un pago en la base de datos por su id
	public function buscarPagoModel($id){
		//Se prepara la consulta
		$stmt = Conexion::conectar()->prepare("SELECT * FROM pagos WHERE id_pago='$id' AND eliminado=0");
		//Se ejecuta la consulta
		$stmt->execute();
		//Se retorna la fila si es que existe
		return $stmt->fetch();
		//se cierra la consulta
		$stmt->close();
	}

	//Modifica un pago 
	public function modificarPagoModel($id,$grupo,$alumna,$mNom,$mApe,$fecha_pago,$folio){
		$stmt = Conexion::conectar()->prepare("UPDATE pagos SET id_alumna='$alumna', id_grupo='$grupo',nom_mama='$mNom', ape_mama='$mApe',fecha_pago='$fecha_pago',folio='$folio' WHERE id_pago='$id'");
		//Se ejecuta la consulta
		return $stmt->execute();
		//se cierra la consulta
		$stmt->close();
	}

	//Elimina un pago logicamente de la base de datos
	public function eliminarPagoModel($id){
		$stmt = Conexion::conectar()->prepare("UPDATE pagos SET eliminado=1 WHERE id_pago='$id'");
		//Se ejecuta la consulta
		return $stmt->execute();
		//Se cierra la consulta
		$stmt->close();
	
	}

	//Registra un pago en la base de datos
	public function registrarPagoModel($grupo,$alumna,$nMa,$aMa,$fecha_pago,$img,$folio,$fecha_envio){
		//Se prepara la consulta
		$stmt = Conexion::conectar()->prepare("INSERT INTO pagos (id_alumna, id_grupo, nom_mama, ape_mama, fecha_pago, fecha_envio, url, folio) VALUES('$alumna', '$grupo','$nMa','$aMa','$fecha_pago','$fecha_envio','$img','$folio')");
		//Se ejecuta la consulta
		return $stmt->execute();
		//Se cierra la consulta
		$stmt->close();

	}

}

?>
