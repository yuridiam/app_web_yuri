<?php
  //Se obtiene la variable id del url
  if(isset($_GET["id"])){
      $id = $_GET["id"];
  }
?>
<div class="content-wrapper" style="background-color: white"> 
      <div class="container-fluid">
<div class="card card-success card-outline">
            <div class="card-header">
              <h3 class="card-title">Agregar al stock</h3>
              <div class="card-tools">
       <div class="btn-group">
          <?php 
            //Se incluye la variable id en una url
              echo '<a href="index.php?action=stock&id='. $id . '&id_tienda='.$_GET["id_tienda"].'"><button type="button" class="btn btn-tool">
                    <i class="fa fa-times"></i>
                    </button></a>';
          ?>
       </div>
    </div>
            </div>
            <div class="card-body">
            	<form method="post">
            		<input type="number" class="form-control" name="cantidad" id="cantidad" placeholder="Cantidad a agregar">
                <input type="text" class="form-control" name="ref" id="ref" placeholder="Referencia">
                <textarea class="form-control" name="nota" placeholder="Nota"></textarea><br>
                <?php echo "<input type='hidden' class='form-control' id='c_contra' value='". $_SESSION["contra"] ."'>"; ?>
                <button type="submit" class="btn btn-block btn-outline-success" name="agregar" id="agregar" onclick="agregarS();">Agregar</button>
            	</form>
            </div>
        </div>
    </div>
</div>
<?php
  //Creacion del objeto y llamado a sus metodos
  $registrarS = new MvcController();
  $registrarS->agregarStockController();

?>