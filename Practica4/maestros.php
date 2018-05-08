<?php
include_once('utilities.php');
//$user_access = [];
if(isset($user_access2)){
  $total_users = count($user_access2);
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Alumnos y Maestros</title>
  <link rel="stylesheet" href="./css/foundation.css" />
  <script src="./js/vendor/modernizr.js"></script>
</head>
<body>
<?php require_once('header.php'); ?>
<div class="row">
<div class="large-9 columns">
  <h3>Módulo de Maestros</h3>
  <p>Maestros existentes en el sistema</p>
  <a href="agregarmaestro.php" class="button" style="margin-left: 600px">Agregar</a>
  <div class="section-container tabs" data-section>
          <section class="section">
            <div class="content" data-slug="panel1">
              <div class="row">
              </div>
              <?php if(isset($total_users)){ ?>
              <table>
                <thead>
                  <tr>
                    <th width="200">ID</th>
                    <th width="250">Nombre</th>
                    <th width="250">Carrera</th>
                    <th width="250"></th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach( $user_access2 as $id => $user ){ ?>
                  <tr>
                    <td><?php echo $id ?></td>
                    <td><?php echo $user['nombre'] ?></td>
                    <td><?php echo $user['carrera'] ?></td>
                    <td><a href="./key2.php?id=<?php echo $id; ?>" class="button radius tiny secondary">Ver detalles</a></td>
                  </tr>
                  <?php } ?>
                  <tr>
                    <td colspan="4"><b>Total de registros: </b> <?php if(isset($total_users)){ echo $total_users; }?></td>
                  </tr>
                </tbody>
              </table>
              <?php }else{ ?>
              No hay registros
              <?php } ?>
            </div>
          </section>
        </div>
      </div>
    </div>
    </div>
<?php require_once('footer.php'); ?>
</body>
</html>