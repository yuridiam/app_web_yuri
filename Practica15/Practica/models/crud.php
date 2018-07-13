<?php
//Se manda a llamar el archivo que contiene la conexion a la base de datos
require_once("conexion.php");

//Clase general que contiene todos los modelos que consume el controlador principal y que exitene la clase conexion que se encuentra en el modelo conexion
Class Datos extends Conexion{

	public function ingresoUsuarioModel($datosController,$tabla){

		$u = $datosController["usuario"];
		$c = $datosController["contra"];

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE usuario = '$u' AND pass = '$c' AND eliminado=0");
		//Se ejecuta la consulta
		if($stmt->execute()){
			//Se retorna la fila si es que existe
			$usuario = $stmt->fetch();
			$tipo = $usuario["tipo_usuario"];
			echo $tipo;
			return $tipo;
		}else{
			return "error";
		}
		//se cierra la consulta
		$stmt->close();
	}

	//Este modelo registra un alumno en la base de datos recibiendo como parámetro los datos a registrar dentro de un array y el nombre de la tabla en donde se insertaran, posteriormente se prepara la consulta y se ejecuta. Al ejecutarse se retorna su fue exitosa o no.
	public function registrarAlumnoModel($datosController, $tabla){

		$matricula = $datosController["matricula"];
		$nombre = $datosController["nombre"];
		$grupo = $datosController["grupo"];
		$carrera = $datosController["carrera"];
		$foto = $datosController["foto"];

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(matricula_alumno, nombre_alumno, id_grupo, id_carrera, img_alumno) VALUES('$matricula', '$nombre', '$grupo', '$carrera', '$foto')");

		return $stmt->execute();
		$stmt->close();
	}
	
	//Este modelo prepara una consulta para tomar todos los registros existentes logicamente en la base de datos de los grupos.
	public function consultarGruposModel(){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM grupo WHERE  eliminado=0");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	//Este modelo prepara una consulta para tomar todos los registros existentes logicamente en la base de datos de los profesores.
	public function consultarProfesoresModel(){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM maestro WHERE  eliminado=0");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	//Este modelo prepara una consulta para tomar todos los registros existentes logicamente en la base de datos de las carreras.
	public function consultarCarrerasModel(){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM carreras");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	//Este modelo prepara una consulta que consulta la informacion de un profesor en especifico recibiendo como parametro el id del profesor.
	public function buscarProfesorModel($id){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM maestro WHERE id_maestro = '$id'");
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();

	}

	//Este modelo prepara una consulta para tomar todos los registros existentes logicamente en la base de datos de los alumnos.
	public function consultarAlumnosModel(){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM alumno WHERE eliminado=0");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	//Este modelo prepara una consulta que consulta la informacion de un grupo en especifico recibiendo como parametro el id del grupo.
	public function buscarGrupoModel($id){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM grupo WHERE id_grupo = '$id'");
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();

	}
	//Este modelo prepara una consulta para tomar todos los registros existentes logicamente en la base de datos de las actividades.
	public function consultarActividadModel(){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM actividad WHERE eliminado=0");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	//Este modelo prepara una consulta que consulta la informacion de una carrera en especifico recibiendo como parametro el id de la carrera.
	public function buscarCarreraModel($id){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM carreras WHERE id_carrera = '$id'");
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();

	}

	//Este modelo prepara una consulta que consulta la informacion de una actividad en especifico recibiendo como parametro el id de la actividad.
	public function buscarActividadModel($id){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM actividad WHERE id_actividad = '$id'");
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();

	}

	//Este modelo prepara una consulta que consulta la informacion de un alumno en especifico recibiendo como parametro el id del alumno.
	public function buscarAlumnoModel($id){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM alumno WHERE id_alumno = '$id'");
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();

	}

	//Este modelo recibe como parametros los datos de un alumno y el nombre de la tabla en la base de datos para realizar una consulta update y actualizar los datos devolviendo si fue exitosa o no
	public function modificarAlumnoModel($datosController, $tabla){

		$matricula = $datosController["matricula"];
		$nombre = $datosController["nombre"];
		$grupo = $datosController["grupo"];
		$carrera = $datosController["carrera"];
		$foto = $datosController["foto"];
		$id = $datosController["id"];

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET matricula_alumno = '$matricula', nombre_alumno='$nombre', id_grupo='$grupo', id_carrera='$carrera', img_alumno='$foto' WHERE id_alumno='$id'");

		return $stmt->execute();
		$stmt->close();
	}

	//Este modelo elimina logicamente, es decir cambia el estado de un alumno a eliminado en la base de datos.
	public function eliminarAlumnoModel($id){

		$stmt = Conexion::conectar()->prepare("UPDATE alumno SET eliminado = 1 WHERE id_alumno='$id'");
		return $stmt->execute();
		$stmt->close();
	}

	//Este modelo registra un profesor en la base de datos recibiendo los datos en un array y el nombre de la tabla.
	public function registrarProfesorModel($datosController, $tabla){

		$emp = $datosController["emp"];
		$nombre = $datosController["nombre"];
		$fechaN = $datosController["fechaNa"];
		$tel = $datosController["telefono"];
		$dir = $datosController["direcc"];
		$us = $datosController["usuario"];
		$con = $datosController["contra"];
		$foto = $datosController["foto"];

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(numero_empleado, nombre_maestro, telefono_maestro, direccion_maestro, fecha_nac, img_maestro, usuario, pass, tipo_usuario) VALUES('$emp', '$nombre', '$tel', '$dir', '$fechaN', '$foto', '$us', '$con', 2)");

		return $stmt->execute();
		$stmt->close();
	}

	//Este modelo prepara una consulta con todos los registros de profesores existentes logicamente en la base de datos.
	public function consultarProfesorModel(){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM maestro WHERE eliminado=0 AND tipo_usuario=2");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	//Este modelo modifica la informacion de un registro de un profesor en especifico en la base de datos.
	public function modificarProfesorModel($datosController, $tabla){

		$emp = $datosController["emp"];
		$nombre = $datosController["nombre"];
		$fechaN = $datosController["fechaNa"];
		$tel = $datosController["tel"];
		$dir = $datosController["dir"];
		$usuario = $datosController["usuario"];
		$contra = $datosController["contra"];
		$img = $datosController["foto"];
		$id = $datosController["id"];

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET numero_empleado = '$emp', nombre_maestro='$nombre', telefono_maestro='$tel', direccion_maestro='$dir', fecha_nac='$fechaN', img_maestro='$img', usuario='$usuario', pass='$contra' WHERE id_maestro='$id'");

		return $stmt->execute();
		$stmt->close();
	}


	//Este modelo elimina logicamente un registro de profesor en la base de datos.
	public function eliminarProfesorModel($id){

		$stmt = Conexion::conectar()->prepare("UPDATE maestro SET eliminado = 1 WHERE id_maestro='$id'");
		return $stmt->execute();
		$stmt->close();
	}

	//Este modelo registra una actividad en la base de datos recibiendo como parametro los datos y el nombre de la tabla
	public function registrarActividadModel($datosController, $tabla){

		$nombre = $datosController["nombre"];
		$des = $datosController["desc"];

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre_actividad, desc_actividad) VALUES('$nombre', '$des')");

		return $stmt->execute();
		$stmt->close();
	}

	//Esta actividad modifica la informacion de una actividad en particular de la base de datos
	public function modificarActividadModel($datosController, $tabla){

		$nombre = $datosController["nombre"];
		$desc = $datosController["desc"];
		$id = $datosController["id"];

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre_actividad='$nombre', desc_actividad='$desc' WHERE id_actividad='$id'");

		return $stmt->execute();
		$stmt->close();
	}

	//Este modelo elimina una actividad de la base de datos
	public function eliminarActividadModel($id){

		$stmt = Conexion::conectar()->prepare("UPDATE actividad SET eliminado = 1 WHERE id_actividad='$id'");
		return $stmt->execute();
		$stmt->close();
	}


	//Este modelo registra un grupo en la base de datos
	public function registrarGrupoModel($datosController, $tabla){
		$codigo = $datosController["codigo"];
		$maestro = $datosController["maestro"];
		$nivel = $datosController["nivel"];
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigo_grupo, id_maestro, nivel) VALUES('$codigo', '$maestro','$nivel')");
		return $stmt->execute();
		$stmt->close();
	}

	//Este modelo modifica la informacion de un grupo en particular de la base de datos
	public function modificarGrupoModel($datosController, $tabla){

		$cod = $datosController["codigo"];
		$maestro = $datosController["maestro"];
		$nivel = $datosController["nivel"];
		$id = $datosController["id"];

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET codigo_grupo='$cod', id_maestro='$maestro', nivel='$nivel' WHERE id_grupo='$id'");

		return $stmt->execute();
		$stmt->close();
	}

	//Este modelo elimina un grupo de la base de datos
	public function eliminarGrupoModel($id){

		$stmt = Conexion::conectar()->prepare("UPDATE grupo SET eliminado = 1 WHERE id_grupo='$id'");
		return $stmt->execute();
		$stmt->close();
	}

	//Modelo que cuenta los registros de diferentes tablas
	public function totalesModel($tabla){
		//se prepara la consulta
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE eliminado=0");
		//se ejecuta la consulta
		$stmt->execute();
		//se retornan todas las filas devueltas
		return $stmt->rowCount();
		//se cierra la consulta
		$stmt->close();

	}

	//Este modelo consulta todos los registros existentes de alumnos logicamente en la base de datos
	public function consultarAlumnoModel(){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM alumno WHERE  eliminado=0");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	//Este modelo consulta todos los registros existentes de actividades logicamente en la base de datos
	public function consultarActividadesModel(){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM actividad WHERE  eliminado=0");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}






}

?>
