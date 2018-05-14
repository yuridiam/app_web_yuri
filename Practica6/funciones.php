<?php
	//conexion a la base de datos
	require_once("db/conexion_deportes.php");
	
	//consulta para obtener todos los alumnos registrados como deportistas en la bd
	function run_app($deporte){
		global $pdo;
		//selecciona el tipo de deporte que es
		if($deporte == 1){
			$sql = "select * from alumno where id_deporte = 1";
		}else if($deporte == 2){
			$sql = "select * from alumno where id_deporte = 2";
		}
		$stm = $pdo->prepare($sql);
		$stm->execute();
		return $res = $stm->fetchAll();
	}

	//funcion que añade a un deportista a la bd
	function add($deporte, $num_dorso, $nombre, $pos, $carrera, $email){
		global $pdo;
		$sql = "insert into alumno(num_dorso, nombre, posicion, id_carrera, id_deporte, email)
					values('$num_dorso', '$nombre', '$pos', '$carrera', '$deporte', '$email')";
		$stm = $pdo->prepare($sql);
		return $stm->execute();
	}

	function modify($id, $deporte, $num_dorso, $nombre, $pos, $carrera, $email){
		global $pdo;
		$sql = "update alumno set num_dorso = '$num_dorso', nombre='$nombre', posicion='$pos', id_carrera='$carrera', id_deporte='$deporte', email='$email' where id='$id'";
		$stm = $pdo->prepare($sql);
		return $stm->execute();
	}

	//funcion que elimina un registro de la bd
	function delete($id){
		global $pdo;
		$sql = "delete from alumno where id = '$id'";
		$stm = $pdo->prepare($sql);
		return $stm->execute();
	}

	//funcion que busca un determinado deportista en la bd
	function search($id){
		global $pdo;
		$sql = "select * from alumno where id = '$id'";
		$stm = $pdo->prepare($sql);
		$stm->execute();
		return $res = $stm->fetch();
	}

	//funcion que busca si existe un numero de dorso en el mismo deporte en el quw se quiere registrar en la bd
	function dorso_exists($num, $deporte){
		global $pdo;
		$ban =0;
		$sql = "select * from alumno where id_deporte = '$deporte'";
		$stm = $pdo->prepare($sql);
		$stm->execute();
		$res=$stm->fetchAll();
		//compara el num de dorso dado con los que ya existen
		foreach ($res as $fila) {
			if($fila['num_dorso']==$num){
				$ban=1;
				break;
			}
		}
		return $ban;
	}

?>