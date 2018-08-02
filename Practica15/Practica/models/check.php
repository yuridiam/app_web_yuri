<?php
  //ARCHIVO PHP DONDE SE CONSUMEN LAS SENTENCIAS SQL QUE SE OCUPAN EN LAS OPERACIONES CON AJAX

  //Se requiere el archivo donde se hace la conexion a la base de datos con sus respectivas credenciales
	require_once("conexion.php");
  
  //Si se llego un metodo POST
	if(isset($_POST)){
    
    //Operacion para al momento de registrar un alumno nuevo en un grupo, se comprueba si el alumno ya esta registrado
    //en el grupo. Teniendo como parametro el id del alumno, el id de grupo
    
    //Se comprueba si estas variables llegaron a este archivo mediante AJAX para saber que operacion se debera hacer
		if(isset($_POST['check_id']) && isset($_POST['check_id2'])){
      
      //Se hace la sentencia SQL del alumno que se pretende registrar y conocer si este ya se encuentra registrado
      //en dicho grupo
			$stmt = Conexion::conectar()->prepare("SELECT * FROM alumno_grupo where id_alumno = :id_alumno AND id_grupo = :id_grupo");
			//Parametros donde es le id del alumno y el id del grupo
      $stmt->bindParam(":id_alumno",$_POST['check_id']);
			$stmt->bindParam(":id_grupo",$_POST['check_id2']);
			if($stmt->execute()){
        //Si encontro un alumno en este grupo entonces se regresa un verdadero. Esto quiere decir que ya no puede
        //ser registrado en este grupo
				if ($stmt->fetchColumn() > 0){
					echo 1;
				}
				else
				{
          //Sino se regresa un falso y se procede con el registro del alumno en el grupo
					echo 0;
				}
			}

	 		

		}
    //Operacion SQL que se encargara de insertar el alumno en el grupo siempre y cuando este ya no este
    //registrado en el respectivo grupo
    
    //Se comprueba si estas variables especificas llegaron para hacer la operacion necesario
		else if(isset($_POST['insert_alumno']) && isset($_POST['insert_grupo'])){
      //Se hace el insert del alumno en el grupo
			$stmt = Conexion::conectar()->prepare("INSERT INTO alumno_grupo (id_alumno, id_grupo) VALUES (:id_alumno,:id_grupo)");
			//Parametros para hacer el insert
      $stmt->bindParam(":id_grupo",$_POST['insert_grupo']);
			$stmt->bindParam(":id_alumno",$_POST['insert_alumno']);
			if($stmt->execute()){
			}

		}
    //Sentencia SQL que operara con la ventana de registrar una nueva sesion. Cada que se cambie el alumno del select2
    //correspondiente se hara una consulta a la base de datos para saber que maestros tiene el alumno seleccionado
    //asi estara cambiando cada que se seleccione un alumno diferente y estaran los profesores a los que corresponde.
		else if(isset($_POST['id_alumno2'])){
			$id_alumno = $_POST['id_alumno2'];
      //Sentencia SQL que traera todos los profesores a los que esta asignado un alumno
			$stmt = Conexion::conectar()->prepare("SELECT maestro.nombre_maestro, maestro.id_maestro from maestro inner join grupo on maestro.id_maestro = grupo.id_maestro inner join alumno_grupo on grupo.id_grupo = alumno_grupo.id_grupo where alumno_grupo.id_alumno = :id_alumno");
			//Parametro para hacer la consulta
      $stmt->bindParam(":id_alumno",$id_alumno);
      //Se ejecuta la sentencia
			if($stmt->execute()){
        //Se trae todos los resultados en un array con indices numericos ya que puede un alumno puede estar en varios
        //grupos y por consecuencia tener varios profesores
				$usuario = $stmt->fetchAll(PDO::FETCH_NUM);
				if($usuario){
					//Como se traera una respuesta con multiples valores entonces necesita devolverse un objeto
          //de tipo JSON para regresar una matriz con los diferentes datos de los profesores
					echo json_encode($usuario);
				}
			}
		}
    //Sentencia SQL donde por cada que cambie el alumno en el select2 correspondiente, se hara una consulta
    //a la base de datos para comprobar que imagen se le registro a dicho alumno, una vez esto se traera
    //la url de la imagen para ponerlo en un modal, cada que cambie el alumno del select2 la imagen tambien
    //cambiara mostrando la respectiva imagen del alumno
		else if(isset($_POST['checkImage'])){
			$id_alumno = $_POST['checkImage'];
      //Se hace la consulta de la imagen
			$stmt = Conexion::conectar()->prepare("SELECT img_alumno from alumno where id_alumno = :id_alumno");
			//Se registra el parametro
      $stmt->bindParam(":id_alumno",$id_alumno);
			//Se ejecuta la sentencia
      if($stmt->execute()){
        //Se trae la respuesta de la consulta por medio de un array con indices numericos
				$usuario = $stmt->fetchAll(PDO::FETCH_NUM);
				if($usuario){
					//Como se devolvera un array entonces es necesario devolverlo en objeto tipo JSON
					echo json_encode($usuario);
				}
			}

		}
    //Consulta SQL que se encargara de saber si ya hay algun alumno registrado con la misma matricula
    //que se pretende registrar en un nuevo alumno, si esto llegar a ser asi entonces se impedira
    //el registro del alumno
		else if(isset($_POST['matricula'])){
      //Sentencia SQL
			$stmt = Conexion::conectar()->prepare("SELECT * from alumno where matricula_alumno = :matricula");
			//Se registra el parametro
      $stmt->bindParam(":matricula",$_POST['matricula']);
			if($stmt->execute()){
        //Si esta consulta devuelve una fila entonces quiere decir que ya hay un alumno registrado y devuelve verdadero
				if ($stmt->fetchColumn() > 0){
					echo 1;
				}
				else
				{
					echo 0;
				}
			}
		}
    //Consulta SQL que se ejecuta al momento de registrar un alumno en una nueva sesion. Esta consulta
    //verifica si el alumno que se pretende registrar en una nueva sesion ya esta en una sesion, si es
    //asi entonces no hace el registro de la sesion
		else if(isset($_POST['id_alumno_sesion'])){
      //Sentencia SQL
			$stmt = Conexion::conectar()->prepare("SELECT * from sesion where id_alumno = :id_alumno");
			//Registro de parametro
      $stmt->bindParam(":id_alumno",$_POST['id_alumno_sesion']);
			if($stmt->execute()){
        //Si la consulta regreso alguna fila eso quiere decir que dicho alumno ya esta registrado
        //por lo que no se hace el nuevo registro
				if ($stmt->fetchColumn() > 0){
					echo 1;
				}
				else
				{
					echo 0;
				}
			}
		}
    //Consulta SQL que se ejecuta al momento de registrar una sesion nueva. Cuando se registra una nueva sesion,
    //esta implica escoger una actividad nueva, al hacerlo se comprueba si hay lugares disponibles
    //en esta actividad, por lo que es necesario traer los lugares disponibles de dicha actividad para
    //comprobar si aun hay espacio
		else if(isset($_POST['id_actividad'])){
      //sentencia SQL
			$stmt = Conexion::conectar()->prepare("SELECT lugares from actividad where id_actividad = :id_actividad");
			//Se registra el parametro
      $stmt->bindParam(":id_actividad",$_POST['id_actividad']);
			if($stmt->execute()){
        //Se obtiene la respuesta en un array con indices numericos
				$usuario = $stmt->fetch(PDO::FETCH_NUM);
				if($usuario){
          //Solamente se regresa la respuesta 
					echo $usuario[0];
				}
			}
		}
    //Si todas las validaciones dieron luz verde (lugares de la actividad y que no este registra ya) se procede
    // a hacer el registro de la sesion
		else if(isset($_POST['id_alumno_sesion2']) && isset($_POST['id_maestro_sesion'])){
      
      //Sentencia SQL
			$stmt = Conexion::conectar()->prepare("INSERT INTO sesion (id_alumno, id_actividad, id_maestro, fecha, hora_entrada, unidad) VALUES(:id_alumno, :id_actividad, :id_maestro ,:fecha,:hora_entrada,:unidad)");

      //Registro de PARAMETROS
			$stmt->bindParam(':id_alumno',$_POST["id_alumno_sesion2"]);
			$stmt->bindParam(':id_maestro',$_POST["id_maestro_sesion"]);
			$stmt->bindParam(':id_actividad',$_POST["id_actividad_sesion"]);
			$stmt->bindParam(':fecha',$_POST["fecha_sesion"]);
			$stmt->bindParam(':hora_entrada',$_POST["hora_entrada_sesion"]);
			$stmt->bindParam(':unidad',$_POST["unidad_sesion"]);
			if($stmt->execute()){
			}

      //Al hacer el registro de la sesion entonces es necesario restar un lugar a la actividad para que
      //el control de lugares sea en tiempo real
			$l = $_POST["lugares"]-1;
			print_r($_POST);
			$stmt = Conexion::conectar()->prepare("UPDATE actividad set lugares = :lugares where id_actividad = :id_actividad");
			$stmt->bindParam(':lugares',$l);
			$stmt->bindParam(':id_actividad',$_POST["id_actividad_sesion"]);
			if($stmt->execute()){
			}
		}
	}
?>

