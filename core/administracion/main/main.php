<?php include "../../connection/connection.php";
      include "../../functions/functions.php";
      include "../lib/lib_core.php";
      include "../lib/lib_productos.php";
      include "../lib/lib_alquiler_equipos.php";
      include "../lib/lib_turnos_gabinete.php";
      include "../lib/lib_localidades.php";
      include "../lib/lib_mensajes_modulos.php";
      include "../lib_equipos/lib_equipos.php";
      
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
        echo '<p align="center">
		<img src="../../icons/status/task-attempt.png"  class="img-reponsive img-rounded"> 
		  Su sesión a caducado. Por favor, inicie sesión nuevamente</p>';
        echo '<a href="../../logout.php"><hr>
		<button type="buton" class="btn btn-default btn-block">
		  <img src="../../icons/status/dialog-password.png"  class="img-reponsive img-rounded"> Iniciar</button></a>';	
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
	$cons = "select count(id) as cantidad from smb_turnos_gabinete where f_turno = curdate() and estado = 'Ocupado'";
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
      
      <li class="list-group-item" align="left">
	  <button type="submit" class="btn btn-default btn-xs btn-block" name="AA" data-toggle="tooltip" data-placement="right" title="Listado de Productos">
	    <img class="img-reponsive img-rounded" src="../../icons/actions/feed-subscribe.png" /> Productos</button>
     </li>
      
      <li class="list-group-item" align="left">
        <button type="submit" class="btn btn-default btn-xs btn-block" name="AB" data-toggle="tooltip" data-placement="right" title="Productos Pedidos">
	    <img class="img-reponsive img-rounded" src="../../icons/actions/view-pim-notes.png" /> Pedidos</button>
     </li>
	    
    <li class="list-group-item" align="left">
	<button type="submit" class="btn btn-default btn-xs btn-block" name="AC" data-toggle="tooltip" data-placement="right" title="Análisis de Cobros">
	<img class="img-reponsive img-rounded" src="../../icons/places/folder-activities.png" /> Filtros</button>
	</li>
      
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
        <button type="submit" class="btn btn-default btn-xs btn-block" name="BB" data-toggle="tooltip" data-placement="right" title="Otorgar Turnos">
      <img class="img-reponsive img-rounded" src="../../icons/actions/view-calendar-day.png" /> Turnos</button>
      </li>
      
      <li class="list-group-item" align="center">
	  <button type="submit" class="btn btn-default btn-xs btn-block" name="BC" data-toggle="tooltip" data-placement="right" title="Análisis de Cobros">
	  <img class="img-reponsive img-rounded" src="../../icons/places/folder-activities.png" /> Filtros</button>
	  </li>
      
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
     	<ul class="list-group">
	  <form action="main.php" method="POST">
	    
	    <li class="list-group-item" align="center">
        <button type="submit" class="btn btn-default btn-xs btn-block" name="CC" data-toggle="tooltip" data-placement="right" title="Listado de Turnos Equipos Solicitados">
		<img class="img-reponsive img-rounded" src="../../icons/actions/view-calendar-day.png" /> Turnos Equipos</button>
		</li>
	    
	    <li class="list-group-item" align="center">
	    <button type="submit" class="btn btn-default btn-xs btn-block" name="CD" data-toggle="tooltip" data-placement="right" title="Análisis de Cobros">
		<img class="img-reponsive img-rounded" src="../../icons/places/folder-activities.png" /> Filtros</button>
		</li>
	    
	  </form>
	</ul>
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
      <div class="panel-body">
	<img class="img-reponsive img-rounded" src="../../icons/categories/preferences-system.png" /> En desarrollo
      </div>
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
      <div class="panel-body">
	<img class="img-reponsive img-rounded" src="../../icons/categories/preferences-system.png" /> En desarrollo
      </div>
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
	  <button type="submit" class="btn btn-default btn-xs btn-block" name="FA" data-toggle="tooltip" data-placement="right" title="Cambiar mi Contraseña">
	  <img class="img-reponsive img-rounded" src="../../icons/actions/view-refresh.png" /> Cambiar Password</button>
	  </li>
	    
	  <li class="list-group-item">
	  <button type="submit" class="btn btn-default btn-xs btn-block" name="new_user" data-toggle="tooltip" data-placement="right" title="Alta de Nuevo Usuario / Cliente">
	  <img class="img-reponsive img-rounded" src="../../icons/actions/user-group-new.png" /> Alta Clientes</button>
	  </li>
	  
	  <li class="list-group-item">
	  <button type="submit" class="btn btn-default btn-xs btn-block" name="alta_equipos" data-toggle="tooltip" data-placement="right" title="Alta de Nuevo Equipo">
	  <img class="img-reponsive img-rounded" src="../../icons/actions/list-add.png" /> Alta Equipos</button>
	  </li>
      
      <li class="list-group-item">
	  <button type="submit" class="btn btn-default btn-xs btn-block" name="FC" data-toggle="tooltip" data-placement="right" title="Listado de Localidades">
	  <img class="img-reponsive img-rounded" src="../../icons/apps/lokalize.png" /> Localidades</button>
	  </li>
	    
      <li class="list-group-item">
	  <button type="submit" class="btn btn-default btn-xs btn-block" name="FD" data-toggle="tooltip" data-placement="right" title="Back up Base de Datos">
      <img class="img-reponsive img-rounded" src="../../icons/actions/svn-update.png" /> BackUp Base</button>
      </li>
	    
      <li class="list-group-item">
	  <button type="submit" class="btn btn-default btn-xs btn-block" name="mensajes_informativos" data-toggle="tooltip" data-placement="right" title="Mensajes Informativos para Espacio de Usuario">
	  <img class="img-reponsive img-rounded" src="../../icons/actions/help-about.png" /> Mensajes Informativos</button>
	  </li>
      
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
        if(isset($_POST['sail_producto'])){
            $id = mysqli_real_escape_string($conn,$_POST['id']);
            formPedido($id,$conn);
        }
        if(isset($_POST['venta'])){
            $id = mysqli_real_escape_string($conn,$_POST['id']);
            $nombre = mysqli_real_escape_string($conn,$_POST['cliente']);
            newPedidoProducto($id,$nombre,$conn);
        }
        if(isset($_POST['request_producto'])){
            $cod_prod = mysqli_real_escape_string($conn,$_POST['cod_prod']);
            $marca = mysqli_real_escape_string($conn,$_POST['marca']);
            $descripcion = mysqli_real_escape_string($conn,$_POST['descripcion']);
            $precio = mysqli_real_escape_string($conn,$_POST['precio']);
            $cliente = mysqli_real_escape_string($conn,$_POST['cliente']);
            $cel = mysqli_real_escape_string($conn,$_POST['cel']);
            $direccion = mysqli_real_escape_string($conn,$_POST['direccion']);
            $email = mysqli_real_escape_string($conn,$_POST['email']);
            $cantidad = mysqli_real_escape_string($conn,$_POST['cantidad']);
            $pago = mysqli_real_escape_string($conn,$_POST['pago']);
            endPedido($cod_prod,$marca,$descripcion,$precio,$cliente,$cel,$direccion,$email,$cantidad,$pago);
        }
        if(isset($_POST['end_pedido'])){
            $cod_prod = mysqli_real_escape_string($conn,$_POST['cod_prod']);
            $marca = mysqli_real_escape_string($conn,$_POST['marca']);
            $descripcion = mysqli_real_escape_string($conn,$_POST['descripcion']);
            $precio = mysqli_real_escape_string($conn,$_POST['precio']);
            $cliente = mysqli_real_escape_string($conn,$_POST['cliente']);
            $cel = mysqli_real_escape_string($conn,$_POST['cel']);
            $direccion = mysqli_real_escape_string($conn,$_POST['direccion']);
            $email = mysqli_real_escape_string($conn,$_POST['email']);
            $cantidad = mysqli_real_escape_string($conn,$_POST['cantidad']);
            $pago = mysqli_real_escape_string($conn,$_POST['pago']);
            $importe = mysqli_real_escape_string($conn,$_POST['importe']);
            $estado = mysqli_real_escape_string($conn,$_POST['estado']);
            cerrarPedido($cod_prod,$marca,$descripcion,$precio,$cliente,$cel,$direccion,$email,$cantidad,$pago,$importe,$estado,$conn);
        
        }
        if(isset($_POST['AB'])){
            pedidos($conn);
        }
        if(isset($_POST['mod_estado'])){
            $id = mysqli_real_escape_string($conn,$_POST['id']);
            cambiarEstado($id,$conn);
        }
        if(isset($_POST['update_estado_prod'])){
            $id = mysqli_real_escape_string($conn,$_POST['id']);
            $estado = mysqli_real_escape_string($conn,$_POST['state']);
            actualizarState($id,$estado,$conn);        
        }
        if(isset($_POST['AC'])){
            filtrosProductos();
        }
        if(isset($_POST['d_productos'])){
            $fecha = mysqli_real_escape_string($conn,$_POST['fecha']);
            $pago = mysqli_real_escape_string($conn,$_POST['pago']);
            filtroDiaProductos($fecha,$pago,$conn);
        }
        if(isset($_POST['s_productos'])){
            $fecha = mysqli_real_escape_string($conn,$_POST['fecha']);
            $pago = mysqli_real_escape_string($conn,$_POST['pago']);
            filtroSemanaProductos($fecha,$pago,$conn);
        }
        if(isset($_POST['m_productos'])){
            $fecha = mysqli_real_escape_string($conn,$_POST['fecha']);
            $pago = mysqli_real_escape_string($conn,$_POST['pago']);
            filtroMesProductos($fecha,$pago,$conn);
        }
        if(isset($_POST['a_productos'])){
            $fecha = mysqli_real_escape_string($conn,$_POST['fecha']);
            $pago = mysqli_real_escape_string($conn,$_POST['pago']);
            filtroAnioProductos($fecha,$pago,$conn);
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
        if(isset($_POST['cambiar_estado']) || isset($_POST['change_estado_tg'])){
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
        if(isset($_POST['enable_turno'])){
            formEnableDisableTurnos();        
        }
        if(isset($_POST['enable_disable_fecha'])){
            $fecha_desde = mysqli_real_escape_string($conn,$_POST['fecha_desde']);
            $fecha_hasta = mysqli_real_escape_string($conn,$_POST['fecha_hasta']);
            $accion = mysqli_real_escape_string($conn,$_POST['accion']);
            enableDisableByFecha($fecha_desde,$fecha_hasta,$accion,$conn);
        }
        if(isset($_POST['enable_disable_fecha_hora'])){
            $fecha_desde = mysqli_real_escape_string($conn,$_POST['fecha_desde']);
            $fecha_hasta = mysqli_real_escape_string($conn,$_POST['fecha_hasta']);
            $hora_desde = mysqli_real_escape_string($conn,$_POST['hora_desde']);
            $hora_hasta = mysqli_real_escape_string($conn,$_POST['hora_hasta']);
            $accion = mysqli_real_escape_string($conn,$_POST['accion']);
            enableDisableByFechaHora($fecha_desde,$fecha_hasta,$hora_desde,$hora_hasta,$accion,$conn);
        
        }
        // fin formularios de cambio estado solicitud y pagos realizados turnos gabinete
        // ================================================================================== // 
        
        // Sección Alquiler de equipos
        // Sección Equipos a entregar o retirar en el dia de la fecha
        if(isset($_POST['CA'])){
            equiposEntrega($conn);  
        }
        if(isset($_POST['CB'])){
            equiposRetiro($conn);  
        }
        // fin sección Equipos a entregar o retirar en el día de la fecha
        
        if(isset($_POST['CC'])){
            equiposTurnos($conn);
        }
        if(isset($_POST['estado_solicitud'])){
	  $id = mysqli_real_escape_string($conn,$_POST['id']);
	  formEstadoSolicitud($id,$conn);
        }
        if(isset($_POST['updateSolicitud'])){
	  $id = mysqli_real_escape_string($conn,$_POST['id']);
	  $solicitud = mysqli_real_escape_string($conn,$_POST['solicitud_equipo']);
	  updateSolicitudEquipo($id,$solicitud,$conn);  
        }
        if(isset($_POST['estado_pagos'])){
	  $id = mysqli_real_escape_string($conn,$_POST['id']);
	  cambiarEstadoPago($id,$conn);
        }
        if(isset($_POST['update_estado_equi'])){
	  $id = mysqli_real_escape_string($conn,$_POST['id']);
	  $estado = mysqli_real_escape_string($conn,$_POST['state']);
	  actualizarEstadoPagos($id,$estado,$conn);
        }
        if(isset($_POST['CD'])){
	  filtrosEquipos();
        }
        if(isset($_POST['d_equipo'])){
	   $fecha = mysqli_real_escape_string($conn,$_POST['fecha']);
           $pago = mysqli_real_escape_string($conn,$_POST['pago']);
           filtroDiaEquipos($fecha,$pago,$conn);
        }
        if(isset($_POST['s_equipo'])){
	   $fecha = mysqli_real_escape_string($conn,$_POST['fecha']);
           $pago = mysqli_real_escape_string($conn,$_POST['pago']);
           filtroSemanaEquipos($fecha,$pago,$conn);
        }
        if(isset($_POST['m_equipo'])){
	   $fecha = mysqli_real_escape_string($conn,$_POST['fecha']);
           $pago = mysqli_real_escape_string($conn,$_POST['pago']);
           filtroMesEquipos($fecha,$pago,$conn);
        }
        if(isset($_POST['a_equipo'])){
	   $fecha = mysqli_real_escape_string($conn,$_POST['fecha']);
           $pago = mysqli_real_escape_string($conn,$_POST['pago']);
           filtroAnioEquipos($fecha,$pago,$conn);
        }
        // fin sección alquiler de equipos
        // ================================================================================== //
        
        
        
        // sección administración de usuarios
        if(isset($_POST['new_user'])){
            formNewCliente();
        }
        if(isset($_POST['add_cliente'])){
            $nombre = mysqli_real_escape_string($conn,$_POST['nombre']);
            $dni = mysqli_real_escape_string($conn,$_POST['dni']);
            $direccion = mysqli_real_escape_string($conn,$_POST['direccion']);
            $direccion1 = mysqli_real_escape_string($conn,$_POST['direccion1']);
            $direccion2 = mysqli_real_escape_string($conn,$_POST['direccion2']);
            $tel = mysqli_real_escape_string($conn,$_POST['tel']);
            $movil = mysqli_real_escape_string($conn,$_POST['movil']);
            $email = mysqli_real_escape_string($conn,$_POST['email']);
            $password1 = mysqli_real_escape_string($conn,$_POST['password1']);
            $password2 = mysqli_real_escape_string($conn,$_POST['password2']);
            $entorno = mysqli_real_escape_string($conn,$_POST['entorno']);
            $role = 1;
            checkPassword($entorno,$nombre,$dni,$direccion,$direccion1,$direccion2,$tel,$movil,$email,$password1,$password2,$role,$conn);
        }
        
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
        
        // ========================================================================= //
        // SECCION MENSAJES INFORMATIVOS //
        
        if(isset($_POST['mensajes_informativos'])){
            formMensajesInformativos();
        }
        if(isset($_POST['i_mensajes'])){
           $imensages = mysqli_real_escape_string($conn,$_POST['info_mensajes']);
           
           if($imensages == 'i_gabinete'){
                getMensajesInfoGabinete($conn);
           }
           if($imensages == 'i_equipos'){
                getMensajesInfoEquipos($conn);
           }
           if($imensages == 'i_productos'){
                getMensajesInfoProductos($conn);
           }
        }
        
        // FORMULARIOS DE EDICION DE MENSAJES
        
        if(isset($_POST['edit_imensage_aequipos'])){
           $id = mysqli_real_escape_string($conn,$_POST['id']);
           formEditMensajesAEquipos($id,$conn);
        }
        if(isset($_POST['edit_imensage_gabinete'])){
           $id = mysqli_real_escape_string($conn,$_POST['id']);
           formEditMensajesGabinete($id,$conn);
        }
        if(isset($_POST['edit_imensage_productos'])){
           $id = mysqli_real_escape_string($conn,$_POST['id']);
           formEditMensajesProductos($id,$conn);
        }
        
        // PERSISTENCIA DE ACTUALIZACION DE MENSAJES
        
        if(isset($_POST['update_mensajes_gabinete'])){
           $id = mysqli_real_escape_string($conn,$_POST['id']);
           $mensaje = mysqli_real_escape_string($conn,$_POST['mensaje_gabinete']);
           updateMensajeGabinete($id,$mensaje,$conn);
        }
        if(isset($_POST['update_mensajes_aequipos'])){
           $id = mysqli_real_escape_string($conn,$_POST['id']);
           $mensaje = mysqli_real_escape_string($conn,$_POST['mensaje_aequipos']);
           updateMensajeAEquipos($id,$mensaje,$conn);
        }
        if(isset($_POST['update_mensajes_productos'])){
           $id = mysqli_real_escape_string($conn,$_POST['id']);
           $mensaje = mysqli_real_escape_string($conn,$_POST['mensaje_productos']);
           updateMensajeProductos($id,$mensaje,$conn);
        }
        
        // FORMULARIOS PARA NUEVOS MENSAJES
        
        if(isset($_POST['add_imensage_gabinete'])){
            formNewMensajesGabinete();
        }
        if(isset($_POST['add_imensage_aequipos'])){
            formNewMensajesAEquipos(); 
        }
        if(isset($_POST['add_imensage_productos'])){
            formNewMensajesProductos(); 
        }
        
        // PERSISTENCIA DE NUEVOS MENSAJES
        
        if(isset($_POST['new_mensajes_gabinete'])){
           $mensaje = mysqli_real_escape_string($conn,$_POST['mensaje_gabinete']);
            addMensajeGabinete($mensaje,$conn); 
        }
        if(isset($_POST['new_mensajes_aequipos'])){
            $mensaje = mysqli_real_escape_string($conn,$_POST['mensaje_equipos']);
            addMensajeAEquipos($mensaje,$conn);
        }
        if(isset($_POST['new_mensajes_productos'])){
            $mensaje = mysqli_real_escape_string($conn,$_POST['mensaje_productos']);
            addMensajeProductos($mensaje,$conn);
        }
        
        // FORMULARIOS DE BORRADO DE MENSAJES
        
        if(isset($_POST['del_imensage_gabinete'])){
            $id = mysqli_real_escape_string($conn,$_POST['id']);
            formEliminarMensajeGabinete($id,$conn);
        }
        if(isset($_POST['del_imensage_aequipos'])){
            $id = mysqli_real_escape_string($conn,$_POST['id']);
            formEliminarMensajeAEquipos($id,$conn);
        }
        if(isset($_POST['del_imensage_productos'])){
            $id = mysqli_real_escape_string($conn,$_POST['id']);
            formEliminarMensajeProductos($id,$conn);
        }
        
        // PERSISTENCIA DE BORRADO EN MENSAJES
        
        if(isset($_POST['delete_mensaje_gabinete'])){
            $id = mysqli_real_escape_string($conn,$_POST['id']);
            deleteMensajeGabinete($id,$conn);
        }
        if(isset($_POST['delete_mensaje_aequipos'])){
            $id = mysqli_real_escape_string($conn,$_POST['id']);
            deleteMensajeAEquipos($id,$conn);
        }
        if(isset($_POST['delete_mensaje_productos'])){
            $id = mysqli_real_escape_string($conn,$_POST['id']);
            deleteMensajeProductos($id,$conn);
        }
        
        
        // ========================================================================= //
        // FIN SECCION MENSAJES INFORMATIVOS //
        
        
        // ========================================================================= //
        // SECCION ADMINISTRACION DE EQUIPOS // 
        if(isset($_POST['alta_equipos'])){
            equipos($conn);
        }
        if(isset($_POST['add_equipo'])){
            formAltaEquipos();
        }
        if(isset($_POST['agregarEquipo'])){
            $cod_equipo = mysqli_real_escape_string($conn,$_POST['cod_equipo']);
            $tipo_equipo = mysqli_real_escape_string($conn,$_POST['tipo_equipo']);
            $marca_equipo = mysqli_real_escape_string($conn,$_POST['marca_equipo']);
            $modelo_equipo = mysqli_real_escape_string($conn,$_POST['modelo_equipo']);
            $nro_serie = mysqli_real_escape_string($conn,$_POST['nro_serie']);
            addNuevoEquipo($cod_equipo,$tipo_equipo,$marca_equipo,$modelo_equipo,$nro_serie,$conn);
        }
        if(isset($_POST['del_equipo'])){
            $id = mysqli_real_escape_string($conn,$_POST['id']);
            eliminarEquipo($id,$conn);
        }
        if(isset($_POST['delete_equipo'])){
            $id = mysqli_real_escape_string($conn,$_POST['id']);
            deleteEquipo($id,$conn);
        }
        if(isset($_POST['edit_equipo'])){
            $id = mysqli_real_escape_string($conn,$_POST['id']);
            formEditarEquipos($id,$conn);
        }
        if(isset($_POST['updateEquipo'])){
            $id = mysqli_real_escape_string($conn,$_POST['id']);
            $cod_equipo = mysqli_real_escape_string($conn,$_POST['cod_equipo']);
            $tipo_equipo = mysqli_real_escape_string($conn,$_POST['tipo_equipo']);
            $marca_equipo = mysqli_real_escape_string($conn,$_POST['marca_equipo']);
            $modelo_equipo = mysqli_real_escape_string($conn,$_POST['modelo_equipo']);
            $nro_serie = mysqli_real_escape_string($conn,$_POST['nro_serie']);
            updateEquipo($id,$cod_equipo,$tipo_equipo,$marca_equipo,$modelo_equipo,$nro_serie,$conn);
        }
        
        // ========================================================================= //
        // FIN SECCION ADMINISTRACION DE EQUIPOS // 
      
      
      
      }else{
                echo "<br>";
		echo '<div class="container">';
		echo '<div class="alert alert-warning" role="alert">';
		echo '<img class="img-reponsive img-rounded" src="../../icons/status/task-attempt.png" /> 
			Hubo al Intentar Conectarse a la Base de Datos.  '  .mysqli_error($conn);
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
