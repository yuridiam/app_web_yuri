<?php
//Se manda a llamar el archivo que contiene la conexion a la base de datos
require_once("conexion.php");

//Clase general que contiene todos los modelos que consume el controlador principal y que exitene la clase conexion que se encuentra en el modelo conexion
Class Datos extends Conexion{

	//Modelo que selecciona los datos de un maestro si este ya esta registrado
	public function ingresoUsuarioModel($datosModel, $tabla){
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

	}

	//Modelo que consulta los datos de diferentes tablas que utiliza el controler
	public function consultarModel($tabla){
		//Se comprrueba que la tabla sea todas menos tutoria_detalles porque esta no contiene el campo de eliminado
		if($tabla!="tutoria_detalles"){
			//se prepara la consulta
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE eliminado=0");
		}else{
			//se prepara la consulta
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
		}
		//se ejecuta la consulta
		$stmt->execute();
		//se retornan todas las filas devueltas
		return $stmt->fetchAll();
		//se cierra la consulta
		$stmt->close();

	}

	//Modelo que busca una matricula en especifico
	public function buscarMatriculaModel($tabla, $matricula){
		//Se prepara la consulta
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE matricula = '$matricula' AND eliminado=0");
		//se ejecuta la consulta
		$stmt->execute();
		//se retorna el numero de filas encontradas
		return $stmt->rowCount();
		//se cierra la consulta
		$stmt->close();
	}

	//Modelo que agrega a un alumno a la base de datos
	public function agregarAlumnoModel($tabla, $datosModel){
		//se almacenan los datos en variables
		$mat = $datosModel["matricula"];
		$nom = $datosModel["nombre"];
		$car = $datosModel["carrera"];
		$tut = $datosModel["tutor"];
		//se ejecuta la consulta
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (matricula,nombre,id_carrera,id_tutor) VALUES('$mat','$nom','$car','$tut')");
		//se retorna el resultado de la consulta
		return $stmt->execute();
		//se cierra la consulta
		$stmt->close();

	}

	//Modelo que busca una carrera en especifico
	public function buscarCarreraModel($id){
		//Se prepara la consulta
		$stmt = Conexion::conectar()->prepare("SELECT * FROM carrera WHERE id = '$id' AND eliminado=0");
		//Se ejecuta la consulta
		$stmt->execute();
		//Se retorna el resultado de la consulta
		return $stmt->fetch();
		//Se cierra la consulta
		$stmt->close();
	}

	//Modelo que busca un tutor en especifico
	public function buscarTutorModel($id){
		//Se prepara la consulta
		$stmt = Conexion::conectar()->prepare("SELECT * FROM maestro WHERE idempleado = '$id' AND eliminado=0");
		//Se ejecuta la consulta
		$stmt->execute();
		//Se retorna el resultado
		return $stmt->fetch();
		//Se cierra la consulta
		$stmt->close();
	}

	//Modelo que trae los datos de un alumno en especifico
	public function editarAlumnosModel($datosModel){
		//Se prepara la consulta
		$stmt = Conexion::conectar()->prepare("SELECT * FROM alumno WHERE matricula ='$datosModel' AND eliminado=0");
		//Se ejecuta la consulta
		$stmt->execute();
		//Se retorna el resultado
		return $stmt->fetch();
		//Se cierra la consulta
		$stmt->close();
	}

	//Modelo que modifica un alumno en especifico
	public function modificarAlumnosModel($datosModel){
		//Se almacenan los datos en variables
		$m = $datosModel["matricula"];
		$n = $datosModel["nombre"];
		$c = $datosModel["carrera"];
		$t = $datosModel["tutor"];
		//Se prepara la consulta
		$stmt = Conexion::conectar()->prepare("UPDATE alumno SET nombre='$n', id_carrera='$c', id_tutor='$t' WHERE matricula='$m'");
		//Se retorna la ejecucion de la consulta
		return $stmt->execute();
		//Se cierra la consulta
		$stmt->close();

	}

	//Modelo que borra un alumno logicamente de la base de datos
	public function borrarAlumnosModel($datosModel, $tabla){
		//Se prepara la consulta
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET eliminado=1 WHERE matricula='$datosModel'");
		//Si se ejecuta se devuelve un success
		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}
		//Se cierra la consulta
		$stmt->close();
	}

	//Modelo que trae los datos de un maestro en especifico
	public function editarMaestrosModel($datosModel){
		//Se prepara la consulta
		$stmt = Conexion::conectar()->prepare("SELECT * FROM maestro WHERE idempleado ='$datosModel' AND eliminado=0");
		//Se ejecuta la consulta
		$stmt->execute();
		//Se retorna el resultado
		return $stmt->fetch();
		//Se cierra la consulta
		$stmt->close();
	}

	//Modelo que modifica los datos del maestro en la base de datos
	public function modificarMaestrosModel($datosModel){
		//Se almacenan los datos en variables
		$m = $datosModel["id"];
		$n = $datosModel["nombre"];
		$c = $datosModel["carrera"];
		$e = $datosModel["email"];
		$p = $datosModel["pass"];
		//Se prepara la consulta
		$stmt = Conexion::conectar()->prepare("UPDATE maestro SET nombre='$n',id_carrera='$c',email='$e',pass='$p' WHERE idempleado='$m'");
		//Se ejecuta la consulta
		return $stmt->execute();
		//Se cierra la consulta
		$stmt->close();

	}

	//Modelo que borra logicamente un maestro
	public function borrarMaestrosModel($datosModel, $tabla){
		//Se prepara la consulta
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET eliminado=1 WHERE idempleado='$datosModel'");
		//Se verifica la ejecucion de la consulta y se manda success si se lleva a cabo
		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}
		//Se cierra la consulta
		$stmt->close();
	}

	//Modelo que agrega un maestro a la base de datos
	public function agregarMaestroModel($datosModel){
		//Se almacena los datos en variables
		$id = $datosModel["id"];
		$nom = $datosModel["nombre"];
		$car = $datosModel["carrera"];
		$email = $datosModel["email"];
		$pass = $datosModel["pass"];
		//Se prepara la consulta
		$stmt = Conexion::conectar()->prepare("INSERT INTO maestro(idempleado,id_carrera,nombre,email,pass) VALUES('$id','$car','$nom','$email','$pass')");
		//Se retorna el resultado de la consulta
		return $stmt->execute();
		//Se cierra la consulta
		$stmt->close();
	}

	//Modelo que busca un id en especifico
	public function buscarIdModel($tabla, $id){
		//Se prepara la consulta
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE idempleado = '$id' AND eliminado=0");
		//Se ejecuta la consulta
		$stmt->execute();
		//Se retorna el numero de filas devueltas
		return $stmt->rowCount();
		//Se cierra la consulta
		$stmt->close();
	}

	//Modelo que agrega una carrera a la base de datos
	public function agregarCarreraModel($datosModel){
		//Se almacenan los datos en variables
		$nom = $datosModel["nombre"];
		$sig = $datosModel["siglas"];
		//Se prepara la consulta
		$stmt = Conexion::conectar()->prepare("INSERT INTO carrera(nombre,siglas) VALUES('$nom','$sig')");
		//Se devuelve el resultado de la ejecucion de la consulta
		return $stmt->execute();
		//Se cierra la consulta
		$stmt->close();
	}

	//Modelo que trae los datos de una carrera a la vista
	public function editarCarrerasModel($datosModel){
		//Se prepara la consulta
		$stmt = Conexion::conectar()->prepare("SELECT * FROM carrera WHERE id ='$datosModel' AND eliminado=0");
		//Se ejecuta la consulta
		$stmt->execute();
		//Se retorna el resultado
		return $stmt->fetch();
		//Se cierra la consulta
		$stmt->close();
	}

	//Modelo que modifica una carrera en la base de datos
	public function modificarCarrerasModel($datosModel){
		//Se almacenan los datos en variables
		$id = $datosModel["id"];
		$n = $datosModel["nombre"];
		$s = $datosModel["siglas"];
		//Se prepara la consulta
		$stmt = Conexion::conectar()->prepare("UPDATE carrera SET nombre='$n',siglas='$s' WHERE id='$id'");
		//Se retorna el resultado de la ejecucion
		return $stmt->execute();
		//Se cierra la consulta
		$stmt->close();
	}

	//Modelo que borra logicamente una carrera
	public function borrarCarrerasModel($datosModel, $tabla){
		//Se prepara la consulta
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET eliminado=1 WHERE id='$datosModel'");
		//Si se ejecuta correctamente se retorna success
		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}
		//Se cierra la consulta
		$stmt->close();
	}

	//Modelo que trae todos los alumnos de un solo tutor
	public function consultarAlumnosModel($tabla,$id){
		//Se prepara la consulta
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE eliminado=0 AND id_tutor='$id'");
		//Se ejecuta la consulta
		$stmt->execute();
		//Se retorna todas las filas encontradas
		return $stmt->fetchAll();
		//Se cierra la consulta
		$stmt->close();
	}

	//Modelo que registra una tutoria en la base de datos
	public function registrarTutoriaModel($datosModel){
		//se almacenan los datos en variables
		$idtutor = $datosModel["tutor"];
		$hora = $datosModel["hora"];
		$fecha = $datosModel["fecha"];
		$desc = $datosModel["desc"];
		//Se prepara la conexion
		$stmt = Conexion::conectar()->prepare("INSERT INTO tutoria(id_maestro,hora,fecha,tutoria) VALUES('$idtutor', '$hora', '$fecha', '$desc')");
		//Se ejecuta la consulta
		return $stmt->execute();
		//Se cierra la consulta
		$stmt->close();
	}

	//Modelo que consulta una tutoria en especifico
	public function consultarTModel($id){
		//Se prepara la consulta
		$stmt = Conexion::conectar()->prepare("SELECT * FROM tutoria WHERE eliminado = 0 AND id_maestro='$id'");
		//Se ejecuta la consulta
		$stmt->execute();
		//Se retorna los resultados encontrados
		return $stmt->fetchAll();
		//Se cierra la consulta
		$stmt->close();
	}

	//Modelo que trae la ultima tutoria registrada
	public function traerUltimaTutoriaModel(){
		//Se prepara la consulta
		$stmt = Conexion::conectar()->prepare("SELECT * FROM tutoria WHERE eliminado = 0 ORDER BY id DESC LIMIT 1");
		//Se ejecuta la consulta
		$stmt->execute();
		//Se retorna el resultado
		return $stmt->fetch();
		//Se cierra la consulta
		$stmt->close();
	}

	//Modelo que inserta un detalle a la tutoria
	public function insertarDetalleModel($tutoria, $tutor, $alumno){
		//Se prepara la consulta
		$stmt = Conexion::conectar()->prepare("INSERT INTO tutoria_detalles(id_tutoria,id_maestro,id_alumno) VALUES('$tutoria', '$tutor', '$alumno')");
		//Se retorna el resultado de la ejecucion
		return $stmt->execute();
		//Se cierra la consulta
		$stmt->close();
	}

	//Modelo que borra logicamente una tutoria
	public function borrarTutoriaModel($id){
		//Se prepara la consulta
		$stmt = Conexion::conectar()->prepare("UPDATE tutoria SET eliminado=1 WHERE id='$id'");
		//Si se ejecuta con exito se devuelve success
		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}
		//Se cierra la consulta
		$stmt->close();
	}

	//Modelo que consulta una tutoria en especifico
	public function consultarTutoriaModel($id){
		//Se prepara la consulta
		$stmt = Conexion::conectar()->prepare("SELECT * FROM tutoria WHERE id = '$id'");
		//Se ejecuta la consulta
		$stmt->execute();
		//Se retorna el resultado
		return $stmt->fetch();
		//Se cierra la consulta
		$stmt->close();
	}

	//Modelo que selecciona todos los detalles de una tutoria en especifico
	public function alumnosTutoriasModel($id){
		//Se prepara la consulta
		$stmt = Conexion::conectar()->prepare("SELECT * FROM tutoria_detalles WHERE id_tutoria = '$id'");
		//Se ejecuta la consulta
		$stmt->execute();
		//Se retorna los resultados encontrados
		return $stmt->fetchAll();
		//Se cierra la consulta
		$stmt->close();
	}

	//Modelo que busca un alumno en especifico
	public function buscarAlumnoModel($mat){
		//Se prepara la consulta
		$stmt = Conexion::conectar()->prepare("SELECT * FROM alumno WHERE matricula = '$mat'");
		//Se ejecuta la consulta
		$stmt->execute();
		//Se retorna el resultado
		return $stmt->fetch();
		//Se cierra la consulta
		$stmt->close();
	}

	//Modelo que busca un alumno en especifico
	public function buscarTutModel(){
		//Se prepara la consulta
		$stmt = Conexion::conectar()->prepare("SELECT * FROM tutoria");
		//Se ejecuta la consulta
		$stmt->execute();
		//Se retorna el resultado
		return $stmt->fetchAll();
		//Se cierra la consulta
		$stmt->close();
	}

	public function buscarNombreTutorModel($id){
		//Se prepara la consulta
		$stmt = Conexion::conectar()->prepare("SELECT * FROM maestro WHERE idempleado='$id'");
		//Se ejecuta la consulta
		$stmt->execute();
		//Se retorna el resultado
		return $stmt->fetch();
		//Se cierra la consulta
		//$stmt->close();
	}
}

?>
