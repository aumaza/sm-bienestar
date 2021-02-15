<?php include "../../connection/connection.php";
      include "../../functions/functions.php";
      include "../lib/lib_core.php";
      include "../lib/lib_productos.php";
      include "../lib/lib_alquiler_equipos.php";
      include "../lib/lib_turnos_gabinete.php";
      include "../lib/lib_localidades.php";
      
	session_start();
	$usuario = $_SESSION['usuario'];
	$password = $_SESSION['password'];
	$entorno = $_SESSION['entorno'];
	
	
	$sql = "select * from smb_usuarios where user = '$usuario' and password = '$password'";
	mysqli_select_db($conn,$dbase);
	$query = mysqli_query($conn,$sql);
	while($row = mysqli_fetch_array($query)){
	      $nombre = $row['nombre'];
	}
	
	
	
	if($usuario == null || $usuario == ''){
	echo '<!DOCTYPE html>
        <html lang="es">
        <head>
        <title>SMB - Bienestar</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="../../../img/favicon.png" />';
        skeleton();
        echo '</head><body>';
        echo '<br><div class="container">
                <div class="alert alert-danger" role="alert">';
        echo '<p align="center"><img src="../../icons/status/task-attempt.png"  class="img-reponsive img-rounded"> Su sesión a caducado. Por favor, inicie sesión nuevamente</p>';
        echo '<a href="../../logout.php"><hr><button type="buton" class="btn btn-default btn-block"><img src="../../icons/status/dialog-password.png"  class="img-reponsive img-rounded"> Iniciar</button></a>';	
        echo "</div></div>";
        die();
        echo '</body></html>';
	}
	
	  
	//obtenemos la Descripción de los modulos
	
       if($entorno == 'VP'){
            $descripcion = "Venta de Productos";
       }
       if($entorno == 'TG'){
            $descripcion = "Turnos Gabinete";
       }
       if($entorno == 'TE'){
            $descripcion = "Alquiler de Equipos";
       }
       if($entorno == 'VE'){
            $descripcion = "Venta de Equipos";
       }
       if($entorno == 'CA'){
            $descripcion = "Capacitación";
       }
       if($entorno == 'AD'){
            $descripcion = "Administración";
	}
	
	// obtenemos cantidad de usuarios registrados   
	$consulta = "select count(id) as cantidad from smb_usuarios";
	mysqli_select_db($conn,$dbase);
	$qry = mysqli_query($conn,$consulta);
	while($row = mysqli_fetch_array($qry)){
	      $cantidad = $row['cantidad'];
	}
	
	// obtenemos cantidad de turnos gabinete del dia de hoy
	$cons = "select count(id) as cantidad from smb_turnos_gabinete where f_turno = NOW()";
	mysqli_select_db($conn,$dbase);
	$retval = mysqli_query($conn,$cons);
	while($fila = mysqli_fetch_array($retval)){
        $turnos = $fila['cantidad'];
	}
	
	// obtenemos mensajes recibidos
	$consul = "select count(id) as count from smb_mensajes where fecha = curdate()";
	mysqli_select_db($conn,$dbase);
	$valor = mysqli_query($conn,$consul);
	while($dato = mysqli_fetch_array($valor)){
        $count = $dato['count'];
	}
	
	// obtenemos la cantidad de entregas de alquiler de equipos para el dia de la fecha
	$request = "select count(id) as cantidad from smb_turnos_equipos where f_turno = curdate()";
	mysqli_select_db($conn,$dbase);
	$return = mysqli_query($conn,$request);
	while($linea = mysqli_fetch_array($return)){
	  $cant = $linea['cantidad'];
	}
	
	
?>


<!DOCTYPE html>
<html lang="es">
<head>
  <title>Panel del Administrador</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="../../icons/categories/preferences-desktop.png" />
  <?php skeleton(); ?>
  
  <!-- Data Table Script -->
<script>
 $(document).ready(function(){
      $('#myTable').DataTable({
      "order": [[1, "asc"]],
      "responsive": true,
      "scrollY":        "300px",
        "scrollX":        true,
        "scrollCollapse": true,
        "paging":         true,
        "fixedColumns": true,
      "language":{
        "lengthMenu": "Mostrar _MENU_ registros por pagina",
        "info": "Mostrando pagina _PAGE_ de _PAGES_",
        "infoEmpty": "No hay registros disponibles",
        "infoFiltered": "(filtrada de _MAX_ registros)",
        "loadingRecords": "Cargando...",
        "processing":     "Procesando...",
        "search": "Buscar:",
        "zeroRecords":    "No se encontraron registros coincidentes",
        "paginate": {
          "next":       "Siguiente",
          "previous":   "Anterior"
        },
      }
    });

  });
  </script>
  <!-- END Data Table Script -->
  
  <style>
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 550px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      background-color: grey;
      height: 150%;
    }
        
    /* On small screens, set height to 'auto' for the grid */
    @media screen and (max-width: 767px) {
      .row.content {height: auto;} 
    }
    .avatar {
  vertical-align: middle;
  horizontal-align: right;
  width: 60px;
  height: 60px;
  border-radius: 60%;
}
  </style>
</head>
<body>

<nav class="navbar navbar-inverse visible-xs">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        </ul>
    </div>
  </div>
</nav>

<div class="container-fluid">
  <div class="row content"><br>
    <div class="col-sm-3 sidenav hidden-xs">
      <br><a href="main.php" data-toggle="tooltip" data-placement="right" title="Recargar Menú Principal"><img src="../../icons/status/meeting-chair.png" alt="Avatar" class="avatar" ></a> <strong>Bienvenido/a:</strong> <?php echo $nombre; ?></h4><hr>
      <div class="alert alert-success">
      <p align="center"><strong>Su Usuario es:</strong> <?php echo $usuario;?></p>
      </div>
      <hr>
      <ul class="nav nav-pills nav-stacked">
        
        <div class="panel-group" id="accordion">
 
 <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
        Módulo VP - Venta de Productos</a>
      </h4>
    </div>
    <div id="collapse1" class="panel-collapse collapse">
      <ul class="list-group">
      <form action="main.php" method="POST">
      
      <li class="list-group-item" align="center">
	<a href="#" data-toggle="tooltip" data-placement="right" title="Listado de Productos">
	  <button type="submit" class="btn btn-default btn-sm" name="AA">
	    <img class="img-reponsive img-rounded" src="../../icons/actions/feed-subscribe.png" /> Productos</button></a></li>
      
      <li class="list-group-item" align="center">
	<a href="#" data-toggle="tooltip" data-placement="right" title="Productos Pedidos">
	  <button type="submit" class="btn btn-default btn-sm" name="AB">
	    <img class="img-reponsive img-rounded" src="../../icons/actions/view-pim-notes.png" /> Pedidos</button></a></li>
      
      </form>
      </ul>
    </div>
  </div>
  
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
        Módulo TG - Turnos Gabinete</a>
      </h4>
    </div>    
    <div id="collapse2" class="panel-collapse collapse">
     <ul class="list-group">
      <form action="main.php" method="POST">
      
      <li class="list-group-item" align="center">
	<a href="#" data-toggle="tooltip" data-placement="right" title="Otorgar Turnos">
	  <button type="submit" class="btn btn-default btn-sm" name="BB">
	    <img class="img-reponsive img-rounded" src="../../icons/actions/view-calendar-day.png" /> Turnos</button></a></li>
      
      <li class="list-group-item" align="center">
	<a href="#" data-toggle="tooltip" data-placement="right" title="Análisis de Cobros">
	  <button type="submit" class="btn btn-default btn-sm" name="BC">
	    <img class="img-reponsive img-rounded" src="../../icons/places/folder-activities.png" /> Filtros</button></a></li>
      
      </form>
      </ul>
    </div>
  </div>
  
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
        Módulo TE - Turnos Alquiler Equipos</a>
      </h4>
    </div>
    <div id="collapse3" class="panel-collapse collapse">
      <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
      sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
      minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
      commodo consequat.</div>
    </div>
  </div>
  
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
        Módulo VE - Venta de Equipos</a>
      </h4>
    </div>
    <div id="collapse4" class="panel-collapse collapse">
      <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
      sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
      minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
      commodo consequat.</div>
    </div>
  </div>
  
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">
        Módulo CA - Capacitación</a>
      </h4>
    </div>
    <div id="collapse5" class="panel-collapse collapse">
      <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
      sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
      minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
      commodo consequat.</div>
    </div>
  </div>
  
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse6">
        Administración General</a>
      </h4>
    </div>
    <div id="collapse6" class="panel-collapse collapse">
      <ul class="list-group">
      <form action="main.php" method="POST">
      
      <li class="list-group-item">
	<a href="#" data-toggle="tooltip" data-placement="right" title="Cambiar mi Contraseña">
	  <button type="submit" class="btn btn-default btn-sm" name="FA">
	    <img class="img-reponsive img-rounded" src="../../icons/actions/view-refresh.png" /> Cambiar Password</button></a></li>
      
      <li class="list-group-item">
	<a href="#" data-toggle="tooltip" data-placement="right" title="Listado de Localidades">
	  <button type="submit" class="btn btn-default btn-sm" name="FC">
	    <img class="img-reponsive img-rounded" src="../../icons/apps/lokalize.png" /> Localidades</button></a></li>
	    
      <li class="list-group-item">
	<a href="#" data-toggle="tooltip" data-placement="right" title="Back up Base de Datos">
	  <button type="submit" class="btn btn-default btn-sm" name="FD">
	    <img class="img-reponsive img-rounded" src="../../icons/actions/svn-update.png" /> BackUp Base</button></a></li>
      
      </form>
      </ul>
    </div>
  </div>
  
</div>



      </ul><br>
    </div>
    
    
    <div class="col-sm-9">
      <div class="well">
        <img src="../../../img/logo.png" class="img-rounded" alt="Random Name" width="180" height="50"><h2> Panel de Administración</h2>
	  <p>Entorno de Administración de todos los Módulos del Sistema</p>
	    <a href="../../logout.php" data-toggle="tooltip" data-placement="right" title="Salir del Sistema">
	      <button type="button" class="btn btn-default btn-sm">
		<img class="img-reponsive img-rounded" src="../../icons/actions/go-previous-view.png" /> Salir</button></a><hr>
        <form action="main.php" method="POST">
	  <div class="alert alert-info">
	  <?php
	    if($count > 0){
	    
	    echo '<button type="submit" name="mensajes" class="btn btn-primary btn-sm">
		    <img src="../../icons/actions/mail-mark-unread-new.png"  class="img-reponsive img-rounded"> Mensajes Recibidos <span class="badge">' .$count. '</span></button>';
	  }else{
	    
	    echo '<button type="submit" name="mensajes" class="btn btn-primary btn-sm">
		    <img src="../../icons/actions/mail-mark-unread.png"  class="img-reponsive img-rounded"> Mensajes Recibidos <span class="badge">' .$count. '</span></button>';
	  
	  }
        ?>
        </div>
        </form>
      </div><hr>
      
      <div class="row">
        <div class="col-sm-3">
          <div class="well">
            <h4>Total Usuarios Registrados</h4>
            <p><span class="badge"><?php echo $cantidad; ?></span></p>
            <form action="main.php" method="POST">
	      <button type="submit" class="btn btn-default btn-sm" name="FB">
		<img class="img-reponsive img-rounded" src="../../icons/actions/meeting-attending.png" /> Usuarios</button>
            </form>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="well">
            <h4>Turnos Gabinete Hoy</h4>
            <p><span class="badge"><?php echo $turnos; ?></span></p>
            <form action="main.php" method="POST">
	      <button type="submit" class="btn btn-default btn-sm" name="BA">
		<img class="img-reponsive img-rounded" src="../../icons/actions/view-calendar-timeline.png" /> Turnos Gabinete</button>
            </form>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="well">
            <h4>Entrega Equipo Hoy</h4>
            <p><span class="badge"><?php echo $cant; ?></span></p>
            <form action="main.php" method="POST">
	      <button type="submit" class="btn btn-default btn-sm" name="CA">
		<img class="img-reponsive img-rounded" src="../../icons/actions/im-aim.png" /> Entregas</button>
            </form>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="well">
            <h4>Retiro Equipo Hoy</h4>
            <p><span class="badge"><?php echo $cant; ?></span></p>
            <form action="main.php" method="POST">
	      <button type="submit" class="btn btn-default btn-sm" name="CB">
		<img class="img-reponsive img-rounded" src="../../icons/status/task-reminder.png" /> Retiros</button>
            </form>
          </div>
        </div>
      </div><hr>
      
<!--  Inicio espacio funciones  -->
      <div class="container">
      <div class="row">
      <div class="col-sm-12">
      <?php
      
      if($conn){
        
        // seccion productos
        if(isset($_POST['AA'])){
            list_productos($conn);
        }
        if(isset($_POST['add_prod'])){
            $id = mysqli_real_escape_string($conn,$_POST['id']);
            formAddProducto();
        }
        if(isset($_POST['addProd'])){
            $cod_prod = mysqli_real_escape_string($conn,$_POST['cod_prod']);
            $descripcion = mysqli_real_escape_string($conn,$_POST['descripcion']);
            $marca = mysqli_real_escape_string($conn,$_POST['marca']);
            $precio = mysqli_real_escape_string($conn,$_POST['precio']);
            addProducto($cod_prod,$descripcion,$marca,$precio,$conn);
        }
        if(isset($_POST['edit_producto'])){
            $id = mysqli_real_escape_string($conn,$_POST['id']);
            formEditProducto($id,$conn);
        }
        if(isset($_POST['updateProd'])){
            $id = mysqli_real_escape_string($conn,$_POST['id']);
            $descripcion = mysqli_real_escape_string($conn,$_POST['descripcion']);
            $marca = mysqli_real_escape_string($conn,$_POST['marca']);
            $precio = mysqli_real_escape_string($conn,$_POST['precio']);
            updateProducto($id,$descripcion,$marca,$precio,$conn);
        }
        if(isset($_POST['eliminar_producto'])){
            $id = mysqli_real_escape_string($conn,$_POST['id']);
            formEliminarProducto($id,$conn);
        }
        if(isset($_POST['delete_prod'])){
            $id = mysqli_real_escape_string($conn,$_POST['id']);
            deleteProducto($id,$conn);
        }
        if(isset($_POST['add_picture'])){
            $id = mysqli_real_escape_string($conn,$_POST['id']);
            uploadPicture($id);        
        }
        if(isset($_POST['upload_pic'])){
            $id = mysqli_real_escape_string($conn,$_POST['id']);
            $file = basename($_FILES["file"]["name"]);
            uploadFilePicture($id,$file,$conn);
        }
        if(isset($_POST['AB'])){
            pedidos($conn);
        }
        // fin seccion productos
        // ========================================================================= //
        
        // seccion gabinete
        if(isset($_POST['BA'])){
            turnosGabinete($conn);
        }
        if(isset($_POST['BB'])){
	    gabineteTurno($conn);
        }
        if(isset($_POST['reservaTurno'])){
	   $id = mysqli_real_escape_string($conn,$_POST['id']);
	   reserva($id,$conn);
        }
        if(isset($_POST['BC'])){
	  filtros();
        }
        if(isset($_POST['d'])){
	  $fecha = mysqli_real_escape_string($conn,$_POST['fecha']);
	  $pago = mysqli_real_escape_string($conn,$_POST['pago']);
	  filtroDia($fecha,$pago,$conn);
	  }
	  if(isset($_POST['s'])){
	  $fecha = mysqli_real_escape_string($conn,$_POST['fecha']);
	  $pago = mysqli_real_escape_string($conn,$_POST['pago']);
	  filtroSemana($fecha,$pago,$conn);
	  }
	  if(isset($_POST['m'])){
	  $fecha = mysqli_real_escape_string($conn,$_POST['fecha']);
	  $pago = mysqli_real_escape_string($conn,$_POST['pago']);
	  filtroMes($fecha,$pago,$conn);
	  }
	  if(isset($_POST['a'])){
	  $fecha = mysqli_real_escape_string($conn,$_POST['fecha']);
	  $pago = mysqli_real_escape_string($conn,$_POST['pago']);
	  filtroAnio($fecha,$pago,$conn);
	  }
        
        
        if(isset($_POST['reservar'])){
	  $id = mysqli_real_escape_string($conn,$_POST['id']);
	  $especialidad = mysqli_real_escape_string($conn,$_POST['especialidad']);
	  $espacio = mysqli_real_escape_string($conn,$_POST['espacio']);
	  $nombre = mysqli_real_escape_string($conn,$_POST['cliente']);
	  $hora = mysqli_real_escape_string($conn,$_POST['hora']);
	  $fecha = mysqli_real_escape_string($conn,$_POST['f_turno']);
	  $estado = 'Ocupado';
	  $solicitud = 'Confirmado';
	  addReserva($id,$especialidad,$espacio,$nombre,$hora,$fecha,$estado,$solicitud,$conn);
        }
        // carga formulario de cambio estado solicitud turno
        if(isset($_POST['estado'])){
            $id = mysqli_real_escape_string($conn,$_POST['id']);
            formEstado($id,$conn);
        }
        if(isset($_POST['updateRequest'])){
            $id = mysqli_real_escape_string($conn,$_POST['id']);
            $solicitud = mysqli_real_escape_string($conn,$_POST['solicitud']);
            updateSolicitud($id,$solicitud,$conn);
        }
        if(isset($_POST['pay'])){
           $id = mysqli_real_escape_string($conn,$_POST['id']);
           pagos($id,$conn);        
        }
        if(isset($_POST['updatePagos'])){
           $id = mysqli_real_escape_string($conn,$_POST['id']);
           $pagos = mysqli_real_escape_string($conn,$_POST['pagos']);
           $importe = mysqli_real_escape_string($conn,$_POST['importe']);
           updatePagos($id,$pagos,$importe,$conn);
        }
        // fin formularios de cambio estado solicitud y pagos realizados turnos gabinete
        
        // Sección Equipos a entregar o retirar en el dia de la fecha
        if(isset($_POST['CA'])){
	  equiposEntrega($conn);  
        }
        if(isset($_POST['CB'])){
	  equiposRetiro($conn);  
        }
        // fin sección Equipos a entregar o retirar en el día de la fecha
        
        
        
        // sección administración de usuarios
        if(isset($_POST['FA'])){
            loadUserPass($conn,$nombre);
        }
        if(isset($_POST['FB'])){
            loadUsers($conn);
        }
        
        // =================================================================== //
        // seccion localidades
        if(isset($_POST['FC'])){
            localidades($conn);
        }
        if(isset($_POST['add_loc'])){
            formAddLocalidad();
        }
        if(isset($_POST['agregarLoc'])){
            $id = mysqli_real_escape_string($conn,$_POST['id']);
            $cod_loc = mysqli_real_escape_string($conn,$_POST['cod_loc']);
            $cod_loc = strtoupper($cod_loc);
            $localidad = mysqli_real_escape_string($conn,$_POST['localidad']);
            $localidad = strtoupper($localidad);
            $km = mysqli_real_escape_string($conn,$_POST['km']);
            addLocalidad($cod_loc,$localidad,$km,$conn);
        }
        if(isset($_POST['edit_loc'])){
            $id = mysqli_real_escape_string($conn,$_POST['id']);
            formEditLocalidad($id,$conn);
        }
        if(isset($_POST['updateLoc'])){
            $id = mysqli_real_escape_string($conn,$_POST['id']);
            $localidad = mysqli_real_escape_string($conn,$_POST['localidad']);
            $localidad = strtoupper($localidad);
            $km = mysqli_real_escape_string($conn,$_POST['km']);
            updateLocalidad($id,$localidad,$km,$conn);        
        }
        if(isset($_POST['update_val_km'])){
            formUpdateValorKm();
        }
        if(isset($_POST['updateV_km'])){
            $v_km = mysqli_real_escape_string($conn,$_POST['v_km']);
            updateValorKm($v_km,$conn);        
        }
        if(isset($_POST['del_loc'])){
            $id = mysqli_real_escape_string($conn,$_POST['id']);
            eliminarLoc($id,$conn);
        }
        if(isset($_POST['delete_loc'])){
            $id = mysqli_real_escape_string($conn,$_POST['id']);
            deleteLoc($id,$conn);
        }
        // fin seccion localidades
        // ========================================================================== //
        
        // back up de la base de datos
        if(isset($_POST['FD'])){
	  dumpMysql($conn);
        }
        
        if(isset($_POST['mensajes'])){
            getMensajes($conn);
        }
        
        // cambio de permisos de usuarios
        if(isset($_POST['allow'])){
            $id = mysqli_real_escape_string($conn,$_POST['id']);
            formEditRole($id,$conn);
        }
        if(isset($_POST['roles'])){
            $id = mysqli_real_escape_string($conn,$_POST['id']);
            $role = mysqli_real_escape_string($conn,$_POST['role']);
            cambiarPermisos($id,$role,$conn);
        }
      
      
      
      }else{
                echo "<br>";
			    echo '<div class="container">';
			    echo '<div class="alert alert-warning" role="alert">';
			    echo '<img class="img-reponsive img-rounded" src="../../icons/status/task-attempt.png" /> Hubo al Intentar Conectarse a la Base de Datos.  '  .mysqli_error($conn);
			    echo "</div>";
			    echo "</div>";
      }
      
      
      
      ?>
      </div>
      </div>
      </div>
<!--  Fin espacio funciones -->
                  
      </div>
    </div>
  </div>
</div>

</body>
</html>
