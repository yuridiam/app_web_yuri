<?php
require_once('db/database_utilities.php');
//se cargan los datos existentes en la bd
$usuarios = run_app();
//variable que contendra la cantidad de registros
$var=0;
?>
<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Control de Usuarios</title>
    <link rel="stylesheet" href="./css/foundation.css" />
    <script src="./js/vendor/modernizr.js"></script>
  </head>
  <body>
     
    <div class="row">
 
      <div class="large-9 columns">
        <h2 style="font-weight: bold">Control de usuarios</h2>
        <a href="agregar_usuarios.php" class="button radius tiny secondary" style="background-color: green; margin-left: 640px; color:white">Agregar</a>
          <p></p>
        <div class="section-container tabs" data-section>
          <section class="section">
            <div class="content" data-slug="panel1">
              <div class="row">
              </div>
              <?php if($usuarios){ ?>
              <table>
                <thead>
                  <tr>
                    <th width="100">ID</th>
                    <th width="250">Correo</th>
                    <th width="200">Contraseña</th>
                    <th width="260"></th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach( $usuarios as $user ){
                    global $var; 
                    //cuenta los registros en la bd
                    $var++;
                  ?>
                  <tr>
                    <td><?php echo $user["id"] ?></td>
                    <td><?php echo $user['email'] ?></td>
                    <td><?php echo $user['password'] ?></td>
                    <td><a href="detalles_usuarios.php?id=<?php echo $user['id']; ?>" class="button radius tiny secondary" style="background-color: blue; color:white">Detalles</a>&nbsp;<a href="eliminar_usuarios.php?id=<?php echo $user['id']; ?>" class="button radius tiny secondary" style="background-color: red; color:white" >Eliminar</a></td>
                  </tr>
                  <?php } ?>
                  <tr>
                    <td colspan="4"><b>Total de registros: </b> <?php echo $var; ?></td>
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
    

    <?php require_once('footer.php'); ?>