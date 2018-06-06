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
				//Se dirige al dashboard
				header("location:index.php?action=dashboard");
			}else{
				//Si los datos no son correctos se dirige al login de nuevo
				header("location:index.php?action=fallo");
			}

		}
	}

	//Funcion que registra una categoria
	public function registrarCategoriaController(){
		//Se comprueba que el boton se haya seleccionado
		if(isset($_POST["agregar"])){
			//Se obtiene la fecha actual del servidor
			$fecha_actual = date('Y-m-d'); 
			//Se almacenan los datos ingresados en un array
			$datosController = array( "nombre"=>$_POST["nombre"], 
								      "desc"=>$_POST["desc"],
								  	"fecha"=>$fecha_actual);
			
			//Se manda a llamar el modelo que registra una categoria en la base de datos
			$respuesta=Datos::agregarCategoriaModel("categorias",$datosController);
			//Si la insercion se lleva a cabo se imprime una alerta de exito
			if($respuesta){
				echo "<script type='text/javascript'>
    					alert('Categoria registrada');
  				  </script>";
			}else{
				//Si no se registra la categoria tambien muestra un alerta de error
				echo "<script type='text/javascript'>
    					alert('Ocurrió un problema');
  				  </script>";
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
		$respuesta = Datos::consultarModel("categorias");
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
			//Se comprueba que el dato de precio ingresado realmente sea un numero
			if(is_numeric($_POST["precio"])){
				//Se almacena la fecha actual del servidor
				$fecha_actual = date('Y-m-d'); 
				//Se almacenan los datos ingresados en un array
				$datosController = array( "codigo"=>$_POST["codigo"], 
									      "nombre"=>$_POST["nombre"],
									      "precio"=>$_POST["precio"],
									      "stock"=>$_POST["stock"],
									      "cat"=>$_POST["categoria"],
									  	"fecha"=>$fecha_actual);
				//Se manda a llamar el modelo que registra el producto en la base de datos
				$respuesta=Datos::agregarProductoModel("productos",$datosController);
				//Si la insercion se lleva a cabo se imprime una alerta de exito
				if($respuesta){
					echo "<script type='text/javascript'>
	    					alert('Producto registrado');
	  				  </script>";
				}else{
					//Si no se registra el alumno tambien muestra un alerta de error
					echo "<script type='text/javascript'>
	    					alert('Ocurrió un problema');
	  				  </script>";
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
		$respuesta = Datos::consultarModel("productos");
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
				<td><a href="index.php?action=editarproducto&id='.$fila["id_producto"].'" class="btn btn-info"><i class="fa fa-edit"></i> Editar</a></td>
				<td><a href="index.php?action=eliminarproducto&idBorrar='.$fila["id_producto"].'" class="btn btn-danger"><i class="fa fa-times"></i> Eliminar</a></td>
				<td><a href="index.php?action=stock&id='.$fila["id_producto"].'" class="btn btn-warning"><i class="fa fa-refresh"></i> Actualizar Stock</a></td>
				</tr>';
			}
		}
			
	}

	//Funcion que elimina un producto logicamente de la base de datos
	public function eliminarProductoController(){
		//Se comprueba que las variables id y contra esten en la url para validar el usuario 
		if(isset($_GET["id"]) && isset($_GET["contra"])){
			//Se almacenan las variables individualmente
			$usuario = $_SESSION["id"];
			$contra = $_GET["contra"];
			$produ = $_GET["id"];

			//Se manda a llamar el modelo que valida la existencia de un usuario
			$respuesta = Datos::buscarUsuarioModel($usuario, $contra);
			//Si lo que retorna la consulta es un success se elimina el producto
			if($respuesta=="success"){
				//Se manda a llamar el modelo que elimina el producto logicamente de la base de datos
				$respuesta2 = Datos::eliminarProductoModel($produ);
				//Si se elimina el producto se dirige a la vista de inventario para ver los cambios
				if($respuesta2){
					echo"<script language='javascript'>window.location='index.php?action=inventario';</script>";
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
            			<input type='text' class='form-control' name='codigo' placeholder='Codigo del producto' style='width: 30%' value='".$respuesta["codigo_producto"]."' required>
            		</div><br>";
            	echo "<input type='text' class='form-control' name='nombre' placeholder='Nombre del producto' value='". $respuesta["nombre_producto"] ."' required>";
            	echo "<div class='input-group'>
                  		<div class='input-group-prepend'>
                    		<span class='input-group-text'><i class='fa fa-usd'></i></span>
                  		</div>
                  			<input type='text' class='form-control' name='precio' placeholder='Precio del producto' value='". $respuesta["precio_producto"] ."' required>
                	</div><br>";
                echo "<div class='input-group'>
                  		<div class='input-group-prepend'>
                    		<span class='input-group-text'><i class='fa fa-cube'></i></span>
                  		</div>
                  			<input type='number' class='form-control' name='stock' placeholder='Stock inicial' value='".$respuesta["stock"]."' required>
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
                echo "<button type='submit' class='btn btn-block btn-outline-primary' name='agregar'>Modificar</button>";
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
					echo "<script type='text/javascript'>
	    					alert('Producto modificado');
	  				  </script>";
	  				echo"<script language='javascript'>window.location='index.php?action=inventario';</script>";
				}else{
					//Si no se registra el producto tambien muestra un alerta de error
					echo "<script type='text/javascript'>
	    					alert('Ocurrió un problema');
	  				  </script>";
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
                 echo '<a href="index.php?action=agregarstock&id='.$id.'" class="btn btn-success"> Agregar al stock</a>&nbsp;
                        <a href="index.php?action=quitarstock&id='.$id.'" class="btn btn-danger"> Eliminar del stock</a>';
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
				$datosController = array ("id_producto" => $id,
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
				if($respuesta){
					//Se manda a llamar un modelo que agrega o quita cantidad de productos en stock
					$respuesta2 = Datos::agregarOquitarStockModel($datosController);
					//Si se actualiza el stock muestra una alerta y se dirige a los detalles del producto
					if($respuesta2){
						echo "<script type='text/javascript'>
	    					alert('Añadido al stock');
	  				  		</script>";
	  					echo"<script language='javascript'>window.location='index.php?action=stock&id=".$id."';</script>";
					}
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
				$time = time();
				$id = $_GET["id"];
				$usuario = $_SESSION["id"];
				$movimiento = "Se quitó del stock";
				$fecha_actual = date('Y-m-d'); 
				$hora_actual = date("H:i:s",$time);
				$cantidad = $_POST["cantidad"];
				$ref = $_POST["ref"];
				$nota = $_POST["nota"];

				$datosController = array ("id_producto" => $id,
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
				if($respuesta){
					//Se manda a llamar el modelo que agrega o quita la cantidad de stock
					$respuesta2 = Datos::agregarOquitarStockModel($datosController);
					//Si se actualiza el stock muestra una alerta de exito y se dirige a los detalles del producto
					if($respuesta == "error"){
						echo "<script type='text/javascript'>
	    					alert('No hay unidades suficientes, no se realizó la acción');
	  				  		</script>";
	  					echo"<script language='javascript'>window.location='index.php?action=stock&id=".$id."';</script>";

					}else{
						echo "<script type='text/javascript'>
	    					alert('Se ha eliminado del stock');
	  				  		</script>";
	  					echo"<script language='javascript'>window.location='index.php?action=stock&id=".$id."';</script>";
					}
				}
			}
		}

	}

	//Funcion que muestra los ultimos movimientos en el dashboard
	public function ultimosMovimientosController(){
		//Se manda a llamar el modelo que consulta los registros de la base de datos
		$respuesta=Datos::consultarModel("historial");
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

	//Funcion que muestra las categorias existentes logicamente en la base de datos
	public function vistaCategoriasController(){
		//Se manda a llamar el modelo que consulta la tabla en la base de datos
		$respuesta = Datos::consultarModel("categorias");
		//Si se ejecuta la consulta se imprimen las filas
		if($respuesta){
			foreach ($respuesta as $fila) {
				echo '<tr>
				<td>'.$fila["nombre_categoria"].'</td>
				<td>'.$fila["descripcion_categoria"].'</td>
				<td>'.$fila["fecha_registro"].'</td>
				<td><a href="index.php?action=editarcategoria&id='.$fila["id_categoria"].'" class="btn btn-info"><i class="fa fa-edit"></i> Editar</a></td>
				<td><a href="index.php?action=eliminarcategoria&idBorrar='.$fila["id_categoria"].'" class="btn btn-danger"><i class="fa fa-times"></i> Eliminar</a></td>
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
				echo "<input type='text' class='form-control' name='nombre' placeholder='Nombre de la categoría' value='".$respuesta["nombre_categoria"]."' required>
                <textarea class='form-control' name='desc' placeholder='Descripción del producto' required>".$respuesta["descripcion_categoria"]."</textarea><br>
                <button type='submit' class='btn btn-block btn-outline-primary' name='agregar'>Modificar</button>";
			}
		}

	}

	//Funcion que modifica una categoria en la base de datos
	public function modificarCategoriaController(){
		//Se almacena la variable id del url
		$id = $_GET["id"];
		//Se comprueba que el boton se haya seleccionado
		if(isset($_POST["agregar"])){
			
			//Se almacenan los datos en un array
			$datosController = array(  "id" => $id,
										"nombre"=>$_POST["nombre"],
								      "desc"=>$_POST["desc"]);
			//Se manda a llamar el modelo que actualiza los datos
			$respuesta=Datos::modificarCategoriaModel("categorias",$datosController);
			//Si la actualizacion se lleva a cabo se imprime una alerta de exito
			if($respuesta){
				echo "<script type='text/javascript'>
    					alert('Categoria modificada');
  				  </script>";
  				echo"<script language='javascript'>window.location='index.php?action=categorias';</script>";
			}else{
				//Si no se actualiza tambien muestra un alerta de error
				echo "<script type='text/javascript'>
    					alert('Ocurrió un problema');
  				  </script>";
			}
		}
	}

	//Funcionq que elimina una categoria logicamente de la base de datos
	public function eliminarCategoriaController(){
		//Se comprueba que las variables id y contra esten activas en el url
		if(isset($_GET["id"]) && isset($_GET["contra"])){
			//Se almacenan las variables
			$usuario = $_SESSION["id"];
			$contra = $_GET["contra"];
			$categoria = $_GET["id"];
			//Se manda a llamar el modelo que busca al usuario en la base de datos
			$respuesta = Datos::buscarUsuarioModel($usuario, $contra);
			//Si devuelve success se elimina la categoria
			if($respuesta=="success"){
				//Modelo que elimina la categoria logicamente
				$respuesta2 = Datos::eliminarCategoriaModel($categoria);
				//Si se elimina la categoria se dirige a la vista de categorias
				if($respuesta2){
					echo"<script language='javascript'>window.location='index.php?action=categorias';</script>";
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
				echo'<tr>
				<td>'.$fila["nombre"].'</td>
				<td>'.$fila["usuario"].'</td>
				<td>'.$fila["pass"].'</td>
				<td>'.$fila["fecha_registro"].'</td>
				<td><a href="index.php?action=editarusuario&id='.$fila["id_usuario"].'" class="btn btn-info"><i class="fa fa-edit"></i> Editar</a></td>
				<td><a href="index.php?action=eliminarusuario&idBorrar='.$fila["id_usuario"].'" class="btn btn-danger"><i class="fa fa-times"></i> Eliminar</a></td>
				</tr>';
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
                    <button type='submit' class='btn btn-block btn-outline-primary' name='agregar'>Modificar</button>";
			}
		}

	}

	//Funcion que modifica un usuario
	public function modificarUsuarioController(){
		//Se almacena la variable id 
		$id = $_GET["id"];
		//Se comprueba que el boton se haya seleccionado
		if(isset($_POST["agregar"])){
			
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


}
