<?php
include_once('utilities.php');
$id = isset( $_GET['id'] ) ? $_GET['id'] : '';
if( !array_key_exists($id, $user_access1) )
{
  die('No existe dicho usuario');
}
?>
<!doctype html>
<html class="no-js" lang="en">
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
        <h3>Detalles</h3>
        <div class="section-container tabs" data-section>
          <section class="section">
            <div class="content" data-slug="panel1">
              <div class="row">
              </div>
              <ul class="pricing-table">
                <li class="title">Detalles del Usuario</li>
                <li class="description"><?php echo $user_access1[$id]['id'] ?></li>
                <li class="description"><?php echo $user_access1[$id]['nombre'] ?></li>
                <li class="description"><?php echo $user_access1[$id]['carrera'] ?></li>
                <li class="description"><?php echo $user_access1[$id]['correo'] ?></li>
                <li class="description"><?php echo $user_access1[$id]['telefono'] ?></li>
              </ul>
            </div>
          </section>
        </div>
      </div>
    </div>
     
    <?php require_once('footer.php'); ?>