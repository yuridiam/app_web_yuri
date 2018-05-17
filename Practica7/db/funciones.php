<?php 
	require_once("conexion_ventas.php");

	function run_app($tipo){
		global $pdo;
		if($tipo == 1){
			$sql = "select * from usuarios";
		}else if($tipo == 2){
			$sql = "select * from productos where eliminado=0";
		}elseif ($tipo == 3) {
			$sql = "select * from venta";
		}
		$stm = $pdo->prepare($sql);
		$stm->execute();
		return $res = $stm->fetchAll();
	}

	function encriptar($pass){
		return md5($pass);
	}

	function agregar_usuario($nombre, $usuario, $pass){
		global $pdo;
		$newpass=encriptar($pass);
		$sql = "insert into usuarios(nombre,usuario,pass) values('$nombre','$usuario','$newpass')";
		$stm = $pdo->prepare($sql);
		return $stm->execute();
	}

	function modificar_usuario($id, $nombre, $usuario){
		global $pdo;
		$sql = "update usuarios set nombre='$nombre', usuario='$usuario' where id='$id'";
		$stm = $pdo->prepare($sql);
		return $stm->execute();
	}

	function agregar_producto($nombre, $precio){
		global $pdo;
		$sql = "insert into productos(nombre,preciounitario) values('$nombre','$precio')";
		$stm = $pdo->prepare($sql);
		return $stm->execute();
	}

	function modificar_producto($id, $nombre, $precio){
		global $pdo;
		$sql = "update productos set nombre='$nombre', preciounitario='$precio' where id='$id'";
		$stm = $pdo->prepare($sql);
		return $stm->execute();
	}


	function eliminar($tipo,$id){
		global $pdo;
		if($tipo==1){
			$sql = "delete from usuarios where id = '$id'";
		}else if ($tipo==2) {
			$sql = "update productos set eliminado=1 where id = '$id'";
		}
		$stm = $pdo->prepare($sql);
		return $stm->execute();
	}

	function buscar($tipo, $id){
		global $pdo;
		if($tipo==1){
			$sql = "select * from usuarios where id = '$id'";
		}else if ($tipo==2) {
			$sql = "select * from productos where id = '$id'";
		}else if($tipo==3){
			$sql = "select * from venta_detalles where idventa = '$id'";
		}
		$stm = $pdo->prepare($sql);
		$stm->execute();
		return $res = $stm->fetch();
	}

	function registrar_venta($total, $fecha){
		global $pdo;
		$sql="insert into venta(total,fecha) values('$total','$fecha')";
		$stm = $pdo->prepare($sql);
		return $stm->execute();
	}

	function registrar_detalle($idventa, $idproducto, $cantidad, $total, $promedio){
		global $pdo;
		$sql="insert into venta_detalles(idventa,idproducto,cantidad,total,promedio) values('$idventa','$idproducto','$cantidad','$total','$promedio')";
		$stm = $pdo->prepare($sql);
		return $stm->execute();
	}

	function buscar_detalle($idventa){
		global $pdo;
		$sql = "select * from venta_detalles where idventa = '$idventa'";
		$stm = $pdo->prepare($sql);
		$stm->execute();
		return $res = $stm->fetchAll();
	}

	function buscar_fecha($fecha){
		global $pdo;
		$sql = "select * from venta where fecha = '$fecha'";
		$stm = $pdo->prepare($sql);
		$stm->execute();
		return $res = $stm->fetchAll();
	}

	function buscar_usuario($usuario){
		global $pdo;
		$sql = "select * from usuarios where usuario = '$usuario'";
		$stm = $pdo->prepare($sql);
		$stm->execute();
		return $res = $stm->fetchAll();
	}

	function buscar_contra($pass){
		global $pdo;
		$b=0;
		$pass2 = encriptar($pass);
		$sql = "select * from usuarios where pass = '$pass2'";
		$stm = $pdo->prepare($sql);
		$stm->execute();
		$res = $stm->fetchAll();
		foreach ($res as $fila) {
			if($pass2 == $fila["pass"]){
				$b=1;
			}else{
				$b=0;
			}
		}
		return $b;
	}

?>