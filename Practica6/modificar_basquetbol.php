<?php 
	//se manda a llamar el archivo que contiene todas las funciones necesarias
	require_once("funciones.php");
  $id = isset( $_GET['id'] ) ? $_GET['id'] : '';
  $r = search($id);
  $cont=0;
  //comprueba que las cajas hayn sido llenadas
  if(isset($_POST["dorso"])){
      $cont++;
  }
  if(isset($_POST["nombre"])){
      $cont++;
  }
  if(isset($_POST["pos"])){
      $cont++;
  }
  if(isset($_POST["carrera"])){
      $cont++;
  }
  if(isset($_POST["email"])){
      $cont++;
  }
  if($cont==5){
    //ejecuta la funcion de modificar el registro en los basquetbolistas
    $r = modify($id, 2, $_POST["dorso"],$_POST["nombre"],$_POST["pos"],$_POST["carrera"],$_POST["email"]);
    if($r){
      //genera un mensaje de exito
      echo "<script type='text/javascript'>
            alert('Basquetbolista modificado');
          </script>";
          //reedirecciona a la misma pagina con los registros ya actualizados
          header("Location: modificar_basquetbol.php?id=" . $id);
    }
  }
?>
<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Modificar basquetbolista</title>
    <link rel="stylesheet" href="./css/foundation.css" />
    <script src="./js/vendor/modernizr.js"></script>
  </head>
  <body>
     
    <?php require_once("header4.php"); ?>

    <div class="row">
 
      <div class="large-9 columns">
        <h2 style="font-weight: bold">Modificar basquetbolista</h2>
        <hr>
        <div class="section-container tabs" data-section>
          <section class="section">
            <div class="content" data-slug="panel1">
              <div class="row">
              </div>
              <form id="formu" method="post" name="formu">
                <input type="text" name="dorso" placeholder="Número de dorso" value="<?php echo $r['num_dorso'] ?>" required>
                <input type="text" name="nombre" placeholder="Nombre completo" value="<?php echo $r['nombre'] ?>" required>
                <input type="text" name="pos" placeholder="Posición" value="<?php echo $r['posicion'] ?>" required>
                <select name="carrera">
                  <?php 
                  //selecciona la carrera que esta registrada en la bd
                    if($r['id_carrera']==1){
                  ?>
                      <option value="1" selected="true">Ingeniería en Tecnologías de la Información</option>
                      <option value="2">Ingeniería en Mecatrónica</option>
                      <option value="3">Ingeniería en Tecnologías de Manufactura</option>
                      <option value="4">Ingeniería en Sistemas Automotrices</option>
                      <option value="5">Licenciatura en Pequeñas y Medianas Empresas</option>
                  <?php
                    }
                  ?>
                  <?php 
                    if($r['id_carrera']==2){
                  ?>
                      <option value="1">Ingeniería en Tecnologías de la Información</option>
                      <option value="2" selected="true">Ingeniería en Mecatrónica</option>
                      <option value="3">Ingeniería en Tecnologías de Manufactura</option>
                      <option value="4">Ingeniería en Sistemas Automotrices</option>
                      <option value="5">Licenciatura en Pequeñas y Medianas Empresas</option>
                  <?php
                    }
                  ?>
                  <?php 
                    if($r['id_carrera']==3){
                  ?>
                      <option value="1">Ingeniería en Tecnologías de la Información</option>
                      <option value="2">Ingeniería en Mecatrónica</option>
                      <option value="3" selected="true">Ingeniería en Tecnologías de Manufactura</option>
                      <option value="4">Ingeniería en Sistemas Automotrices</option>
                      <option value="5">Licenciatura en Pequeñas y Medianas Empresas</option>
                  <?php
                    }
                  ?>
                  <?php 
                    if($r['id_carrera']==4){
                  ?>
                      <option value="1">Ingeniería en Tecnologías de la Información</option>
                      <option value="2">Ingeniería en Mecatrónica</option>
                      <option value="3">Ingeniería en Tecnologías de Manufactura</option>
                      <option value="4" selected="true">Ingeniería en Sistemas Automotrices</option>
                      <option value="5">Licenciatura en Pequeñas y Medianas Empresas</option>
                  <?php
                    }
                  ?>
                  <?php 
                    if($r['id_carrera']==5){
                  ?>
                      <option value="1">Ingeniería en Tecnologías de la Información</option>
                      <option value="2">Ingeniería en Mecatrónica</option>
                      <option value="3">Ingeniería en Tecnologías de Manufactura</option>
                      <option value="4">Ingeniería en Sistemas Automotrices</option>
                      <option value="5" selected="true">Licenciatura en Pequeñas y Medianas Empresas</option>
                  <?php
                    }
                  ?>
                </select>
                <input type="email" name="email" placeholder="Correo electrónico" value="<?php echo $r['email'] ?>" required>
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
                  //se almacena la respuesta del usuario para confirmar su modificacion
                  function a(){
                    //mensaje que pregunta si desea eliminar el deportista
                    var c = confirm("¿Está seguro que desea modificar este basquetbolista?");
                    if(c){
                      //carga las cajas de texto y su información
                      f.submit();
                    }else{
                      //reedirecciona a la misma pagina con los datos ya actualizados
                      location.href="modificar_basquetbol.php?id="+id2;
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