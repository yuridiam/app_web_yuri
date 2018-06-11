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
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE usuario = '$u' AND pass = '$c' AND eliminado=0");
		//Se ejecuta la consulta
		$stmt->execute();
		//Se retorna la fila si es que existe
		return $stmt->fetch();
		//se cierra la consulta
		$stmt->close();

	}

	//Modelo que agrega una categoria a la base de datos
	public function agregarCategoriaModel($tabla, $datosModel){
		//se almacenan los datos en variables
		$nom = $datosModel["nombre"];
		$desc = $datosModel["desc"];
		$fecha = $datosModel["fecha"];
		$tienda = $datosModel["tienda"];
		//se ejecuta la consulta
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre_categoria,descripcion_categoria,fecha_registro,id_tienda) VALUES('$nom','$desc','$fecha','$tienda')");
		//se retorna el resultado de la consulta
		return $stmt->execute();
		//se cierra la consulta
		$stmt->close();

	}
	//Modelo que agrega un usuario a la base de datos
	public function agregarUsuarioModel($tabla, $datosModel){
		//se almacenan los datos en variables
		$nom = $datosModel["nombre"];
		$usuario = $datosModel["usuario"];
		$contra = $datosModel["contra"];
		$fecha = $datosModel["fecha"];
		$tienda = $datosModel["tienda"];
		$tipo = $datosModel["tipo"];
		//se ejecuta la consulta
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre,usuario,pass,fecha_registro,id_tienda,tipo) VALUES('$nom','$usuario','$contra','$fecha','$tienda','$tipo')");
		//se retorna el resultado de la consulta
		return $stmt->execute();
		//se cierra la consulta
		$stmt->close();

	}

	//Modelo que consulta los datos de diferentes tablas que utiliza el controler
	public function consultarModel($tabla){

		if($tabla != "historial"){
			//se prepara la consulta
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE eliminado=0");
			if($tabla == "tienda"){
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE desactivado=0");
			}else{
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE eliminado=0");
			}
		}else{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE eliminado=0 ORDER BY id_historial DESC LIMIT 10");
		}
		//se ejecuta la consulta
		$stmt->execute();
		//se retornan todas las filas devueltas
		return $stmt->fetchAll();
		//se cierra la consulta
		$stmt->close();

	}

	//Modelo que busca todas las tiendas en la base de datos
	public function todasTiendasModel(){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM tienda");
		//se ejecuta la consulta
		$stmt->execute();
		//se retornan todas las filas devueltas
		return $stmt->fetchAll();
		//se cierra la consulta
		$stmt->close();

	}

	//Modelo que cuenta los registros de diferentes tablas
	public function totalesModel($tabla){
		//se prepara la consulta
		if($tabla!="historial"){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE eliminado=0");
		}else{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
		}
		//se ejecuta la consulta
		$stmt->execute();
		//se retornan todas las filas devueltas
		return $stmt->rowCount();
		//se cierra la consulta
		$stmt->close();

	}

	//Modelo que agrega un producto a la base de datos
	public function agregarProductoModel($tabla, $datosModel){
		//se almacenan los datos en variables
		$id = $datosModel["tienda"];
		$cod = $datosModel["codigo"];
		$nom = $datosModel["nombre"];
		$precio = $datosModel["precio"];
		$stock = $datosModel["stock"];
		$cat = $datosModel["cat"];
		$fecha = $datosModel["fecha"];
		//se ejecuta la consulta
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (codigo_producto,nombre_producto,precio_producto,stock,id_categoria,fecha_registro,id_tienda) VALUES('$cod','$nom','$precio','$stock','$cat','$fecha','$id')");
		//se retorna el resultado de la consulta
		return $stmt->execute();
		//se cierra la consulta
		$stmt->close();

	}

	//Modelo que busca una categoria en la base de datos
	public function buscarCategoriaModel($id){
		//se prepara la consulta
		$stmt = Conexion::conectar()->prepare("SELECT * FROM categorias WHERE id_categoria=$id");
		//se ejecuta la consulta
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();		
	}

	//Modelo que busca un usuario en la base de datos
	public function buscarUsuarioModel($usuario, $contra){
		//Se prepara la consulta
		$stmt = Conexion::conectar()->prepare("SELECT * FROM usuarios WHERE id_usuario='$usuario' AND pass='$contra'");
		//se ejecuta la consulta
		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}
		$stmt->close();
	}

	//Modelo que elimina un producto de la base de datos
	public function eliminarProductoModel($produ){
		//Se prepara la consulta
		$stmt = Conexion::conectar()->prepare("UPDATE productos SET eliminado=1 WHERE id_producto='$produ'");
		//se ejecuta la consulta
		return $stmt->execute();
		$stmt->close();
	}

	//Modelo que busca una producto en la base de datos
	public function buscarProductoModel($id){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM productos WHERE id_producto='$id'");
		//se ejecuta la consulta
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}

	//Modelo que modifica un producto de la base de datos
	public function modificarProductoModel($tabla, $datosModel,$id){
		//Se almacenan las variables
		$cod = $datosModel["codigo"];
		$nom = $datosModel["nombre"];
		$precio = $datosModel["precio"];
		$stock = $datosModel["stock"];
		$cat = $datosModel["cat"];
		//Se prepara la consulta
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET codigo_producto = '$cod', nombre_producto='$nom', precio_producto='$precio', stock='$stock', id_categoria='$cat' WHERE id_producto='$id'");
		//se ejecuta la consulta
		return $stmt->execute();
		//Se cierra la consulta
		$stmt->close();
	}

	//Modelo que busca un producto por historial
	public function buscarProHistorialModel($idprodu){
		//Se prepara la consulta
		$stmt = Conexion::conectar()->prepare("SELECT * FROM historial WHERE id_producto='$idprodu'");
		//se ejecuta la consulta
		$stmt->execute();
		//Se devuelven todos registros encontrados
		return $stmt->fetchAll();
		//Se cierra la consulta
		$stmt->close();
	}

	//Modelo que busca un usuario en la base de datos
	public function buscarU($id){
		//Se prepara la consulta
		$stmt = Conexion::conectar()->prepare("SELECT * FROM usuarios WHERE id_usuario='$id'");
		//se ejecuta la consulta
		$stmt->execute();
		//Se devuelve el registro encontrado
		return $stmt->fetch();
		//Se cierra la consulta
		$stmt->close();
	}

	//Modelo que agrega o quita stock 
	public function agregarOquitarStockModel($datosModel){
		//Se almacenan las variables
		$producto = $datosModel["id_producto"];
		$usuario = $datosModel["id_usuario"];
		$fecha = $datosModel["fecha"];
		$hora = $datosModel["hora"];
		$nota = $datosModel["nota"];
		$ref = $datosModel["ref"];
		$cant = $datosModel["cantidad"];
		$mov = $datosModel["mov"];
		$tienda = $datosModel["tienda"];
		//Se prepara la consulta
		$stmt = Conexion::conectar()->prepare("INSERT INTO historial (id_producto,id_usuario,fecha,hora,nota,referencia,cantidad,movimiento,id_tienda) VALUES('$producto','$usuario','$fecha','$hora','$nota','$ref','$cant','$mov','$tienda')");
		//se ejecuta la consulta
		return $stmt->execute();
		//Se cierra la consulta
		$stmt->close();
	}

	//Modelo que suma o resta al stock actual de un producto en la base de datos
	public function sumarYrestarStockModel($cantidad, $id, $op){
		//Se prepara la consulta
		$stmt = Conexion::conectar()->prepare("SELECT * FROM productos WHERE id_producto='$id'");
		$stmt->execute();
		$p = $stmt->fetch();
		$stock_nuevo=0;
		$resp="";
		$b=0;

		if($p){
			if($op==1){
				$stock_nuevo = $cantidad + $p["stock"];
			}else{
				$stock_nuevo = $p["stock"] - $cantidad;
			}
		}

		if($stock_nuevo < 0){
			return "error";
		}else{
			//Se prepara la consulta
			$stmt2 = Conexion::conectar()->prepare("UPDATE productos SET stock='$stock_nuevo' WHERE id_producto='$id'");
			//se ejecuta la consulta
			$stmt2->execute();
			return "listo";
			$stmt2->close();
		}	
		$stmt->close();
	}

	//Modelo que modifica una categoria de la base de datos
	public function modificarCategoriaModel($tabla, $datosModel){
		//Se almacenan las variables
		$id = $datosModel["id"];
		$nombre = $datosModel["nombre"];
		$desc = $datosModel["desc"];
		//Se prepara la consulta
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre_categoria='$nombre', descripcion_categoria='$desc' WHERE id_categoria='$id'");
		//se ejecuta la consulta
		return $stmt->execute();
		//Se cierra la consulta
		$stmt->close();
	}

	//Modelo que elimina una categoria de la base de datos logicamente
	public function eliminarCategoriaModel($categoria){
		//Se prepara la consulta
		$stmt = Conexion::conectar()->prepare("UPDATE categorias SET eliminado=1 WHERE id_categoria='$categoria'");
		//se ejecuta la consulta
		$r = $stmt->execute();
		if($r){
			$stmt4 = Conexion::conectar()->prepare("UPDATE productos SET eliminado=1 WHERE id_categoria='$categoria'");
			return $stmt4->execute();
			//Se cierra la consulta
			$stmt4->close();
		}
		$stmt->close();
	}

	//Modelo que modifica un usuario de la base de datos
	public function modificarUsuarioModel($tabla, $datosModel){
		//Se almacenan las variables
		$id = $datosModel["id"];
		$nombre = $datosModel["nombre"];
		$usuario = $datosModel["usuario"];
		$contra = $datosModel["contra"];
		$tienda = $datosModel["tienda"];
		//Se prepara la consulta
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre='$nombre', usuario='$usuario', pass='$contra', id_tienda='$tienda' WHERE id_usuario='$id'");
		//se ejecuta la consulta
		return $stmt->execute();
		//Se cierra la consulta
		$stmt->close();
	}

	//Modelo que elimina un usuario de la base de datos
	public function eliminarUsuarioModel($usuario){

		$prev = Conexion::conectar()->prepare("SELECT * FROM usuarios WHERE id_usuario='$usuario'");
		$prev->execute();
		$u = $prev->fetch();
		$id_t = $u["id_tienda"];
		$prev2 = Conexion::conectar()->prepare("SELECT * FROM tienda WHERE id_tienda='$id_t'");
		$prev2->execute();
		$ti = $prev2->fetch();

		if($ti["nombre"]!="default"){
			//Se prepara la consulta
			$stmt = Conexion::conectar()->prepare("UPDATE usuarios SET eliminado=1 WHERE id_usuario='$usuario'");
			//se ejecuta la consulta
			return $stmt->execute();
			//Se cierra la consulta
			$stmt->close();
		}
	}

	public function buscarTiendaModel($id){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM tienda WHERE id_tienda='$id'");
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}

	//Modelo que agrega un usuario a la base de datos
	public function agregarTiendaModel($tabla, $datosModel){
		//se almacenan los datos en variables
		$nom = $datosModel["nombre"];
		$dir = $datosModel["direccion"];
		//se ejecuta la consulta
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre,direccion) VALUES('$nom','$dir')");
		//se retorna el resultado de la consulta
		return $stmt->execute();
		//se cierra la consulta
		$stmt->close();

	}

	//Modelo que modifica un usuario de la base de datos
	public function modificarTiendaModel($tabla, $datosModel){
		//Se almacenan las variables
		$id = $datosModel["id"];
		$nombre = $datosModel["nombre"];
		$dir = $datosModel["direccion"];
		//Se prepara la consulta
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre='$nombre', direccion='$dir' WHERE id_tienda='$id'");
		//se ejecuta la consulta
		return $stmt->execute();
		//Se cierra la consulta
		$stmt->close();
	}

	public function opTiendaModel($id){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM tienda WHERE id_tienda='$id'");
		$stmt->execute();
		$tienda = $stmt->fetch();

		if($tienda["desactivado"]==1){
			$stmt2 = Conexion::conectar()->prepare("UPDATE tienda SET desactivado=0 WHERE id_tienda='$id'");
			return $stmt2->execute();
			$stmt2->close();
			$stmt->close();
		}else{
			$stmt2 = Conexion::conectar()->prepare("UPDATE tienda SET desactivado=1 WHERE id_tienda='$id'");
			return $stmt2->execute();
			$stmt2->close();
			$stmt->close();
		}
	}

	//Modelo que cuenta los registros de diferentes tablas
	public function totalesTiendaModel($tabla, $id){
		//se prepara la consulta
		if($tabla!="historial"){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE eliminado=0 AND id_tienda = '$id'");
		}else{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_tienda = '$id'");
		}
		//se ejecuta la consulta
		$stmt->execute();
		//se retornan todas las filas devueltas
		return $stmt->rowCount();
		//se cierra la consulta
		$stmt->close();

	}

	//Modelo que consulta los datos de diferentes tablas que utiliza el controler
	public function consultarTiendaModel($tabla, $id){

		if($tabla != "historial"){
			//se prepara la consulta
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE eliminado=0 AND id_tienda='$id'");
		}else{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE eliminado=0 AND id_tienda='$id' ORDER BY id_historial DESC LIMIT 10");
		}
		//se ejecuta la consulta
		$stmt->execute();
		//se retornan todas las filas devueltas
		return $stmt->fetchAll();
		//se cierra la consulta
		$stmt->close();

	}

	//Modelo que consulta los datos de una tabla
	public function consultarVentasModel($idventa){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM venta WHERE id_venta='$idventa'");
		//se ejecuta la consulta
		$stmt->execute();
		//se retornan todas las filas devueltas
		return $stmt->fetchAll();
		//se cierra la consulta
		$stmt->close();

	}

	//Modelo que consulta los datos de una tabla
	public function productosTiendaModel($idtienda){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM productos WHERE id_tienda='$idtienda' AND eliminado=0");
		//se ejecuta la consulta
		$stmt->execute();
		//se retornan todas las filas devueltas
		return $stmt->fetchAll();
		//se cierra la consulta
		$stmt->close();

	}
	//Modelo que inserta los datos de una tabla
	public function crearVentaModel($tienda,$usuario,$fecha_actual,$t){
		$stmt = Conexion::conectar()->prepare("INSERT INTO venta (id_tienda,id_usuario,fecha,total) VALUES('$tienda','$usuario','$fecha_actual','$t')");
		//se retorna el resultado de la consulta
		$stmt->execute();
		$stmt2 = Conexion::conectar()->prepare("SELECT * FROM venta ORDER BY id_venta DESC LIMIT 1");
		//se ejecuta la consulta
		$stmt2->execute();
		return $stmt2->fetch();
		//se cierra la consulta
		$stmt->close();
		$stmt2->close();
	}

	//Modelo que inserta los datos de una tabla
	public function agregarPVentaModel($idventa,$idprodu,$uni,$total){
		$stmt = Conexion::conectar()->prepare("INSERT INTO venta_productos (id_venta,id_producto,unidades,total) VALUES('$idventa','$idprodu','$uni','$total')");
		print_r($stmt);
		return $stmt->execute();
		$stmt->close();

	}

	//Modelo que actualiza los datos de una tabla
	public function cambiarTotalModel($idventa,$total){
		$stmt = Conexion::conectar()->prepare("UPDATE venta SET total='$total' WHERE id_venta='$idventa'");
		return $stmt->execute();
		$stmt->close();
	}

	//Modelo que consulta los datos de una tabla
	public function buscarVenta($id){
		$stmt2 = Conexion::conectar()->prepare("SELECT * FROM venta WHERE id_venta='$id'");
		//se ejecuta la consulta
		$stmt2->execute();
		return $stmt2->fetch();

	}

	//Modelo que busca los datos de una tabla
	public function buscarProductos($idventa){
		$stmt2 = Conexion::conectar()->prepare("SELECT * FROM venta_productos WHERE id_venta='$idventa'");
		//se ejecuta la consulta
		$stmt2->execute();
		return $stmt2->fetchAll();

	}

	//Modelo que consulta los datos de una tabla
	public function consultarCategoriaModel($id){
		$stmt2 = Conexion::conectar()->prepare("SELECT * FROM categorias WHERE id_tienda='$id' AND eliminado=0");
		//se ejecuta la consulta
		$stmt2->execute();
		return $stmt2->fetchAll();

	}


	
}

?>
