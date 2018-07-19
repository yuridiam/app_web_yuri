<?php
	require_once("conexion.php");

	if(isset($_POST)){
		if(isset($_POST['check_id']) && isset($_POST['check_id2'])){
			$id = $_POST['check_id'];
			$stmt = Conexion::conectar()->prepare("SELECT * FROM alumno_grupo where id_alumno = :id_alumno AND id_grupo = :id_grupo");
			$stmt->bindParam(":id_alumno",$_POST['check_id']);
			$stmt->bindParam(":id_grupo",$_POST['check_id2']);
			if($stmt->execute()){
				if ($stmt->fetchColumn() > 0){
					echo 1;
				}
				else
				{
					echo 0;
				}
			}

	 		

		}
		else if(isset($_POST['insert_alumno']) && isset($_POST['insert_grupo'])){
			$stmt = Conexion::conectar()->prepare("INSERT INTO alumno_grupo (id_alumno, id_grupo) VALUES (:id_alumno,:id_grupo)");
			$stmt->bindParam(":id_grupo",$_POST['insert_grupo']);
			$stmt->bindParam(":id_alumno",$_POST['insert_alumno']);
			if($stmt->execute()){
				//echo true;
			}

		}
		else if(isset($_POST['id_alumno2'])){
			$id_alumno = $_POST['id_alumno2'];
			$stmt = Conexion::conectar()->prepare("SELECT maestro.nombre_maestro, maestro.id_maestro from maestro inner join grupo on maestro.id_maestro = grupo.id_maestro inner join alumno_grupo on grupo.id_grupo = alumno_grupo.id_grupo where alumno_grupo.id_alumno = :id_alumno");
			$stmt->bindParam(":id_alumno",$id_alumno);
			//echo "SELECT maestro.nombre_maestro, maestro.id_maestro from maestro inner join grupo on maestro.id_maestro = grupo.id_maestro inner join alumno_grupo on grupo.id_grupo = alumno_grupo.id_grupo where alumno_grupo.id_alumno = $id_alumno";
			if($stmt->execute()){
				$usuario = $stmt->fetchAll(PDO::FETCH_NUM);
				if($usuario){
					//print_r($usuario);
					echo json_encode($usuario);
				}
			}
		}
		else if(isset($_POST['checkImage'])){
			$id_alumno = $_POST['checkImage'];
			$stmt = Conexion::conectar()->prepare("SELECT img_alumno from alumno where id_alumno = :id_alumno");
			$stmt->bindParam(":id_alumno",$id_alumno);
			if($stmt->execute()){
				$usuario = $stmt->fetchAll(PDO::FETCH_NUM);
				if($usuario){
					//print_r($usuario);
					echo json_encode($usuario);
				}
			}

		}
		else if(isset($_POST['matricula'])){
			$stmt = Conexion::conectar()->prepare("SELECT * from alumno where matricula_alumno = :matricula");
			$stmt->bindParam(":matricula",$_POST['matricula']);
			if($stmt->execute()){
				if ($stmt->fetchColumn() > 0){
					echo 1;
				}
				else
				{
					echo 0;
				}
			}
		}
		else if(isset($_POST['id_alumno_sesion'])){
			$stmt = Conexion::conectar()->prepare("SELECT * from sesion where id_alumno = :id_alumno");
			$stmt->bindParam(":id_alumno",$_POST['id_alumno_sesion']);
			if($stmt->execute()){
				if ($stmt->fetchColumn() > 0){
					echo 1;
				}
				else
				{
					echo 0;
				}
			}
		}
		else if(isset($_POST['id_actividad'])){
			$stmt = Conexion::conectar()->prepare("SELECT lugares from actividad where id_actividad = :id_actividad");
			$stmt->bindParam(":id_actividad",$_POST['id_actividad']);
			if($stmt->execute()){
				$usuario = $stmt->fetch(PDO::FETCH_NUM);
				if($usuario){
					echo $usuario[0];
				}
			}
		}
		else if(isset($_POST['id_alumno_sesion2']) && isset($_POST['id_maestro_sesion'])){

			print_r($_POST);
			$stmt = Conexion::conectar()->prepare("INSERT INTO sesion (id_alumno, id_actividad, id_maestro, fecha, hora_entrada, unidad) VALUES(:id_alumno, :id_actividad, :id_maestro ,:fecha,:hora_entrada,:unidad)");

			$stmt->bindParam(':id_alumno',$_POST["id_alumno_sesion2"]);
			$stmt->bindParam(':id_maestro',$_POST["id_maestro_sesion"]);
			$stmt->bindParam(':id_actividad',$_POST["id_actividad_sesion"]);
			$stmt->bindParam(':fecha',$_POST["fecha_sesion"]);
			$stmt->bindParam(':hora_entrada',$_POST["hora_entrada_sesion"]);
			$stmt->bindParam(':unidad',$_POST["unidad_sesion"]);
			if($stmt->execute()){
			}

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

