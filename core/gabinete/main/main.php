<?php include "../../connection/connection.php";
      include "../../functions/functions.php";
      include "../lib/lib_gabinete.php";
      
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
	
	$consulta = "select * from smb_clientes where nombre = '$nombre'";
	mysqli_select_db($conn,$dbase);
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
	
	$qry = "select * from smb_info_gabinete";
	mysqli_select_db($conn,$dbase);
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
  <title>SM Bienestar - Gabinete</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
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
      <br><h4 align="left">
      <?php
      
      if($avatar == ''){
          
          echo '<img src="../../icons/actions/edit-image-face-recognize.png" alt="Avatar" class="avatar" >';
          
        }else{
         echo '<img src="'.$avatar.'" alt="Avatar" class="avatar" >';
        }
      ?>
        <strong>Bienvenido/a:</strong> <?php echo $nombre; ?></h4>
         
         <p><strong>Su Usuario es:</strong> <?php echo $usuario;?></p>
      </div><hr>
      
      <p align="center"><img class="img-reponsive img-rounded" src="../../icons/actions/go-down.png" /> 
        <strong>Para Comenzar haz click sobre Menú</strong></p><hr>
      
       <div class="panel-group">
        <div class="panel panel-primary">
            <div class="panel-heading">
            <h4 class="panel-title">
              <a data-toggle="collapse" href="#collapse1" data-toggle="tooltip" data-placement="right" title="Menú Principal - Desplegame!"><img class="img-reponsive img-rounded" src="../../icons/categories/preferences-desktop-peripherals.png" /> Menú</a>
            </h4>
            </div>
            
            <div id="collapse1" class="panel-collapse collapse">
            <ul class="list-group">
            <form action="main.php" method="POST">
                
          <li class="list-group-item">
		  <button type="submit" class="btn btn-default btn-xs btn-block" name="A" data-toggle="tooltip" data-placement="right" title="Ver Turnos Disponibles">
          <img class="img-reponsive img-rounded" src="../../icons/actions/view-calendar-timeline.png" /> Turnos Disponibles</button>
         </li>
                
         <li class="list-group-item">
		  <button type="submit" class="btn btn-default btn-xs btn-block" name="B" data-toggle="tooltip" data-placement="right" title="Ver Mis Turnos">
		      <img class="img-reponsive img-rounded" src="../../icons/actions/documentation.png" /> Turnos Reservados</button>
         </li>
                
        <li class="list-group-item">
		<button type="submit" class="btn btn-default btn-xs btn-block" name="C" data-toggle="tooltip" data-placement="right" title="Editar Datos Personales">
        <img class="img-reponsive img-rounded" src="../../icons/actions/user-group-properties.png" /> Datos Personales</button>
		</li>
                
        <li class="list-group-item">
		<button type="submit" class="btn btn-default btn-xs btn-block" name="D" data-toggle="tooltip" data-placement="right" title="Cambiar mi Contraseña">
        <img class="img-reponsive img-rounded" src="../../icons/actions/view-refresh.png" /> Cambiar Password</button>
        </li>
                             
        <li class="list-group-item">
		<button type="submit" class="btn btn-default btn-xs btn-block" name="F" data-toggle="tooltip" data-placement="right" title="Susbribirse a otro Módulo">
		<img class="img-reponsive img-rounded" src="../../icons/apps/kcmdf.png" /> Agregar Módulo</button>
		</li>
            
            <form>
            </ul>
            <div class="panel-footer panel-custom">
            <a href="../../logout.php" data-toggle="tooltip" data-placement="right" title="Salir del Sistema">
	      <button type="button" class="btn btn-default btn-xs btn-block">
		<img class="img-reponsive img-rounded" src="../../icons/actions/go-previous-view.png" /> Salir</button></a>
            </div>
            </div>
        </div>
        </div> 
      </div>

    <div class="col-sm-9">
      <hr><div class="alert alert-success">
        <h4 align="center"><a href="main.php">
            <img class="img-reponsive img-rounded" src="../../icons/actions/go-home.png" /> <strong>Turnos Gabinete - Home</strong></a></h4>
        </div><hr>
        
      <div class="alert alert-info"> 
      <h4><img class="img-reponsive img-rounded" src="../../icons/actions/help-about.png" /> Información</h4>
      <p><img class="img-reponsive img-rounded" src="../../icons/actions/irc-voice.png" /> <?php echo $mensaje; ?></p>
      </div><hr>
      
     <?php setlocale(LC_ALL,"es_ES"); ?>
	<button type="button" class="btn btn-default navbar-btn"><img class="img-reponsive img-rounded" src="../../icons/actions/view-calendar-day.png" /> <?php echo "<strong> Fecha Actual:</strong> ". strftime("%d de %b de %Y"); ?> </button>
	
	<!-- Trigger the modal with a button -->
        <button type="button" class="btn btn-success navbar-btn" data-toggle="modal" data-target="#myModal2">
            <img class="img-reponsive img-rounded" src="../../icons/actions/help-contents.png" /> Ayuda en línea</button>
	
	<hr>
     
      
      
      <?php
            
      if($conn){
      
      if(isset($_POST['A'])){
        gabineteTurnos($conn);
      }
      if(isset($_POST['B'])){
        userTurnos($nombre,$conn);
      }
      if(isset($_POST['C'])){
        loadUserBio($conn,$nombre);
      }
      if(isset($_POST['D'])){
        loadUserPass($conn,$nombre);
      }
      if(isset($_POST['F'])){
        formModulos($entorno,$descripcion,$nombre,$conn);
      }
      
      if(isset($_POST['cancel'])){
        $id = mysqli_real_escape_string($conn,$_POST['bookId']);
        $estado = 'Libre';
        cancelReserva($id,$estado,$conn);
       }
       if(isset($_POST['modulo'])){
        $modulo = mysqli_real_escape_string($conn,$_POST['valor']);
        addModulo($modulo,$nombre,$conn);
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
