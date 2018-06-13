<?php
//Clase general que controla la comunicación entre la vista y el modelo
Class MvcController{

	//funcion que carga el template en primera instancia
	public function pagina(){	
		include "views/template.php";
	}

	//funcion que obtiene la action de la pagina para poder dirigirse a la pagina adecuada con la ayuda
	//del model en el crud de enlaces
	public function enlacesPaginasController(){
		//comprueba que el action este en la url de la pagina
		if(isset( $_GET['action'])){
			//almacena el action en una variable
			$enlaces = $_GET['action'];
		
		}else{
			//si no hay action se ingresa index
			$enlaces = "index";
		}
		//se manda a llamar el modelo de enlaces para obtener la url completa a la que se va a dirigir
		$respuesta = Paginas::enlacesPaginasModel($enlaces);
		//carga la url
		include $respuesta;
	}

	#IDENTIFICACION DE USUARIOS

	//Funcion controlador que autentica a un usuario
	public function ingresoUsuarioController(){
		//se comprueba que el boton se haya presionado
		if(isset($_POST["ingresar"])){
			//Se almacena el usuario y la contrasena ingresada por el usuario en un array
			$datosController = array ("usuario" => $_POST["usuario"],
										"contra" => $_POST["contra"]);
			//Se manda a llamar el modelo que identifica si los datos que ingreso el usuario estan almacenados en la base de datos
			$respuesta = Datos::ingresoUsuarioModel($datosController, "usuarios");
			//Si los datos son encontrados en el modelo se inicia la sesion
			if($respuesta){
				//se inicia la sesion
				session_start();
				//Se crean las variables de sesion necesarias
				$_SESSION["validar"] = true;
				$_SESSION["usuario"] = $respuesta["nombre"];
				$_SESSION["id"] = $respuesta["id_usuario"];
				$_SESSION["tienda"] = $respuesta["id_tienda"];
				$_SESSION["contra"]=$respuesta["pass"];

				if($_SESSION["tienda"]!=1){
					$nom_ti = Datos::buscarTiendaModel($_SESSION["tienda"]);
					if($nom_ti){
						if($nom_ti["desactivado"]==0){
							$_SESSION["nom_tienda"]=$nom_ti["nombre"];
							header("location:index.php?action=dashboardtienda&id_tienda=" . $_SESSION["tienda"]);
						}else{
							header("location:index.php?action=nodisponible");
						}
					}
				}else{
					$_SESSION["nom_tienda"]="Superadmin";
					//Se dirige al dashboard
					header("location:index.php?action=dashboard");
				}

			}else{
				//Si los datos no son correctos se dirige al login de nuevo
				header("location:index.php?action=error");
				//header("location:index.php?action=fallo");
			}

		}
	}

	//Funcion que registra una categoria
	public function registrarCategoriaController(){
		//Se comprueba que el boton se haya seleccionado
		if(isset($_POST["agregar"])){
			//Se obtiene la fecha actual del servidor
			$fecha_actual = date('Y-m-d'); 
			$id_tienda = $_GET["id_tienda"];
			//Se almacenan los datos ingresados en un array
			$datosController = array( "tienda" => $id_tienda,
									"nombre"=>$_POST["nombre"], 
								      "desc"=>$_POST["desc"],
								  	"fecha"=>$fecha_actual);
			
			//Se manda a llamar el modelo que registra una categoria en la base de datos
			$respuesta=Datos::agregarCategoriaModel("categorias",$datosController);
			//Si la insercion se lleva a cabo se imprime una alerta de exito
			if($respuesta){
				echo"<script language='javascript'>window.location='index.php?action=categorias&id_tienda=".$id_tienda."';</script>";
			}
		}
	}

	//Funcion que registra un usuario
	public function registrarUsuarioController(){
		//Se comprueba que el boton se haya seleccionado
		if(isset($_POST["agregar"])){
			//Se obtiene la fecha actual del servidor
			$fecha_actual = date('Y-m-d'); 
			//Se almacenan los datos ingresados en un array
			$datosController = array( "nombre"=>$_POST["nombre"], 
								      "usuario"=>$_POST["usuario"],
								      "contra"=>$_POST["contra"],
								  	"fecha"=>$fecha_actual);
			//Se manda a llamar el modelo que registra al usuario en la base de datos
			$respuesta=Datos::agregarUsuarioModel("usuarios",$datosController);
			//Si la insercion se lleva a cabo se imprime una alerta de exito
			if($respuesta){
				echo "<script type='text/javascript'>
    					alert('Usuario registrado');
  				  </script>";
			}else{
				//Si no se registra el usuario tambien muestra un alerta de error
				echo "<script type='text/javascript'>
    					alert('Ocurrió un problema');
  				  </script>";
			}
		}
	}

	//Funcion que obtiene todas las categorias registradas en la base de datos que se cataloguen como existentes logicamente
	public function traerCategoriasController(){
		//Se ejecuta el modelo que consulta las categorias existentes
		$respuesta = Datos::consultarTiendaModel("categorias",$_GET["id_tienda"]);
		//Se comprueba que la consulta se haya llevado a cabo y se imprimen en el select2
		if($respuesta){
			foreach ($respuesta as $fila) {
				echo '<option value="'.$fila["id_categoria"].'">'.$fila["nombre_categoria"].'</option>';
			}
		}
	}

	//Funcion que registra un producto
	public function registrarProductoController(){
		//Se comprueba que el boton se haya seleccionado
		if(isset($_POST["agregar"])){
			$idtienda = $_GET["id_tienda"];
			//Se comprueba que el dato de precio ingresado realmente sea un numero
			if(is_numeric($_POST["precio"])){
				//Se almacena la fecha actual del servidor
				$fecha_actual = date('Y-m-d'); 
				//Se almacenan los datos ingresados en un array
				$datosController = array( "tienda" => $idtienda,
										  "codigo"=>$_POST["codigo"], 
									      "nombre"=>$_POST["nombre"],
									      "precio"=>$_POST["precio"],
									      "stock"=>$_POST["stock"],
									      "cat"=>$_POST["categoria"],
									  	"fecha"=>$fecha_actual);
				//Se manda a llamar el modelo que registra el producto en la base de datos
				$respuesta=Datos::agregarProductoModel("productos",$datosController);
				//Si la insercion se lleva a cabo se imprime una alerta de exito
				if($respuesta){
					echo"<script language='javascript'>window.location='index.php?action=inventario&id_tienda=".$idtienda."';</script>";
				}
			}else{
				//Si el precio ingresado no es un numero se imprime una alerta
				echo "<script type='text/javascript'>
	    					alert('Ingrese un precio numerico');
	  				  </script>";
			}
			
		}
	}

	//Funcion que cuenta todos los productos registrados catalogados logicamente como existentes (es decir, con el campo eliminado como 0)
	public function contarProductosController(){
		//Se ejecuta el modelo que consulta los registros de una tabla
		$respuesta = Datos::totalesModel("productos");
		//Se comprueba que la consulta se haya llevado a cabo y se imprimen los resultados
		if($respuesta){
			echo $respuesta;
		}else{
		//Si no se encontraron registros se imprime un 0
			echo "0";
		}
	}

	//Funcion que cuenta todos los usuarios registrados catalogados logicamente como existentes (es decir, con el campo eliminado como 0)
	public function contarUsuariosController(){
		//Se ejecuta el modelo que consulta los usuarios existentes
		$respuesta = Datos::totalesModel("usuarios");
		//Se comprueba que la consulta se haya llevado a cabo y se imprimen los resultados
		if($respuesta){
			echo $respuesta;
		}else{
			echo "0";
		}
	}

	//Funcion que cuenta todos las categorias registrados catalogados logicamente como existentes (es decir, con el campo eliminado como 0)
	public function contarCategoriasController(){
		//se ejecuta el modelo que consulta las categorias existentes
		$respuesta = Datos::totalesModel("categorias");
		//se comprueba que la consulta se haya llevado a cabo y se imprimen los resultados
		if($respuesta){
			echo $respuesta;
		}else{
			//Si no se encontraron registros se imprime un 0
			echo "0";
		}
	}

	//Funcion que cuenta todos los movimientos registrados catalogados logicamente como existentes (es decir, con el campo eliminado como 0)
	public function contarMovimientosController(){
		//se ejecuta el modelo que consulta los movimientos existentes
		$respuesta = Datos::totalesModel("historial");
		//se comprueba que la consulta se haya llevado a cabo y se imprimen los resultados
		if($respuesta){
			echo $respuesta;
		}else{
			//Si no se encontraron registros se imprime un 0
			echo "0";
		}
	}

	//Funcion que muestra todos los productos registrados
	public function vistaInventarioController(){
		//Se manda a llamar el modelo que consulta todos los productos registrados y existentes logicamente
		$respuesta = Datos::consultarTiendaModel("productos",$_GET["id_tienda"]);
		//Si la consulta en el modelo se ejecuta exitosamente se recorre el array devuelto para imprimirlos
		if($respuesta){
			//Ciclo que recorre el array devuelto
			foreach ($respuesta as $fila) {
				//Se llama al modelo que busca la categoria registrada para obtener su nombre
				$categoria = Datos::buscarCategoriaModel($fila["id_categoria"]);
				//Se imprimen las filas de las tablas
				echo'<tr>
				<td>'.$fila["codigo_producto"].'</td>
				<td>'.$fila["nombre_producto"].'</td>
				<td>'.$fila["precio_producto"].'</td>
				<td>'.$fila["stock"].'</td>
				<td>'.$categoria["nombre_categoria"].'</td>
				<td>'.$fila["fecha_registro"].'</td>
				<td><a href="index.php?action=editarproducto&id='.$fila["id_producto"].'&id_tienda='.$_GET["id_tienda"].'" class="btn btn-info"><i class="fa fa-edit"></i> Editar</a></td>
				<td><a href="index.php?action=eliminarproducto&idBorrar='.$fila["id_producto"].'&id_tienda='.$_GET["id_tienda"].'" class="btn btn-danger"><i class="fa fa-times"></i> Eliminar</a></td>
				<td><a href="index.php?action=stock&id='.$fila["id_producto"].'&id_tienda='.$_GET["id_tienda"].'" class="btn btn-warning"><i class="fa fa-refresh"></i> Actualizar Stock</a></td>
				</tr>';
			}
		}
			
	}

	//Funcion que elimina un producto logicamente de la base de datos
	public function eliminarProductoController(){
		//Se comprueba que las variables id y contra esten en la url para validar el usuario 
		if(isset($_GET["id"]) && isset($_GET["contra"])){
			//Se almacenan las variables individualmente
			$tienda = $_GET["id_tienda"];
			$usuario = $_SESSION["id"];
			$contra = $_GET["contra"];
			$produ = $_GET["id"];
			//Si lo que retorna la consulta es un success se elimina el producto
			if($contra == $_SESSION["contra"]){
				//Se manda a llamar el modelo que elimina el producto logicamente de la base de datos
				$respuesta2 = Datos::eliminarProductoModel($produ);
				//Si se elimina el producto se dirige a la vista de inventario para ver los cambios
				if($respuesta2){
					echo"<script language='javascript'>window.location='index.php?action=inventario&id_tienda=".$tienda."';</script>";
				}
			}else{
				//Si no se devuelve success se imprime una alerta de error
				echo "<script type='text/javascript'>
    					alert('Contraseña incorrecta');
  				  </script>";
			}
		}
	}

	//Funcion que edita un producto
	public function editarProductoController(){
		//Se comprueba que la variable id este activa en el url
		if(isset($_GET["id"])){
			//Se almacena la variable id
			$id = $_GET["id"];
			//Se manda a llamar el modelo que busca el producto en la base de datos
			$respuesta = Datos::buscarProductoModel($id);
			//Se manda a llamar el modelo que trae todas las categorias existentes
			$categoria = Datos::consultarModel("categorias");
			//Si la consulta se lleva a cabo se imprimen todos los campos con el array devuelto
			if($respuesta){
				echo "<div class='input-group'>
                  		<div class='input-group-prepend'>
                    		<span class='input-group-text'><i class='fa fa-barcode'></i></span>
                    	</div>
            			<input type='text' class='form-control' name='codigo' id='codigo' placeholder='Codigo del producto' style='width: 30%' value='".$respuesta["codigo_producto"]."'>
            		</div><br>";
            	echo "<input type='text' class='form-control' name='nombre' id='nombre' placeholder='Nombre del producto' value='". $respuesta["nombre_producto"] ."'>";
            	echo "<div class='input-group'>
                  		<div class='input-group-prepend'>
                    		<span class='input-group-text'><i class='fa fa-usd'></i></span>
                  		</div>
                  			<input type='text' class='form-control' name='precio' id='precio' placeholder='Precio del producto' value='". $respuesta["precio_producto"] ."'>
                	</div><br>";
                echo "<div class='input-group'>
                  		<div class='input-group-prepend'>
                    		<span class='input-group-text'><i class='fa fa-cube'></i></span>
                  		</div>
                  			<input type='number' class='form-control' name='stock' id='stock' placeholder='Stock inicial' value='".$respuesta["stock"]."'>
                	</div><br>";

                echo "<select class='form-control select2' style='width: 100%' name='categoria'>";
                		foreach ($categoria as $fila) {
        				  	if($fila["id_categoria"]==$respuesta["id_categoria"]){
        				  		echo '<option value="'.$fila["id_categoria"].'" selected>'.$fila["nombre_categoria"].'</option>';
        				  	}else{
        				  		echo '<option value="'.$fila["id_categoria"].'">'.$fila["nombre_categoria"].'</option>';;
        				  	}
                		}		  
                echo "</select><br><br>";
               	echo "<input type='hidden' class='form-control' id='c_contra' value='". $_SESSION["contra"] ."'>";
                echo "<button type='submit' class='btn btn-block btn-outline-primary' id='agregar' name='agregar' onclick='modiProd();'>Modificar</button>";
			}
		}

	}

	//Funcion que modifica los datos de un producto en la base de datos
	public function modificarProductoController(){
		//Se almacena la variable id del url
		$id = $_GET["id"];
		//Se comprueba que el boton se haya seleccionado
		if(isset($_POST["agregar"])){
			//Se comprueba que el campo de precio sea numerico
			if(is_numeric($_POST["precio"])){
				//Se almacenan los datos ingresados en un array
				$datosController = array( "codigo"=>$_POST["codigo"], 
									      "nombre"=>$_POST["nombre"],
									      "precio"=>$_POST["precio"],
									      "stock"=>$_POST["stock"],
									      "cat"=>$_POST["categoria"]);
				//Se manda a llamar el modelo que modifica el producto en la base de datos
				$respuesta=Datos::modificarProductoModel("productos",$datosController,$id);
				//si la insercion se lleva a cabo se imprime una alerta de exito y dirige a la vista de inventario
				if($respuesta){
					echo"<script language='javascript'>window.location='index.php?action=inventario&id_tienda=".$_GET["id_tienda"]."';</script>";
				}
			}else{
				//Si el campo de precio no es numerico muestra un alerta
				echo "<script type='text/javascript'>
	    					alert('Ingrese un precio numerico');
	  				  </script>";
			}
			
		}
	}


	//Funcion que muestra el stock y detalles de un producto
	public function stockController(){
		//Se comprueba que la variable id este activa en el url
		if(isset($_GET["id"])){
			//Se almacena la variable
			$id = $_GET["id"];
			//Se manda a llamar el modelo que busca los datos del producto en la base de datos
			$respuesta = Datos::buscarProductoModel($id);
			//Si la consulta se lleva a cabo se imprime toda la ifnormacion relacionada con el producto
			if($respuesta){
				$categoria = Datos::buscarCategoriaModel($respuesta["id_categoria"]);

				echo "<div class ='col-10'>
				 	  <p><b>Nombre:</b> ". $respuesta["nombre_producto"] ."</p>";
				echo " <p><b>Stock actual:</b> ". $respuesta["stock"] ."</p>";
				echo "<div class='card card-warning'>
                    <div class='card-header'>
                      <h5 class='card-title'>
                        <a data-toggle='collapse' data-parent='#accordion' href='#collapseOne'>
                          Detalles del Producto
                        </a>
                      </h5>
                    </div>
                    <div id='collapseOne' class='panel-collapse collapse in'>
                      <div class='card-body'>"."<p><b>Código:</b> ". $respuesta["codigo_producto"]. "</p>".
                      "<p><b>Precio:</b> ". $respuesta["precio_producto"]. "</p>".
                      "<p><b>Categoría:</b> ". $categoria["nombre_categoria"]. "<p>".
                      "</div>
                    </div>
                  </div>";
                 echo '<a href="index.php?action=agregarstock&id='.$id.'&id_tienda='.$_GET["id_tienda"].'" class="btn btn-success"> Agregar al stock</a>&nbsp;
                        <a href="index.php?action=quitarstock&id='.$id.'&id_tienda='.$_GET["id_tienda"].'" class="btn btn-danger"> Eliminar del stock</a>';
			}
		}
	}

	//Funcion que muestra todos los registros de historial existentes de un producto
	public function vistaHistorialController(){
		//Se comprueba que la variable id este activa en el url
		if(isset($_GET["id"])){
			//Se almacena la variable
			$id = $_GET["id"];
			//Se manda a llamar el modelo que busca todos los registros del historial de un producto
			$respuesta = Datos::buscarProHistorialModel($id);
			if($respuesta){
				//Se imprimen los datos que devuelve la consulta
				foreach ($respuesta as $fila) {
					$respuesta2 = Datos::buscarU($fila["id_usuario"]);
					echo '<tr>
					<td>'.$fila["fecha"].'</td>
					<td>'.$fila["hora"].'</td>
					<td>'.$respuesta2["nombre"].'</td>
					<td>'.$fila["cantidad"].'</td>
					<td>'.$fila["movimiento"].'</td>
					<td>'.$fila["referencia"].'</td>
					<td>'.$fila["nota"].'</td>
					</tr>';

				}
			}
		}
	}

	//Funcion que agrega al stock de un producto
	public function agregarStockController(){
		//Se comprueba que el boton haya sido seleccionado
		if(isset($_POST["agregar"])){
			//Se comprueba que la variable id este activa en el url
			if(isset($_GET["id"])){
				//Se obtiene los datos necesarios y se alamacenan en variables
				$id_tienda = $_GET["id_tienda"];
				$time = time();
				$id = $_GET["id"];
				$usuario = $_SESSION["id"];
				$movimiento = "Se agregó al stock";
				$fecha_actual = date('Y-m-d'); 
				$hora_actual = date("H:i:s",$time);
				$cantidad = $_POST["cantidad"];
				$ref = $_POST["ref"];
				$nota = $_POST["nota"];
				//Se guardan en un array
				$datosController = array (	"tienda" => $id_tienda,
											"id_producto" => $id,
											"id_usuario" => $usuario,
											"fecha" => $fecha_actual,
											"hora" => $hora_actual,
											"nota" => $nota,
											"ref" => $ref,
											"cantidad" => $cantidad,
											"mov" => $movimiento);

				//Modelo que actualiza el stock
				$respuesta = Datos::sumarYrestarStockModel($cantidad, $id, 1);
				//Si se ejecuta la consulta se actualiza la cantidad del stock en el producto
				if($respuesta=="listo"){
					//Se manda a llamar un modelo que agrega o quita cantidad de productos en stock
					$respuesta2 = Datos::agregarOquitarStockModel($datosController);
					echo"<script language='javascript'>window.location='index.php?action=stock&id=".$_GET["id"]."&id_tienda=".$id_tienda."';</script>";
				}
			}
		}

	}

	//Funcion que quita stock de un producto
	public function quitarStockController(){
		//Se comprueba que el boton se haya seleccionado
		if(isset($_POST["agregar"])){
			//Se comprieba que la variable id este activa en el url
			if(isset($_GET["id"])){
				//Se obtienen los datos ingresados y necesarios para almacenarlos en una array
				$id_tienda = $_GET["id_tienda"];
				$time = time();
				$id = $_GET["id"];
				$usuario = $_SESSION["id"];
				$movimiento = "Se quitó del stock";
				$fecha_actual = date('Y-m-d'); 
				$hora_actual = date("H:i:s",$time);
				$cantidad = $_POST["cantidad"];
				$ref = $_POST["ref"];
				$nota = $_POST["nota"];

				$datosController = array (	"tienda" => $id_tienda,
											"id_producto" => $id,
											"id_usuario" => $usuario,
											"fecha" => $fecha_actual,
											"hora" => $hora_actual,
											"nota" => $nota,
											"ref" => $ref,
											"cantidad" => $cantidad,
											"mov" => $movimiento);
				//Se manda a llamar el modelo que actualiza la cantidad del stock
				$respuesta = Datos::sumarYrestarStockModel($cantidad, $id, 2);
				//Si la consulta se lleva a cabo se actualiza el stock
				if($respuesta=="listo"){
					//Se manda a llamar el modelo que agrega o quita la cantidad de stock
						$respuesta2 = Datos::agregarOquitarStockModel($datosController);
	  					echo"<script language='javascript'>window.location='index.php?action=stock&id=".$_GET["id"]."&id_tienda=".$id_tienda."';</script>";
				}
			}
		}

	}

	//Funcion que muestra los ultimos movimientos en el dashboard
	public function ultimosMovimientosController(){
		//Se manda a llamar el modelo que consulta los registros de la base de datos
		$respuesta=Datos::consultarTiendaModel("historial",$_GET["id_tienda"]);
		//Si se lleva a cabo la consulta se recorre un el array devuevlto y se imprimen las filas
		if($respuesta){
			foreach ($respuesta as $fila) {
				$producto = Datos::buscarProductoModel($fila["id_producto"]);
				$usuario = Datos::buscarU($fila["id_usuario"]);
				echo '<tr>
				<td>'.$fila["id_historial"].'</td>
				<td>'.$producto["nombre_producto"].'</td>
				<td>'.$usuario["nombre"].'</td>
				<td>'.$fila["fecha"].'</td>
				<td>'.$fila["hora"].'</td>
				<td>'.$fila["nota"].'</td>
				<td>'.$fila["referencia"].'</td>
				<td>'.$fila["cantidad"].'</td>
				<td>'.$fila["movimiento"].'</td>
				</tr>';
			}
		}
	}

	//Funcion que muestra los ultimos movimientos en el dashboard
	public function ultimosMovimientosGlobalController(){
		//Se manda a llamar el modelo que consulta los registros de la base de datos
		$respuesta=Datos::consultarModel("historial");
		//Si se lleva a cabo la consulta se recorre un el array devuevlto y se imprimen las filas
		if($respuesta){
			foreach ($respuesta as $fila) {
				$producto = Datos::buscarProductoModel($fila["id_producto"]);
				$usuario = Datos::buscarU($fila["id_usuario"]);
				$tienda = Datos::buscarTiendaModel($fila["id_tienda"]);
				echo '<tr>
				<td>'.$fila["id_historial"].'</td>
				<td>'.$producto["nombre_producto"].'</td>
				<td>'.$usuario["nombre"].'</td>
				<td>'.$fila["fecha"].'</td>
				<td>'.$fila["hora"].'</td>
				<td>'.$fila["nota"].'</td>
				<td>'.$fila["referencia"].'</td>
				<td>'.$fila["cantidad"].'</td>
				<td>'.$fila["movimiento"].'</td>
				<td>'.$tienda["nombre"].'</td>
				</tr>';
			}
		}
	}

	//Funcion que muestra las categorias existentes logicamente en la base de datos
	public function vistaCategoriasController(){
		//Se manda a llamar el modelo que consulta la tabla en la base de datos
		$respuesta = Datos::consultarCategoriaModel($_GET["id_tienda"]);
		//Si se ejecuta la consulta se imprimen las filas
		if($respuesta){
			foreach ($respuesta as $fila) {
				echo '<tr>
				<td>'.$fila["nombre_categoria"].'</td>
				<td>'.$fila["descripcion_categoria"].'</td>
				<td>'.$fila["fecha_registro"].'</td>
				<td><a href="index.php?action=editarcategoria&id='.$fila["id_categoria"].'&id_tienda='.$_GET["id_tienda"].'" class="btn btn-info"><i class="fa fa-edit"></i> Editar</a></td>
				<td><a href="index.php?action=eliminarcategoria&idBorrar='.$fila["id_categoria"]. '&id_tienda='.$_GET["id_tienda"].'" class="btn btn-danger"><i class="fa fa-times"></i> Eliminar</a></td>
				</tr>';
			}
		}
	}

	//Funcion que trae los datos para editar una categoria
	public function editarCategoriaController(){
		//Se comprueba que la variable id este activa en la url
		if(isset($_GET["id"])){
			//Se almacena la variable
			$id = $_GET["id"];
			//Se manda  a llamar el modelo que busca la categoria en la base de datos
			$respuesta = Datos::buscarCategoriaModel($id);
			//Si se ejecuta la consulta se imprimen los campos
			if($respuesta){
				echo "<input type='text' class='form-control' name='nombre' id='nombre' placeholder='Nombre de la categoría' value='".$respuesta["nombre_categoria"]."'>
                <textarea class='form-control' name='desc' id='desc' placeholder='Descripción del producto' required>".$respuesta["descripcion_categoria"]."</textarea><br>
                <input type='hidden' class='form-control' id='c_contra' value='". $_SESSION["contra"] ."'>
                <button type='submit' class='btn btn-block btn-outline-primary' id='agregar' name='agregar' onclick='modiCat();'>Modificar</button>";
			}
		}

	}

	//Funcion que modifica una categoria en la base de datos
	public function modificarCategoriaController(){
		//Se almacena la variable id del url
		$id = $_GET["id"];
		//Se comprueba que el boton se haya seleccionado
		if(isset($_POST["agregar"])){

			$id_tienda = $_GET["id_tienda"];
			
			//Se almacenan los datos en un array
			$datosController = array(  "id" => $id,
										"nombre"=>$_POST["nombre"],
								      "desc"=>$_POST["desc"]);
			//Se manda a llamar el modelo que actualiza los datos
			$respuesta=Datos::modificarCategoriaModel("categorias",$datosController);
			//Si la actualizacion se lleva a cabo se imprime una alerta de exito
			if($respuesta){
				echo"<script language='javascript'>window.location='index.php?action=categorias&id_tienda=".$id_tienda."';</script>";
			}
		}
	}

	//Funcionq que elimina una categoria logicamente de la base de datos
	public function eliminarCategoriaController(){
		//Se comprueba que las variables id y contra esten activas en el url
		if(isset($_GET["id"]) && isset($_GET["contra"])){
			//Se almacenan las variables
			$usuario = $_SESSION["id"];
			$contra_i = $_SESSION["contra"];
			$contra = $_GET["contra"];
			$categoria = $_GET["id"];
			$id_tienda = $_GET["id_tienda"];
			//Se manda a llamar el modelo que busca al usuario en la base de datos
			$respuesta = Datos::buscarUsuarioModel($usuario, $contra);
			//Si devuelve success se elimina la categoria
			if($contra_i == $contra){
				//Modelo que elimina la categoria logicamente
				$respuesta2 = Datos::eliminarCategoriaModel($categoria);
				//Si se elimina la categoria se dirige a la vista de categorias
				if($respuesta2){
					echo"<script language='javascript'>window.location='index.php?action=categorias&id_tienda=".$id_tienda."';</script>";
				}
			}else{
				//Si no se lleva a cabo se imprime una alerta
				echo "<script type='text/javascript'>
    					alert('Contraseña incorrecta');
  				  </script>";
			}
		}
	}

	//Funcion que muestra los usuarios registrados y existentes de forma logica en la base de datos
	public function vistaUsuarioController(){
		//Se manda a llamar el modelo que que trae a todos los usuarios
		$respuesta = Datos::consultarModel("usuarios");
		//Si la consulta en el modelo se ejecuta exitosamente se recorre el array devuelto para imprimir los usuarios
		if($respuesta){
			foreach ($respuesta as $fila) {
				//Se imprimen las filas de las tablas
				$tienda = Datos::buscarTiendaModel($fila["id_tienda"]);
				if($tienda["nombre"]!="default"){
					echo'<tr>
					<td>'.$fila["nombre"].'</td>
					<td>'.$fila["usuario"].'</td>
					<td>'.$fila["pass"].'</td>
					<td>'.$fila["fecha_registro"].'</td>
					<td>'.$tienda["nombre"].'</td>
					<td><a href="index.php?action=editarusuario&id='.$fila["id_usuario"].'" class="btn btn-info"><i class="fa fa-edit"></i> Editar</a></td>
					<td><a href="index.php?action=eliminarusuario&idBorrar='.$fila["id_usuario"].'" class="btn btn-danger"><i class="fa fa-times"></i> Eliminar</a></td>
					</tr>';
				}
			}
		}
	}

	//Funcion que trae los datos para editar un usuario 
	public function editarUsuarioController(){
		//Se comprueba que la variable id este activa en la url
		if(isset($_GET["id"])){
			//Se almacena la variable
			$id = $_GET["id"];
			//Se ejecuta el modelo que busca al usuario
			$respuesta = Datos::buscarU($id);
			//Si muestran los campos necesarios
			if($respuesta){
				echo "<input type='text' class='form-control' name='nombre' placeholder='Nombre' value='".$respuesta["nombre"]."' required>
                    <input type='text' class='form-control' name='usuario' placeholder='Usuario' value='".$respuesta["usuario"]. "' required>
                    <input type='text' class='form-control' name='contra' placeholder='Contraseña' value='".$respuesta["pass"]. "'required>
                    <a href='index.php?action=confirmacionmodificar'><button type='button' class='btn btn-block btn-outline-primary' name='agregar'>Modificar</button></a>";
			}
		}

	}

	//Funcion que modifica un usuario
	public function modificarUsuarioController(){
		//Se almacena la variable id 
		$id = $_GET["id"];
		//Se comprueba que el boton se haya seleccionado
		if(isset($_POST["modi"])){
			
			//Se almacenan los datos en un array
			$datosController = array(  "id" => $id,
										"nombre"=>$_POST["nombre"],
								      "usuario"=>$_POST["usuario"],
								  		"contra"=>$_POST["contra"],);
			//Se manda a llamar el modelo que modifica el usuario en la base de datos
			$respuesta=Datos::modificarUsuarioModel("usuarios",$datosController);
			//Si la actualizacion se lleva a cabo se imprime una alerta de exito
			if($respuesta){
				echo "<script type='text/javascript'>
    					alert('Usuario modificado');
  				  </script>";
  				echo"<script language='javascript'>window.location='index.php?action=usuarios';</script>";
			}else{
				//Si no se actualiza el usuario tambien muestra un alerta de error
				echo "<script type='text/javascript'>
    					alert('Ocurrió un problema');
  				  </script>";
			}
		}
	}

	//Funcion que elimina un usuario de manera logica de la base de datos
	public function eliminarUsuarioController(){
		//Se comprueba que las variables id y contra estena ctivas en la url
		if(isset($_GET["id"]) && isset($_GET["contra"])){
			//Se alamcenan las variables necesarias
			$usuario = $_SESSION["id"];
			$contra = $_GET["contra"];
			$usuario = $_GET["id"];
			//Se manda a llamar al modelo que busca al usuario y comprueba que existe
			$respuesta = Datos::buscarUsuarioModel($usuario, $contra);
			//Si el usuario existe manda success
			if($respuesta=="success"){
				//Se manda a llamar el modelo que elimina al usuario
				$respuesta2 = Datos::eliminarUsuarioModel($usuario);
				//Si se elimina el usuario se dirige a la vista de usuarios
				if($respuesta2){
					echo"<script language='javascript'>window.location='index.php?action=usuarios';</script>";
				}
			}else{
				//Si no se encuentra el usuario se muestra una alerta
				echo "<script type='text/javascript'>
    					alert('Contraseña incorrecta');
  				  </script>";
			}
		}
	}

	//Funcion que obtiene todas las categorias registradas en la base de datos que se cataloguen como existentes logicamente
	public function traerTiendasController(){
		//Se ejecuta el modelo que consulta las categorias existentes
		$respuesta = Datos::consultarModel("tienda");
		//Se comprueba que la consulta se haya llevado a cabo y se imprimen en el select2
		if($respuesta){
			foreach ($respuesta as $fila) {
				if($fila["nombre"]!="default"){
					echo '<option value="'.$fila["id_tienda"].'">'.$fila["nombre"].'</option>';
				}
			}
		}
	}

	public function registrarUsuarioGlobalController(){

		//Se comprueba que el boton se haya seleccionado
		if(isset($_POST["agregar"])){
			//Se obtiene la fecha actual del servidor
			$fecha_actual = date('Y-m-d'); 
			//Se almacenan los datos ingresados en un array
			$datosController = array( "nombre"=>$_POST["nombre"], 
								      "usuario"=>$_POST["usuario"],
								      "contra"=>$_POST["contra"],
								  	"fecha"=>$fecha_actual,
								  	"tienda"=>$_POST["tienda"],
								  	"tipo"=>"2");
			//Se manda a llamar el modelo que registra al usuario en la base de datos
			$respuesta=Datos::agregarUsuarioModel("usuarios",$datosController);
			//Si la insercion se lleva a cabo se imprime una alerta de exito
			if($respuesta){
				echo"<script language='javascript'>window.location='index.php?action=usuarios';</script>";
			}
		}

	}

	public function editarUsuarioGlobalController(){
		//Se comprueba que la variable id este activa en la url
		if(isset($_GET["id"])){
			//Se almacena la variable
			$id = $_GET["id"];
			//Se ejecuta el modelo que busca al usuario
			$respuesta = Datos::buscarU($id);
			//Si muestran los campos necesarios
			if($respuesta){
				$tiendas = Datos::consultarModel("tienda");
				echo "<input type='text' class='form-control' name='nombre' id='nombre' placeholder='Nombre' value='".$respuesta["nombre"]."' required>
                    <input type='text' class='form-control' name='usuario' id='usuario' placeholder='Usuario' value='".$respuesta["usuario"]. "' required>
                    <input type='text' class='form-control' name='contra' id='contra' placeholder='Contraseña' value='".$respuesta["pass"]. "'required>";
	             echo "<select class='form-control select2' style='width: 100%' name='tienda'>";
	        		foreach ($tiendas as $fila) {
					  	if($fila["id_tienda"]==$respuesta["id_tienda"]){
					  		echo '<option value="'.$fila["id_tienda"].'" selected>'.$fila["nombre"].'</option>';
					  	}else{
					  		if($fila["nombre"]!="default"){
					  			echo '<option value="'.$fila["id_tienda"].'">'.$fila["nombre"].'</option>';;
					  		}
					  	}
	        		}		  
                echo "</select><br><br>";
                echo "<button type='submit' class='btn btn-block btn-outline-primary' id='agregar' name='agregar' onclick='modi();'>Modificar</button>";
			}
		}

	}

	public function modificarUsuarioGlobalController(){
		//Se almacena la variable id 
		$id = $_GET["id"];
		//Se comprueba que el boton se haya seleccionado
		if(isset($_POST["agregar"])){
				//Se almacenan los datos en un array
				$datosController = array( "id" => $id,
											"nombre"=>$_POST["nombre"],
									      "usuario"=>$_POST["usuario"],
									  		"contra"=>$_POST["contra"],
									  		"tienda"=>$_POST["tienda"]);

				//Se manda a llamar el modelo que modifica el usuario en la base de datos
				$respuesta=Datos::modificarUsuarioModel("usuarios",$datosController);
				//Si la actualizacion se lleva a cabo se imprime una alerta de exito
				if($respuesta){
	  				echo"<script language='javascript'>window.location='index.php?action=usuarios';</script>";
				}
		}
	}

	//Funcion que elimina un usuario de manera logica de la base de datos
	public function eliminarUsuarioGlobalController(){
		//Se comprueba que las variables id y contra estena ctivas en la url
		if(isset($_GET["id"]) && isset($_GET["contra"])){
			//Se alamcenan las variables necesarias
			$usuario = $_SESSION["id"];
			$contra = $_GET["contra"];
			$usuario = $_GET["id"];
			//Se manda a llamar al modelo que busca al usuario y comprueba que existe
			$respuesta = Datos::buscarUsuarioModel($usuario, $contra);
			//Si el usuario existe manda success
			if($respuesta=="success"){
				//Se manda a llamar el modelo que elimina al usuario
				$respuesta2 = Datos::eliminarUsuarioModel($usuario);
				//Si se elimina el usuario se dirige a la vista de usuarios
				if($respuesta2){
					echo"<script language='javascript'>window.location='index.php?action=usuarios';</script>";
				}else{
  				  echo"<script language='javascript'>window.location='index.php?action=usuarios';</script>";
				}
			}else{
				//Si no se encuentra el usuario se muestra una alerta
				echo "<script type='text/javascript'>
    					alert('Contraseña incorrecta');
  				  </script>";
			}
		}
	}

	function vistaTiendaController(){

		$respuesta = Datos::todasTiendasModel();
		//Si la consulta en el modelo se ejecuta exitosamente se recorre el array devuelto para imprimir los usuarios
		if($respuesta){
			foreach ($respuesta as $fila) {
				//Se imprimen las filas de las tablas
				if($fila["nombre"]!="default"){

					echo'<tr>
					<td>'.$fila["nombre"].'</td>
					<td>'.$fila["direccion"].'</td>
					<td><a href="index.php?action=editartienda&id='.$fila["id_tienda"].'" class="btn btn-info"><i class="fa fa-edit"></i> Editar</a></td>';
					if($fila["desactivado"]==0){

						echo '<td><a href="index.php?action=confirmarestado&id='.$fila["id_tienda"].'" class="btn btn-danger"><i class="fa fa-times"></i> Desactivar</a></td>';

					}else{
						echo '<td><a href="index.php?action=confirmarestado&id='.$fila["id_tienda"].'" class="btn btn-success"><i class="fa fa-check"></i> Activar</a></td>';
					}
					echo '<td><a href="index.php?action=dashboardtienda&id_tienda='.$fila["id_tienda"].'" class="btn btn-warning"><i class="fa fa-home"></i> Ingresar</a></td>';

				}
			
			}
		}

	}

	function registrarTiendaController(){

		if(isset($_POST["agregar"])){
			//Se almacenan los datos ingresados en un array
			$datosController = array( "nombre"=>$_POST["nombre"], 
								      "direccion"=>$_POST["dir"]);
			//Se manda a llamar el modelo que registra al usuario en la base de datos
			$respuesta=Datos::agregarTiendaModel("tienda",$datosController);
			//Si la insercion se lleva a cabo se imprime una alerta de exito
			if($respuesta){
				echo"<script language='javascript'>window.location='index.php?action=tiendas';</script>";
			}
		}

	}

	function editarTiendaController(){

		if(isset($_GET["id"])){
			//Se almacena la variable
			$id = $_GET["id"];
			//Se ejecuta el modelo que busca al usuario
			$respuesta = Datos::buscarTiendaModel($id);
			//Si muestran los campos necesarios
			if($respuesta){
				echo "<input type='text' class='form-control' name='nombre' id='nombre' placeholder='Nombre' value='".$respuesta["nombre"]."'>
                    <input type='text' class='form-control' name='dir' id='dir' placeholder='Descripción' value='".$respuesta["direccion"]. "'>";
                echo "<button type='submit' class='btn btn-block btn-outline-primary' id='agregar' name='agregar' onclick='modificarTienda();'>Modificar</button>";
			}
		}

	}

	function modificarTiendaController(){

		//Se almacena la variable id 
		$id = $_GET["id"];
		//Se comprueba que el boton se haya seleccionado
		if(isset($_POST["agregar"])){
				//Se almacenan los datos en un array
				$datosController = array( "id" => $id,
											"nombre"=>$_POST["nombre"],
									      "direccion"=>$_POST["dir"]);

				//Se manda a llamar el modelo que modifica el usuario en la base de datos
				$respuesta=Datos::modificarTiendaModel("tienda",$datosController);
				//Si la actualizacion se lleva a cabo se imprime una alerta de exito
				if($respuesta){
	  				echo"<script language='javascript'>window.location='index.php?action=tiendas';</script>";
				}
		}

	}

	function desActTiendaController(){
		if(isset($_GET["id"])){
			$id = $_GET["id"];
			$respuesta=Datos::opTiendaModel($id);
			if($respuesta){
				echo"<script language='javascript'>window.location='index.php?action=tiendas';</script>";
			}

		}
	}

	function tiendaController(){
		$idtienda = $_GET["id_tienda"];
		$tienda = Datos::buscarTiendaModel($idtienda);
		echo "<a class='d-block'><i class='nav-icon fa fa-home'></i>&ensp;" . $tienda["nombre"] . "</a>";
	}

	//Funcion que cuenta todos los productos registrados catalogados logicamente como existentes (es decir, con el campo eliminado como 0)
	public function contarProductosTiendaController(){
		$id_tienda = $_GET["id_tienda"];
		//Se ejecuta el modelo que consulta los registros de una tabla
		$respuesta = Datos::totalesTiendaModel("productos",$id_tienda);
		//Se comprueba que la consulta se haya llevado a cabo y se imprimen los resultados
		if($respuesta){
			echo $respuesta;
		}else{
		//Si no se encontraron registros se imprime un 0
			echo "0";
		}
	}

	//Funcion que cuenta todos los usuarios registrados catalogados logicamente como existentes (es decir, con el campo eliminado como 0)
	public function contarUsuariosTiendaController(){
		$id_tienda = $_GET["id_tienda"];
		//Se ejecuta el modelo que consulta los usuarios existentes
		$respuesta = Datos::totalesTiendaModel("usuarios", $id_tienda);
		//Se comprueba que la consulta se haya llevado a cabo y se imprimen los resultados
		if($respuesta){
			echo $respuesta;
		}else{
			echo "0";
		}
	}

	//Funcion que cuenta todos las categorias registrados catalogados logicamente como existentes (es decir, con el campo eliminado como 0)
	public function contarCategoriasTiendaController(){
		$id_tienda = $_GET["id_tienda"];
		//se ejecuta el modelo que consulta las categorias existentes
		$respuesta = Datos::totalesTiendaModel("categorias", $id_tienda);
		//se comprueba que la consulta se haya llevado a cabo y se imprimen los resultados
		if($respuesta){
			echo $respuesta;
		}else{
			//Si no se encontraron registros se imprime un 0
			echo "0";
		}
	}

	//Funcion que cuenta todos los movimientos registrados catalogados logicamente como existentes (es decir, con el campo eliminado como 0)
	public function contarMovimientosTiendaController(){
		$id_tienda = $_GET["id_tienda"];
		//se ejecuta el modelo que consulta los movimientos existentes
		$respuesta = Datos::totalesTiendaModel("historial", $id_tienda);
		//se comprueba que la consulta se haya llevado a cabo y se imprimen los resultados
		if($respuesta){
			echo $respuesta;
		}else{
			//Si no se encontraron registros se imprime un 0
			echo "0";
		}
	}

	//Funcion que muestra los usuarios registrados y existentes de forma logica en la base de datos
	public function vistaUsuarioTiendaController(){
		//Se manda a llamar el modelo que que trae a todos los usuarios
		$respuesta = Datos::consultarTiendaModel("usuarios",$_GET["id_tienda"]);
		//Si la consulta en el modelo se ejecuta exitosamente se recorre el array devuelto para imprimir los usuarios
		if($respuesta){
			foreach ($respuesta as $fila) {
				//Se imprimen las filas de las tablas
				if($fila["id_usuario"]!=$_SESSION["id"] && $fila["usuario"]!="mario" && $fila["usuario"]!="yjonas"){
					echo'<tr>
					<td>'.$fila["nombre"].'</td>
					<td>'.$fila["usuario"].'</td>
					<td>'.$fila["pass"].'</td>
					<td>'.$fila["fecha_registro"].'</td>
					<td><a href="index.php?action=editarusuariotienda&id='.$fila["id_usuario"].'&id_tienda='.$_GET["id_tienda"].'" class="btn btn-info"><i class="fa fa-edit"></i> Editar</a></td>
					<td><a href="index.php?action=eliminarusuariotienda&idBorrar='.$fila["id_usuario"].'&id_tienda='.$_GET["id_tienda"].'" class="btn btn-danger"><i class="fa fa-times"></i> Eliminar</a></td>
					</tr>';
					
				}
			}
		}
	}

	public function editarUsuarioTiendaController(){
		//Se comprueba que la variable id este activa en la url
		if(isset($_GET["id"])){
			//Se almacena la variable
			$id = $_GET["id"];
			//Se ejecuta el modelo que busca al usuario
			$respuesta = Datos::buscarU($id);
			//Si muestran los campos necesarios
			if($respuesta){
				echo "<input type='text' class='form-control' name='nombre' id='nombre' placeholder='Nombre' value='".$respuesta["nombre"]."' required>
                    <input type='text' class='form-control' name='usuario' id='usuario' placeholder='Usuario' value='".$respuesta["usuario"]. "' required>
                    <input type='text' class='form-control' name='contra' id='contra' placeholder='Contraseña' value='".$respuesta["pass"]. "'required>
                    <input type='hidden' class='form-control' id='c_contra' value='". $_SESSION["contra"] ."'>";
                echo "<button type='submit' class='btn btn-block btn-outline-primary' id='agregar' name='agregar' onclick='modiUsuarioT();'>Modificar</button>";
			}
		}

	}

	public function modificarUsuarioTiendaController(){
		//Se almacena la variable id 
		$id = $_GET["id"];
		$id_tienda = $_GET["id_tienda"];
		//Se comprueba que el boton se haya seleccionado
		if(isset($_POST["agregar"])){
				//Se almacenan los datos en un array
				$datosController = array( "id" => $id,
											"nombre"=>$_POST["nombre"],
									      "usuario"=>$_POST["usuario"],
									  		"contra"=>$_POST["contra"],
									  		"tienda"=>$id_tienda);

				//Se manda a llamar el modelo que modifica el usuario en la base de datos
				$respuesta=Datos::modificarUsuarioModel("usuarios",$datosController);
				//Si la actualizacion se lleva a cabo se imprime una alerta de exito
				if($respuesta){
	  				echo"<script language='javascript'>window.location='index.php?action=usuariostienda&id_tienda=".$id_tienda."';</script>";
				}
		}
	}

	//Funcion que elimina un usuario de manera logica de la base de datos
	public function eliminarUsuarioTiendaController(){
		//Se comprueba que las variables id y contra estena ctivas en la url
		if(isset($_GET["id"]) && isset($_GET["contra"])){
			//Se alamcenan las variables necesaria
			$id = $_GET["id"];
			$contra = $_GET["contra"];
			$contra_i = $_SESSION["contra"];
			$id_tienda = $_GET["id_tienda"];
			//Si el usuario existe manda success
			if($contra_i == $contra){
				//Se manda a llamar el modelo que elimina al usuario
				$respuesta2 = Datos::eliminarUsuarioModel($id);
				echo"<script language='javascript'>window.location='index.php?action=usuariostienda&id_tienda=".$id_tienda."';</script>";

			}else{
				//Si no se encuentra el usuario se muestra una alerta
				echo "<script type='text/javascript'>
    					alert('Contraseña incorrecta');
  				  </script>";
			}
		}
	}

	//Funcion que registra un usuario
	public function registrarUsuarioTiendaController(){
		//Se comprueba que el boton se haya seleccionado
		if(isset($_POST["agregar"])){
			//Se obtiene la fecha actual del servidor
			$fecha_actual = date('Y-m-d'); 
			$id_tienda = $_GET["id_tienda"];
			//Se almacenan los datos ingresados en un array
			$datosController = array( "nombre"=>$_POST["nombre"], 
								      "usuario"=>$_POST["usuario"],
								      "contra"=>$_POST["contra"],
								  	"fecha"=>$fecha_actual,
								  	"tipo"=>2,
								  	"tienda"=>$id_tienda);
			//Se manda a llamar el modelo que registra al usuario en la base de datos
			$respuesta=Datos::agregarUsuarioModel("usuarios",$datosController);
			//Si la insercion se lleva a cabo se imprime una alerta de exito
			if($respuesta){

				echo"<script language='javascript'>window.location='index.php?action=usuariostienda&id_tienda=".$id_tienda."';</script>";
				
			}
		}
	}

	//Funcion que muestra las ventas de una tienda
	public function vistaVentasController(){

		$respuesta = Datos::consultarVentasModel($_GET["id_tienda"]);
		if($respuesta){
			foreach ($respuesta as $fila) {
				$usuario = Datos::buscarU($fila["id_usuario"]);

				echo'<tr>
					<td>'.$fila["id_venta"].'</td>
					<td>'.$fila["fecha"].'</td>
					<td>'.$usuario["nombre"].'</td>
					<td>'.$fila["total"].'</td>
					<td><a href="index.php?action=verdetalles&id='.$fila["id_venta"].'&id_tienda='.$_GET["id_tienda"].'" class="btn btn-warning"><i class="fa fa-edit"></i> Ver Detalles</a></td>
				</tr>';
				
			}
		}

	}

	public function traerProductosTiendaController(){

		$respuesta = Datos::productosTiendaModel($_GET["id_tienda"]);

		if($respuesta){
			foreach ($respuesta as $fila) {
			  	echo '<option value="'.$fila["id_producto"].'">'.$fila["nombre_producto"]. ", ".$fila["precio_producto"]. ", " . $fila["stock"] . '</option>';
    		}		 
		}

	}

	//Funcion que registra una venta
	public function registrarVentaController(){
		$t =0;
		if(isset($_POST["agregar"])){
			$tienda = $_GET["id_tienda"];
			$usuario = $_SESSION["id"];
			$fecha_actual = date('Y-m-d'); 
			$lista = $_POST["p"];
			$dat = explode("$", $lista);
			$id_tienda = $_GET["id_tienda"];
			$time = time();
			$hora_actual = date("H:i:s",$time);
			$movimiento = "Venta";
			$t = $_POST["precio"];

			$r = Datos::crearVentaModel($tienda,$usuario,$fecha_actual,$t);
			if($r){

				for ($i=0; $i <sizeof($dat)-1; $i++) { 
					$dat2 = explode(",", $dat[$i]);
					$total = (float)$dat2[2] * (float)$dat2[4];
					$r2 = Datos::agregarPVentaModel($r["id_venta"],$dat2[0],$dat2[4],$total);
					//Se guardan en un array
					$datosController = array ("tienda" => $tienda,
											"id_producto" => $dat2[0],
											"id_usuario" => $usuario,
											"fecha" => $fecha_actual,
											"hora" => $hora_actual,
											"nota" => " ",
											"ref" => " ",
											"cantidad" => $dat2[4],
											"mov" => $movimiento);

					Datos::agregarOquitarStockModel($datosController);
				}
				
				echo"<script language='javascript'>window.location='index.php?action=ventas&id_tienda=".$id_tienda."';</script>";

			}
			
		}
	}

	//Funcion que muestra detalles de una venta
	public function ventaController(){
		$id = $_GET["id"];

		$respuesta = Datos::buscarVenta($id);
		if($respuesta){
			$vend = Datos::buscarU($respuesta["id_usuario"]);
			echo "<div class ='col-10'>
				 	  <p><b>Id de la venta:</b> ". $respuesta["id_venta"] ."</p>";
				echo "<div class='card card-warning'>
                    <div class='card-header'>
                      <h5 class='card-title'>
                        <a data-toggle='collapse' data-parent='#accordion' href='#collapseOne'>
                          Detalles del Producto
                        </a>
                      </h5>
                    </div>
                    <div id='collapseOne' class='panel-collapse collapse in'>
                      <div class='card-body'>"."<p><b>Fecha:</b> ". $respuesta["fecha"]. "</p>".
                      "<p><b>Vendedor:</b> ". $vend["nombre"]. "</p>".
                      "<p><b>Total:</b> ". $respuesta["total"]. "<p>".
                      "</div>
                    </div>
                  </div>";
		}
	}

	//Funcion que muestra los productos de una venta

	public function vistaVentaController(){
		$id = $_GET["id"];
		$respuesta = Datos::buscarProductos($id);
		if($respuesta){
			foreach ($respuesta as $fila) {
				$producto = Datos::buscarProductoModel($fila["id_producto"]);
				echo'<tr>
					<td>'.$producto["nombre_producto"].'</td>
					<td>'.$fila["unidades"].'</td>
					<td>'.$fila["total"].'</td>
					</tr>';
			}
		}
	}






}
