<?php
//Se manda a llamar el archivo que contiene la conexion a la base de datos
require_once("conexion.php");

//Clase general que contiene todos los modelos que consume el controlador principal y que exitene la clase conexion que se encuentra en el modelo conexion
Class Datos extends Conexion{

	public function ingresoUsuarioModel($datosController,$tabla){

		$stmt = Conexion::conectar()->prepare("SELECT tipo_usuario FROM $tabla WHERE usuario = :u AND pass = :c AND eliminado=0");
		//Se ejecuta la consulta

		$stmt->bindParam(':u',$datosController["usuario"]);
		$stmt->bindParam(':c',$datosController["contra"]);

		if($stmt->execute()){
			//Se retorna la fila si es que existe
			$usuario = $stmt->fetchColumn();
			if ($usuario){
				return $usuario["tipo_usuario"];
			}
		}

		return "error";
		//se cierra la consulta
		$stmt->close();
	}
	public function getUnitByDateModel($datosModel){
		$stmt = Conexion::conectar()->prepare("SELECT unidad FROM unidad WHERE DATE_FORMAT(:hoy,'%m-%d') >= DATE_FORMAT(fecha_inicio,'%m-%d') AND DATE_FORMAT(:hoy,'%m-%d') <= DATE_FORMAT(fecha_fin,'%m-%d')");
		$stmt->bindParam(":hoy",$datosModel);
		$stmt->execute();
		return $stmt->fetch();

	}

	//Este modelo registra un alumno en la base de datos recibiendo como parámetro los datos a registrar dentro de un array y el nombre de la tabla en donde se insertaran, posteriormente se prepara la consulta y se ejecuta. Al ejecutarse se retorna su fue exitosa o no.
	public function registrarAlumnoModel($datosController, $tabla){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(matricula_alumno, nombre_alumno, id_carrera, img_alumno) VALUES(:matricula, :nombre, :carrera, :foto)");

		$stmt->bindParam(':matricula',$datosController["matricula"]);
		$stmt->bindParam(':nombre',$datosController["nombre"]);
		$stmt->bindParam(':carrera',$datosController["carrera"]);
		$stmt->bindParam(':foto',$datosController["foto"]);


		return $stmt->execute();
		$stmt->close();
	}
	
	//Este modelo prepara una consulta para tomar todos los registros existentes logicamente en la base de datos de los grupos.
	public function consultarGruposAlumnoModel($datosModel){
		$stmt = Conexion::conectar()->prepare("SELECT alumno.matricula_alumno, alumno.id_alumno, alumno.nombre_alumno FROM alumno_grupo  inner join alumno on alumno_grupo.id_alumno  = alumno.id_alumno where alumno_grupo.id_grupo = :id_grupo");
		$stmt->bindParam(":id_grupo",$datosModel);
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}
  public function reiniciarModel(){
    $stmt = Conexion::conectar()->prepare("DELETE FROM entrada");
		$stmt->execute();
    $stmt = Conexion::conectar()->prepare("ALTER TABLE entrada AUTO_INCREMENT=1");
    return $stmt->execute();
  }
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
	//Este modelo prepara una consulta para tomar todos los registros existentes logicamente en la base de datos de las actividades.
	public function consultarSesionActivaModel(){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM sesion inner join alumno on sesion.id_alumno = alumno.id_alumno inner join actividad on sesion.id_actividad = actividad.id_actividad inner join maestro on sesion.id_maestro = maestro.id_maestro");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}
	//Este modelo prepara una consulta para tomar todos los registros existentes logicamente en la base de datos de las actividades.
	public function consultarSesionAlumnoModel($datosModel){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM sesion where id_alumno = :id_alumno");
		$stmt->bindParam(':id_alumno',$datosModel);
		$stmt->execute();
		return $stmt->fetch();
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


		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET matricula_alumno = :matricula, nombre_alumno= :nombre, id_carrera= :carrera, img_alumno= :foto WHERE id_alumno= :id");

		//$stmt->bindParam(':m',$datosController["contra"]);
		$stmt->bindParam(':matricula',$datosController["matricula"]);
		$stmt->bindParam(':nombre',$datosController["nombre"]);
		$stmt->bindParam(':carrera',$datosController["carrera"]);
		$stmt->bindParam(':foto',$datosController["foto"]);
		$stmt->bindParam(':id',$datosController["id"]);

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
    
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (numero_empleado, nombre_maestro, telefono_maestro, direccion_maestro, fecha_nac, img_maestro, usuario, pass, tipo_usuario) VALUES('$emp','$nombre', '$tel','$dir', '$fechaN', '$foto', '$us', '$con', 2)");
    
		/*$stmt->bindParam(':emp',$datosController["emp"]);
		$stmt->bindParam(':nombre',$datosController["nombre"]);
		$stmt->bindParam(':fechaN',$datosController["fechaNa"]);
		$stmt->bindParam(':tel',$datosController["telefono"]);
		$stmt->bindParam(':dir',$datosController["direcc"]);
		$stmt->bindParam(':us',$datosController["usuario"]);
		$stmt->bindParam(':con',$datosController["contra"]);
		$stmt->bindParam(':foto',$datosController["foto"]);*/
    

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

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET numero_empleado = :emp, nombre_maestro= :nombre, telefono_maestro= :tel, direccion_maestro= :dir, fecha_nac= :fechaN, img_maestro= :foto, usuario= :us, pass= :con WHERE id_maestro= :id ");

		$stmt->bindParam(':emp',$datosController["emp"]);
		$stmt->bindParam(':nombre',$datosController["nombre"]);
		$stmt->bindParam(':fechaN',$datosController["fechaNa"]);
		$stmt->bindParam(':tel',$datosController["tel"]);
		$stmt->bindParam(':dir',$datosController["dir"]);
		$stmt->bindParam(':us',$datosController["usuario"]);
		$stmt->bindParam(':con',$datosController["contra"]);
		$stmt->bindParam(':foto',$datosController["foto"]);
		$stmt->bindParam(':id',$datosController["id"]);


		return $stmt->execute();
		$stmt->close();
	}


	//Este modelo elimina logicamente un registro de profesor en la base de datos.
	public function limpiarAlumnoDeSesion($datosModel,$tabla){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla where id_alumno = '$datosModel'");
		return $stmt->execute();
		$stmt->close();
	}
  
  public function reponerActividad($datosModel,$tabla){
    $stmt = Conexion::conectar()->prepare("SELECT lugares from actividad where id_actividad = '$datosModel'");
    $stmt->execute();
    $actividad = $stmt->fetch(PDO::FETCH_NUM);
    
    
    $new = $actividad[0]+1;
    
    $stmt = Conexion::conectar()->prepare("UPDATE actividad SET lugares = $new where id_actividad = '$datosModel'");
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

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre_actividad, desc_actividad, lugares) VALUES('$nombre', '$des',:lugares)");
		$stmt->bindParam(':lugares',$datosController["lugares"]);

		return $stmt->execute();
		$stmt->close();
	}

	public function registrarSesionModel($datosModel,$tabla){
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id_alumno, id_actividad, id_maestro, fecha, hora_entrada, unidad) VALUES(:id_alumno, :id_actividad, :id_maestro ,:fecha,:hora_entrada,:unidad)");

		$stmt->bindParam(':id_alumno',$datosModel["alumno"]);
		$stmt->bindParam(':id_maestro',$datosModel["maestro"]);
		$stmt->bindParam(':id_actividad',$datosModel["actividad"]);
		$stmt->bindParam(':fecha',$datosModel["fecha"]);
		$stmt->bindParam(':hora_entrada',$datosModel["entrada"]);
		$stmt->bindParam(':unidad',$datosModel["unidad"]);


		return $stmt->execute();
		$stmt->close();
	}

	public function registrarSesionDeAlumno($datosModel,$tabla){
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id_alumno, id_actividad, id_maestro, fecha, hora_entrada, hora_salida, horas, unidad) VALUES(:id_alumno, :id_actividad, :id_maestro ,:fecha,:hora_entrada,:hora_salida,:horas,:unidad)");

		$stmt->bindParam(':id_alumno',$datosModel["id_alumno"]);
		$stmt->bindParam(':id_maestro',$datosModel["id_maestro"]);
		$stmt->bindParam(':id_actividad',$datosModel["id_actividad"]);
		$stmt->bindParam(':fecha',$datosModel["fecha"]);
		$stmt->bindParam(':hora_entrada',$datosModel["hora_entrada"]);
		$stmt->bindParam(':hora_salida',$datosModel["hora_salida"]);
		$stmt->bindParam(':horas',$datosModel["horas"]);
		$stmt->bindParam(':unidad',$datosModel["unidad"]);

		$stmt->execute();

		$stmt = Conexion::conectar()->prepare("DELETE FROM sesion where id_alumno = :id_alumno");
		$stmt->bindParam(':id_alumno',$datosModel["id_alumno"]);
		return $stmt->execute();

		$stmt->close();
	}

	//Esta actividad modifica la informacion de una actividad en particular de la base de datos
	public function modificarActividadModel($datosController, $tabla){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET lugares = :lugares, nombre_actividad= :nombre, desc_actividad= :des WHERE id_actividad= :id ");

		$stmt->bindParam(':lugares',$datosController["lugares"]);
		$stmt->bindParam(':nombre',$datosController["nombre"]);
		$stmt->bindParam(':des',$datosController["desc"]);
		$stmt->bindParam(':id',$datosController["id"]);

		return $stmt->execute();
		$stmt->close();
	}

	//Este modelo elimina una actividad de la base de datos
	public function eliminarActividadModel($id){

		$stmt = Conexion::conectar()->prepare("UPDATE actividad SET eliminado = 1 WHERE id_actividad='$id'");
		return $stmt->execute();
		$stmt->close();
	}

	public function eliminarAlumnoGrupoModel($id){

		$stmt = Conexion::conectar()->prepare("DELETE FROM alumno_grupo where id_alumno = :id_alumno");
		echo "<script> alert(DELETE FROM alumno_grupo where id_alumno = $id)</script>";
		$stmt->bindParam(":id_alumno",$id);
		return $stmt->execute();
		$stmt->close();
	}


	//Este modelo registra un grupo en la base de datos
	public function registrarGrupoModel($datosController, $tabla){
		
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigo_grupo, id_maestro, nivel) VALUES( :codigo, :maestro, :nivel)");



		$stmt->bindParam(':codigo',$datosController["codigo"]);
		$stmt->bindParam(':maestro',$datosController["maestro"]);
		$stmt->bindParam(':nivel',$datosController["nivel"]);

		return $stmt->execute();
		$stmt->close();
	}

	//Este modelo modifica la informacion de un grupo en particular de la base de datos
	public function modificarGrupoModel($datosController, $tabla){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET codigo_grupo= :cod, id_maestro= :maestro, nivel= :nivel WHERE id_grupo= :id");

		$stmt->bindParam(':cod',$datosController["codigo"]);
		$stmt->bindParam(':maestro',$datosController["maestro"]);
		$stmt->bindParam(':nivel',$datosController["nivel"]);
		$stmt->bindParam(':id',$datosController["id"]);

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
  
  public function consultarHorasModel($id){
		$stmt = Conexion::conectar()->prepare("select alumno.matricula_alumno, alumno.nombre_alumno, entrada.unidad, sum(entrada.horas)as 'total' from entrada inner join alumno on entrada.id_alumno = alumno.id_alumno WHERE entrada.id_maestro = '$id' group by entrada.unidad, entrada.id_alumno");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

  public function consultarIdMaestroModel($usuario){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM maestro WHERE usuario = '$usuario'");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}


  public function consultarReporteModel($id){
		$stmt = Conexion::conectar()->prepare("select alumno.matricula_alumno, alumno.nombre_alumno, entrada.unidad, sum(entrada.horas)as 'total' from entrada inner join alumno on entrada.id_alumno = alumno.id_alumno group by entrada.unidad, entrada.id_alumno");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}



}

?>
