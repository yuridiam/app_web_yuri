<div class="content-wrapper" style="background-color: white"> 
      <div class="container-fluid">
<div class="card card-success card-outline">
            <div class="card-header">
              <h3 class="card-title">Nueva Categoría</h3>
              <div class="card-tools">
                  <div class="btn-group">
                    <?php echo "<a href='index.php?action=categorias&id_tienda=".$_GET["id_tienda"]."'><button type='button' class='btn btn-tool'><i class='fa fa-times'></i></button></a>";?>
                  </div>
            </div>
            </div>
            <div class="card-body">
            	<form method="post">
            		<input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre de la categoría">
                <textarea class="form-control" name="desc" id="desc" placeholder="Descripción del producto" required></textarea><br>
                <button type="submit" class="btn btn-block btn-outline-success" id="agregar" name="agregar" onclick="regCat();">Registrar</button>
            	</form>
            </div>
        </div>
    </div>
</div>
<?php
  //Creacion del objeto y llamado de sus objetos
  $registrarCat = new MvcController();
  $registrarCat->registrarCategoriaController();

?>