<?php include "../../connection/connection.php";
      include "../../functions/functions.php";
      include "../lib/lib_equipos.php";
      
	session_start();
	$usuario = $_SESSION['usuario'];
	$password = $_SESSION['password'];
	$entorno = $_SESSION['entorno'];
	
	$sql = "select * from smb_usuarios where user = '$usuario' and password = '$password'";
	mysqli_select_db($conn,'smb_bienestar');
	$query = mysqli_query($conn,$sql);
	while($row = mysqli_fetch_array($query)){
	      $nombre = $row['nombre'];
	}
	
	$consulta = "select * from smb_clientes where nombre = '$nombre'";
	mysqli_select_db($conn,'smb_bienestar');
	$retval = mysqli_query($conn,$consulta);
	while($row = mysqli_fetch_array($retval)){
	      $avatar = $row['avatar'];
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
	
	$qry = "select * from smb_info_aequipos";
	mysqli_select_db($conn,'smb_bienestar');
	$resp = mysqli_query($conn,$qry);
	while($fila = mysqli_fetch_array($resp)){
            $mensaje = $fila['mensaje'];
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
	
	
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <title>SM Bienestar - Alquiler de Equipos</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="../../icons/devices/printer-laser.png" />
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
    /* Set height of the grid so .sidenav can be 100% (adjust if needed) */
    .row.content {height: 1500px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      background-color: #f1f1f1;
      height: 100%;
    }
    
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height: auto;} 
    }
    .panel-footer.panel-custom {
    background: grey;
    color: white;
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

<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-3 sidenav">
    <hr><div class="alert alert-success">
      <br><h4 align="left"><img src="<?php echo $avatar; ?>" alt="Avatar" class="avatar" > <strong>Bienvenido/a:</strong> <?php echo $nombre; ?></h4>
      <p><strong>Su Usuario es:</strong> <?php echo $usuario;?></p>
      </div><hr>
      
      <p align="center"><img class="img-reponsive img-rounded" src="../../icons/actions/go-down.png" /> 
        <strong>Para Comenzar haz click sobre Menú</strong></p><hr>
      
       <div class="panel-group">
        <div class="panel panel-success">
            <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" href="#collapse1" data-toggle="tooltip" data-placement="right" title="Menú Principal - Desplegame!"><img class="img-reponsive img-rounded" src="../../icons/categories/preferences-desktop-peripherals.png" /> Menú</a>
            </h4>
            </div>
            
            <div id="collapse1" class="panel-collapse collapse">
            <ul class="list-group">
            <form action="main.php" method="POST">
                
                <li class="list-group-item" align="center"><a href="#" data-toggle="tooltip" data-placement="right" title="Solicitar Turno de Alquiler de Equipo"><button type="submit" class="btn btn-default btn-sm" name="A"><img class="img-reponsive img-rounded" src="../../icons/actions/view-calendar-timeline.png" /> Solicitar Turno</button></a></li>
                
                <li class="list-group-item" align="center"><a href="#" data-toggle="tooltip" data-placement="right" title="Ver Mis Turnos"><button type="submit" class="btn btn-default btn-sm" name="B"><img class="img-reponsive img-rounded" src="../../icons/actions/documentation.png" /> Turnos Reservados</button></a></li>
                
                <li class="list-group-item" align="center"><a href="#" data-toggle="tooltip" data-placement="right" title="Editar Datos Personales"><button type="submit" class="btn btn-default btn-sm" name="C"><img class="img-reponsive img-rounded" src="../../icons/actions/user-group-properties.png" /> Datos Personales</button></a></li>
                
                <li class="list-group-item" align="center"><a href="#" data-toggle="tooltip" data-placement="right" title="Cambiar mi Contraseña"><button type="submit" class="btn btn-default btn-sm" name="D"><img class="img-reponsive img-rounded" src="../../icons/actions/view-refresh.png" /> Cambiar Password</button></a></li>
                
<!--                 <li class="list-group-item"><a href="#" data-toggle="tooltip" data-placement="right" title="Cambiar Avatar de Usuario"><button type="submit" class="btn btn-default btn-sm" name="E"><img class="img-reponsive img-rounded" src="../../icons/actions/view-media-artist.png" /> Cambiar Avatar</button></a></li> -->
                
                <li class="list-group-item" align="center"><a href="#" data-toggle="tooltip" data-placement="right" title="Susbribirse a otro Módulo"><button type="submit" class="btn btn-default btn-sm" name="F"><img class="img-reponsive img-rounded" src="../../icons/apps/kcmdf.png" /> Agregar Módulo</button></a></li>
            <form>
            </ul>
            <div class="panel-footer panel-custom">
            <a href="../../logout.php" data-toggle="tooltip" data-placement="right" title="Salir del Sistema"><button type="button" class="btn btn-default btn-sm"><img class="img-reponsive img-rounded" src="../../icons/actions/go-previous-view.png" /> Salir</button></a>
            </div>
            </div>
        </div>
        </div> 
      </div>

    <div class="col-sm-9">
      <hr><div class="alert alert-success">
        <h4 align="center"><a href="main.php"><img class="img-reponsive img-rounded" src="../../icons/actions/go-home.png" /> <strong>Turnos Alquiler de Equipos - Home</strong></a></h4>
        </div><hr>
        
      <div class="alert alert-info"> 
      <h4><img class="img-reponsive img-rounded" src="../../icons/actions/help-about.png" /> Información</h4>
      <p><img class="img-reponsive img-rounded" src="../../icons/actions/irc-voice.png" /> <?php echo $mensaje; ?></p>
      </div>
      
      <?php setlocale(LC_ALL,"es_ES"); ?>
	<button type="button" class="btn btn-default navbar-btn"><img class="img-reponsive img-rounded" src="../../icons/actions/view-calendar-day.png" /> <?php echo "<strong> Fecha Actual:</strong> ". strftime("%d de %b de %Y"); ?> </button>
	
	<!-- Trigger the modal with a button -->
        <button type="button" class="btn btn-success navbar-btn" data-toggle="modal" data-target="#myModal2">
            <img class="img-reponsive img-rounded" src="../../icons/actions/help-contents.png" /> Ayuda en línea</button><hr>
            
      
      <?php
            
      if($conn){
      
      if(isset($_POST['A'])){
        equiposTurnos($conn);
      }
      if(isset($_POST['B'])){
        equiposTurnosUser($nombre,$conn);
      }
      if(isset($_POST['C'])){
        loadUserBio($conn,$nombre);
      }
      if(isset($_POST['D'])){
        loadUserPass($conn,$nombre);
      }
      if(isset($_POST['E'])){
        uploadAvatar();
      }
      if(isset($_POST['submit'])){
         uploadFileAvatar($nombre,$conn);
      }
      if(isset($_POST['F'])){
        formModulos($entorno,$descripcion,$nombre,$conn);
      }
      
      // llama a funcion para cancelar turno
      if(isset($_POST['cancel'])){
        $id = mysqli_real_escape_string($conn,$_POST['bookId']);
        $estado = 'Libre';
        cancelReservaEquipo($id,$estado,$conn);
       }
       
       //llama a función para suscribirse a nuevo modulo
       if(isset($_POST['modulo'])){
        $modulo = mysqli_real_escape_string($conn,$_POST['valor']);
        addModulo($modulo,$nombre,$conn);
       }
       // llama a función para formulario de reserva de equipo
       if(isset($_POST['reservar'])){
        formReservaEquipo($nombre,$conn);
       }
       // llama a función para verificar si el pedido de reserva de equipo es posible
       if(isset($_POST['reserva_ok'])){
        $f_turno = mysqli_real_escape_string($conn,$_POST['f_turno']);
        $direccion = mysqli_real_escape_string($conn,$_POST['direccion']);
        $h_desde = mysqli_real_escape_string($conn,$_POST['hora_desde']);
        $c_horas = mysqli_real_escape_string($conn,$_POST['cantidad_horas']);
        $equipo = mysqli_real_escape_string($conn,$_POST['equipo']);
        $localidad = mysqli_real_escape_string($conn,$_POST['localidad']);
        formReservaEquipo2($nombre,$f_turno,$direccion,$localidad,$h_desde,$c_horas,$equipo,$conn);       
       }
       // carga solicitud de alquiler a la base de datos
       if(isset($_POST['reserva_final'])){
        $f_turno = mysqli_real_escape_string($conn,$_POST['f_turno']);
        $direccion = mysqli_real_escape_string($conn,$_POST['direccion']);
        $localidad = mysqli_real_escape_string($conn,$_POST['localidad']);
        $hora_desde = mysqli_real_escape_string($conn,$_POST['hora_desde']);
        $hora_hasta = mysqli_real_escape_string($conn,$_POST['hora_hasta']);
        $equipo = mysqli_real_escape_string($conn,$_POST['equipo']);
        $cliente = mysqli_real_escape_string($conn,$_POST['cliente']);
        $dni = mysqli_real_escape_string($conn,$_POST['dni']);
        $movil = mysqli_real_escape_string($conn,$_POST['movil']);
        $monto = mysqli_real_escape_string($conn,$_POST['monto']);
        $m_pago = mysqli_real_escape_string($conn,$_POST['pago']);
        addTurnoEquipo($f_turno,$direccion,$localidad,$hora_desde,$hora_hasta,$equipo,$cliente,$dni,$movil,$m_pago,$monto,$conn);
       }
      
      
      }else{
        mysqli_error($conn);
      }
      
      
      ?>
      
      
    
    </div>
  </div>
</div>


<script>
  $(document).ready(function(e) {
  $('#myModal').on('show.bs.modal', function(e) {
    var id = $(e.relatedTarget).data().id;
    $(e.currentTarget).find('#bookId').val(id);
  });
});
  </script>

<!-- Modal -->
    <?php modal_1(); ?>
<!-- end Modal -->

<!-- Modal 2 -->
 <?php modal_2(); ?>
<!-- End Modal 2 -->

    





</body>
</html>
