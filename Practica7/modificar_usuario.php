<?php 
	//se manda a llamar el archivo que contiene todas las funciones necesarias
	require_once("db/funciones.php");
  //se obtiene el id de la url
  $id = isset( $_GET['id'] ) ? $_GET['id'] : '';
  //busca los datos de ese id en la bd
  $b = buscar(1,$id);
  //print_r($r);
  $cont=0;
  //comprueba que las cajas hayan sido llenadas
  if(isset($_POST["nombre"])){
      $cont++;
  }
  if(isset($_POST["usuario"])){
      $cont++;
  }
  if($cont==2){
    //ejecuta la funcion de modificar
    $r = modificar_usuario($id, $_POST["nombre"],$_POST["usuario"]);
    if($r){
      //genera un mensaje de exito
      echo "<script type='text/javascript'>
            alert('Usuario modificado');
          </script>";
          //carga de nuevo la pagina con el registro ya actualizado
          header("Location: modificar_usuario.php?id=" . $id);
    }
  }
?>
<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Modificar Usuario</title>
    <link rel="stylesheet" href="./css/foundation.css" />
    <script src="./js/vendor/modernizr.js"></script>
  </head>
  <body>
     
    <div class="large-10 columns">
        <ul class="right button-group">
          <li><a href="./usuarios.php" class="button radius tiny" style="background-color: #1A191A">Regresar</a></li>&nbsp;
          <li><a href="./cerrar_sesion.php" class="button radius tiny" style="background-color: #1A191A">Cerrar Sesión</a></li>
        </ul>
      </div>


    <div class="row">
 
      <div class="large-9 columns">
        <h2 style="font-weight: bold">Modificar Usuario</h2>
        <hr>
        <div class="section-container tabs" data-section>
          <section class="section">
            <div class="content" data-slug="panel1">
              <div class="row">
              </div>
              <form id="formu" method="post" name="formu">
                <input type="text" name="nombre" placeholder="Nombre" value="<?php echo $b['nombre'] ?>" required>
                <input type="text" name="usuario" placeholder="Usuario" value="<?php echo $b['usuario']?>" required>
                <input type="button" class="button radius tiny" style="background-color: green; color: white; margin-left: 642px" name="modificar" value="Modificar" onclick="a();">
              </form>

              <script type="text/javascript">
                  //funcion de javascript que obtiene las variables en la url
                  var f = document.getElementById("formu");
                  function getUrlVars() {
                      var vars = {};
                      var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
                          vars[key] = value;
                      });
                      return vars;
                  }
                  //se convoca a la funcion para obtener las variables de la url
                  var id = getUrlVars();
                  var id2 = ""+id["id"];
                  //se almacena la respuesta del usuario con el confirm
                  function a(){
                    //mensaje que pregunta si quiere modificar el registro
                    var c = confirm("¿Está seguro que desea modificar este usuario?");
                    if(c){
                      //hace que se realiza la carga de la informacion ingresada en las cajas de texto
                      f.submit();
                    }else{
                      //se recarga la pagina con los datos ya actualizados
                      location.href="modificar_usuario.php?id="+id2;
                    }
                  }
            </script>
          </div>
      </section>
  </div>
</div>
</div>
<?php require_once("footer.php"); ?>
</body>
</html>