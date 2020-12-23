<?php include "../../connection/connection.php";
      include "../../functions/functions.php";
      include "../lib/lib.php";
      
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
	echo '<div class="alert alert-danger" role="alert">';
	echo "Usuario o Contraseña Incorrecta. Reintente Por Favor...";
	echo '<br>';
	echo "O no tiene permisos o no ha iniciado sesion...";
	echo "</div>";
	echo '<a href="../../logout.php"><br><br><button type="submit" class="btn btn-primary">Aceptar</button></a>';	
	die();
	}
	
		
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
      <div class="panel-body">
      <form action="main.php" method="POST">
      
      <li class="list-group-item" align="center"><a href="#" data-toggle="tooltip" data-placement="right" title="Ver Turnos Disponibles"><button type="submit" class="btn btn-default btn-sm" name="A"><img class="img-reponsive img-rounded" src="../../icons/actions/view-calendar-timeline.png" /> Turnos Disponibles</button></a></li>
      
      </from>
      </div>
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
      <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
      sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
      minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
      commodo consequat.</div>
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
      
      <li class="list-group-item"><a href="#" data-toggle="tooltip" data-placement="right" title="Cambiar mi Contraseña"><button type="submit" class="btn btn-default btn-sm" name="FA"><img class="img-reponsive img-rounded" src="../../icons/actions/view-refresh.png" /> Cambiar Password</button></a></li>
      
      <li class="list-group-item"><a href="#" data-toggle="tooltip" data-placement="right" title="Listado de Localidades"><button type="submit" class="btn btn-default btn-sm" name="FC"><img class="img-reponsive img-rounded" src="../../icons/apps/lokalize.png" /> Localidades</button></a></li>
      
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
        <a href="../../logout.php" data-toggle="tooltip" data-placement="right" title="Salir del Sistema"><button type="button" class="btn btn-default btn-sm"><img class="img-reponsive img-rounded" src="../../icons/actions/go-previous-view.png" /> Salir</button></a><hr>
        <form action="main.php" method="POST">
        <div class="alert alert-info">
        <button type="submit" name="mensajes" class="btn btn-primary btn-sm"><img src="../../icons/actions/mail-mark-unread-new.png"  class="img-reponsive img-rounded"> Mensajes Recibidos <span class="badge"><?php echo $count; ?></span></button>
        </div>
        </form>
      </div><hr>
      
      <div class="row">
        <div class="col-sm-3">
          <div class="well">
            <h4>Total Usuarios Registrados</h4>
            <p><span class="badge"><?php echo $cantidad; ?></span></p>
            <form action="main.php" method="POST">
            <button type="submit" class="btn btn-default btn-sm" name="FB"><img class="img-reponsive img-rounded" src="../../icons/actions/meeting-attending.png" /> Usuarios</button>
            </form>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="well">
            <h4>Turnos Gabinete Hoy</h4>
            <p><span class="badge"><?php echo $turnos; ?></span></p>
            <form action="main.php" method="POST">
            <button type="submit" class="btn btn-default btn-sm" name="BA"><img class="img-reponsive img-rounded" src="../../icons/actions/view-calendar-timeline.png" /> Turnos Gabinete</button>
            </form>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="well">
            <h4>Entrega Equipo Hoy</h4>
            <p>10 Million</p>
            <form action="main.php" method="POST">
            <button type="submit" class="btn btn-default btn-sm" name="CA"><img class="img-reponsive img-rounded" src="../../icons/actions/im-aim.png" /> Entregas</button>
            </form>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="well">
            <h4>Retiro Equipo Hoy</h4>
            <p>30%</p>
            <form action="main.php" method="POST">
            <button type="submit" class="btn btn-default btn-sm" name="CB"><img class="img-reponsive img-rounded" src="../../icons/status/task-reminder.png" /> Retiros</button>
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
      
      
        if(isset($_POST['BA'])){
            turnosGabinete($conn);
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
        mysqli_error($conn);
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
