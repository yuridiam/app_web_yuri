<div class="modal modal-danger fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <?php echo '<a href="index.php?action=inventario&id_tienda='.$_GET["id_tienda"].'"><button type="button" class="close">';?>
          <span aria-hidden="true">&times;</span></button></a><br>
          <h5 align="center" style="font-weight: bold; color: gray">¿Está seguro que quiere eliminar este producto?</h5>
          <input type="password" name="contra" id="contra" placeholder="Ingrese su contraseña" required>
          <button type="button" class="btn btn-block btn-outline-danger" name="aceptar" onclick="eliminarPro();">Aceptar</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>