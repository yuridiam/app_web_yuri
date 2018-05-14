<?php 
	
	//se manda a llamar el archivo que tiene la conexion a la bd
	require_once("db/conexion_usuarios.php");
	
	//se inicializan las variables
	$usuarios=0;
	$tipos=0;
	$status=0;
	$accesos=0;
	$activos=0;
	$inactivos=0;

	//consulta para obtener el total de usuarios
	$sql = 'select count(*) as total_users from user';
	$stm = $pdo->prepare($sql);
	$stm->execute();
	$res = $stm->fetchAll();
	$usuarios = $res[0]['total_users'];

	//consulta para obtener el total de tipos de usuarios
	$sql = "select count(*) as total_types from user_type";
	$stm = $pdo->prepare($sql);
	$stm->execute();
	$res = $stm->fetchAll();
	$tipos = $res[0]['total_types'];

	//consulta para obtener el total de status que existen
	$sql = "select count(*) as total_status from status";
	$stm = $pdo->prepare($sql);
	$stm->execute();
	$res = $stm->fetchAll();
	$status = $res[0]['total_status'];

	//consulta para obtener el total de los accesos de los usuarios
	$sql = "select count(*) as total_access from user_log";
	$stm = $pdo->prepare($sql);
	$stm->execute();
	$res = $stm->fetchAll();
	$accesos = $res[0]['total_access'];

	//consulta para obtener el total de usuarios activos
	$sql = "select count(*) as total_active from user where status_id=1";
	$stm = $pdo->prepare($sql);
	$stm->execute();
	$res = $stm->fetchAll();
	$activos = $res[0]['total_active'];

	//consulta para obtener el total de usuarios inactivos
	$sql = "select count(*) as total_inactive from user where status_id=2";
	$stm = $pdo->prepare($sql);
	$stm->execute();
	$res = $stm->fetchAll();
	$inactivos = $res[0]['total_inactive'];
?>
<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Usuarios</title>
    <link rel="stylesheet" href="./css/foundation.css" />
    <script src="./js/vendor/modernizr.js"></script>
  </head>
  <body>
     
    <?php require_once("header.php"); ?>

    <div class="row">
 
      <div class="large-9 columns">
        <h2 style="font-weight: bold">Control de usuarios</h2>
        <hr>
        <div class="section-container tabs" data-section>
          <section class="section">
            <div class="content" data-slug="panel1">
              <div class="row">
              </div>
              <table>
                <thead>
                  <tr>
                    <th width="100">Usuarios</th>
                    <th width="100">Tipos</th>
                    <th width="100">Status</th>
                    <th width="100">Accesos</th>
                    <th width="150">Usuarios Activos</th>
                    <th width="150">Usuarios Inactivos</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><?php echo $usuarios; ?></td>
                    <td><?php echo $tipos; ?></td>
                    <td><?php echo $status; ?></td>
                    <td><?php echo $accesos; ?></td>
                    <td><?php echo $activos; ?></td>
                    <td><?php echo $inactivos; ?></td>
                  </tr>
                </tbody>
              </table><br>
              <h3 style="font-weight: bold">Tabla: user</h3>
              <table>
              	<?php
              		//consulta para traer todos los datos de la tabla user
              		$sql = "select * from user";
              		$stm = $pdo->prepare($sql);
              		$stm->execute();
              		$res = $stm->fetchAll();
              	?>
                <thead>
                  <tr>
                    <th width="50">Id</th>
                    <th width="100">Correo</th>
                    <th width="100">Contraseña</th>
                    <th width="100">Estado</th>
                    <th width="130">Tipo de usuario</th>
                  </tr>
                </thead>
                <tbody>
                	<?php
                		foreach ($res as $fila) {
                	?>
                  <tr>
                    <td><?php echo $fila["id"]; ?></td>
                    <td><?php echo $fila["email"]; ?></td>
                    <td><?php echo $fila["password"]; ?></td>
                    <td><?php echo $fila["status_id"]; ?></td>
                    <td><?php echo $fila["user_type_id"]; ?></td>
                  </tr>
                  <?php
                		}
                	?>
                </tbody>
              </table><br>
              <h3 style="font-weight: bold">Tabla: user_type</h3>
              <table>
              	<?php
              	//consulta para traer todos los datos de la tabla user_type
              		$sql = "select * from user_type";
              		$stm = $pdo->prepare($sql);
              		$stm->execute();
              		$res = $stm->fetchAll();
              	?>
                <thead>
                  <tr>
                    <th width="50">Id</th>
                    <th width="100">Nombre</th>
                  </tr>
                </thead>
                <tbody>
                	<?php
                		foreach ($res as $fila) {
                	?>
                  <tr>
                    <td><?php echo $fila["id"]; ?></td>
                    <td><?php echo $fila["name"]; ?></td>
                  </tr>
                  <?php
                		}
                	?>
                </tbody>
              </table><br>
              <h3 style="font-weight: bold">Tabla: status</h3>
              <table>
              	<?php
              		//consulta para traer todos los datos de la tabla status
              		$sql = "select * from status";
              		$stm = $pdo->prepare($sql);
              		$stm->execute();
              		$res = $stm->fetchAll();
              	?>
                <thead>
                  <tr>
                    <th width="50">Id</th>
                    <th width="100">Nombre</th>
                  </tr>
                </thead>
                <tbody>
                	<?php
                		foreach ($res as $fila) {
                	?>
                  <tr>
                    <td><?php echo $fila["id"]; ?></td>
                    <td><?php echo $fila["name"]; ?></td>
                  </tr>
                  <?php
                		}
                	?>
                </tbody>
              </table><br>
              <h3 style="font-weight: bold">Tabla: user_log</h3>
              <table>
              	<?php
              		//consulta para traer todos los datos de la tabla user_log
              		$sql = "select * from user_log";
              		$stm = $pdo->prepare($sql);
              		$stm->execute();
              		$res = $stm->fetchAll();
              	?>
                <thead>
                  <tr>
                    <th width="50">Id</th>
                    <th width="200">Fecha de inicio de sesión</th>
                    <th width="150">Id de usuario</th>
                  </tr>
                </thead>
                <tbody>
                	<?php
                		foreach ($res as $fila) {
                	?>
                  <tr>
                    <td><?php echo $fila["id"]; ?></td>
                    <td><?php echo $fila["date_logged_in"]; ?></td>
                    <td><?php echo $fila["user_id"]; ?></td>
                  </tr>
                  <?php
                		}
                	?>
                </tbody>
              </table>
            </div>
          </section>
        </div>
      </div>
    </div>
	<?php require_once('footer.php'); ?>
</body>
</html>