<?php
  //Se almacena la variable id de la url
  if(isset($_GET["id"])){
      $id = $_GET["id"];
  }
?>
<div class="content-wrapper" style="background-color: white"> 
      <div class="container-fluid">
<div class="card card-danger card-outline">
            <div class="card-header">
              <h3 class="card-title">Quitar del stock</h3>
              <div class="card-tools">
                  <div class="btn-group">
                    <?php 
                        //Se usa la variable id
                        echo '<a href="index.php?action=stock&id='. $id . '&id_tienda='.$_GET["id_tienda"].'"><button type="button" class="btn btn-tool">
                    <i class="fa fa-times"></i>
                    </button></a>';
                    ?>
                  </div>
            </div>
            </div>
            <div class="card-body">
            	<form method="post">
            		<input type="number" class="form-control" name="cantidad" id="cantidad" placeholder="Cantidad a eliminar">
                <input type="text" class="form-control" name="ref" id="ref" placeholder="Referencia">
                <textarea class="form-control" name="nota" placeholder="Nota"></textarea><br>
                <?php echo "<input type='hidden' class='form-control' id='c_contra' value='". $_SESSION["contra"] ."'>"; ?>
                <button type="submit" class="btn btn-block btn-outline-danger" id="agregar" name="agregar" onclick="quitarS();">Quitar</button>
            	</form>
            </div>
        </div>
    </div>
</div>
<?php
  //Creacion del objeto y llamado de sus objetos
  $registrarS = new MvcController();
  $registrarS->quitarStockController();

?>