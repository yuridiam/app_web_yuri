<?php

require_once("conexion.php");


Class Datos extends Conexion{


	public function ingresoUsuarioModel($datosModel, $tabla){

		$e = $datosModel["correo"];

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE email = '$e' AND eliminado=0");
		$stmt->execute();

		#fetch(): Obtiene una fila de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetch();

		$stmt->close();

	}

	public function consultarModel($tabla){

		if($tabla!="tutoria_detalles"){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE eliminado=0");
		}else{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
		}
		$stmt->execute();

		#fetch(): Obtiene una fila de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();

		$stmt->close();

	}

	public function buscarMatriculaModel($tabla, $matricula){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE matricula = '$matricula' AND eliminado=0");
		$stmt->execute();

		#fetch(): Obtiene una fila de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->rowCount();
		//return $stmt->fetchAll();
		$stmt->close();
	}

	public function agregarAlumnoModel($tabla, $datosModel){
		$mat = $datosModel["matricula"];
		$nom = $datosModel["nombre"];
		$car = $datosModel["carrera"];
		$tut = $datosModel["tutor"];
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (matricula,nombre,id_carrera,id_tutor) VALUES('$mat','$nom','$car','$tut')");
		return $stmt->execute();
		$stmt->close();

	}

	public function buscarCarreraModel($id){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM carrera WHERE id = '$id' AND eliminado=0");
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();

	}

	public function buscarTutorModel($id){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM maestro WHERE idempleado = '$id' AND eliminado=0");
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}

	public function editarAlumnosModel($datosModel){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM alumno WHERE matricula ='$datosModel' AND eliminado=0");
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}

	public function modificarAlumnosModel($datosModel){
		$m = $datosModel["matricula"];
		$n = $datosModel["nombre"];
		$c = $datosModel["carrera"];
		$t = $datosModel["tutor"];
		$stmt = Conexion::conectar()->prepare("UPDATE alumno SET nombre='$n', id_carrera='$c', id_tutor='$t' WHERE matricula='$m'");
		return $stmt->execute();
		$stmt->close();

	}

	public function borrarAlumnosModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET eliminado=1 WHERE matricula='$datosModel'");
		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}
		$stmt->close();
	}

	public function editarMaestrosModel($datosModel){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM maestro WHERE idempleado ='$datosModel' AND eliminado=0");
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}

	public function modificarMaestrosModel($datosModel){
		$m = $datosModel["id"];
		$n = $datosModel["nombre"];
		$c = $datosModel["carrera"];
		$e = $datosModel["email"];
		$p = $datosModel["pass"];
		$stmt = Conexion::conectar()->prepare("UPDATE maestro SET nombre='$n',id_carrera='$c',email='$e',pass='$p' WHERE idempleado='$m'");
		return $stmt->execute();
		$stmt->close();

	}

	public function borrarMaestrosModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET eliminado=1 WHERE idempleado='$datosModel'");
		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}
		$stmt->close();
	}

	public function agregarMaestroModel($datosModel){
		$id = $datosModel["id"];
		$nom = $datosModel["nombre"];
		$car = $datosModel["carrera"];
		$email = $datosModel["email"];
		$pass = $datosModel["pass"];
		$stmt = Conexion::conectar()->prepare("INSERT INTO maestro(idempleado,id_carrera,nombre,email,pass) VALUES('$id','$car','$nom','$email','$pass')");
		return $stmt->execute();
		$stmt->close();
	}

	public function buscarIdModel($tabla, $id){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE idempleado = '$id' AND eliminado=0");
		$stmt->execute();

		#fetch(): Obtiene una fila de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->rowCount();
		//return $stmt->fetchAll();
		$stmt->close();
	}

	public function agregarCarreraModel($datosModel){
		$nom = $datosModel["nombre"];
		$sig = $datosModel["siglas"];
		$stmt = Conexion::conectar()->prepare("INSERT INTO carrera(nombre,siglas) VALUES('$nom','$sig')");
		return $stmt->execute();
		$stmt->close();
	}

	public function editarCarrerasModel($datosModel){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM carrera WHERE id ='$datosModel' AND eliminado=0");
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}

	public function modificarCarrerasModel($datosModel){
		$id = $datosModel["id"];
		$n = $datosModel["nombre"];
		$s = $datosModel["siglas"];
		$stmt = Conexion::conectar()->prepare("UPDATE carrera SET nombre='$n',siglas='$s' WHERE id='$id'");
		return $stmt->execute();
		$stmt->close();
	}

	public function borrarCarrerasModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET eliminado=1 WHERE id='$datosModel'");
		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}
		$stmt->close();
	}

}



?>
