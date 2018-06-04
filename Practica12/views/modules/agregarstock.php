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
              echo '<a href="index.php?action=stock&id='. $id . '"><button type="button" class="btn btn-tool">
                    <i class="fa fa-times"></i>
                    </button></a>';
          ?>
       </div>
    </div>
            </div>
            <div class="card-body">
            	<form method="post">
            		<input type="number" class="form-control" name="cantidad" placeholder="Cantidad a agregar" required>
                <input type="text" class="form-control" name="ref" placeholder="Referencia" required>
                <textarea class="form-control" name="nota" placeholder="Nota"></textarea><br>
                <button type="submit" class="btn btn-block btn-outline-success" name="agregar">Agregar</button>
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