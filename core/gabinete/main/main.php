<?php include "../../connection/connection.php";
      include "../../functions/functions.php";
      
	session_start();
	$usuario = $_SESSION['usuario'];
	$password = $_SESSION['password'];
	$entorno = $_SESSION['entorno'];
	
	$sql = "select * from smb_usuarios where user = '$usuario' and password = '$password' and entorno = '$entorno'";
	mysqli_select_db('smb_bienestar');
	$query = mysqli_query($conn,$sql);
	while($row = mysqli_fetch_array($query)){
	      $nombre = $row['nombre'];
	}
	
	if($usuario == null || $usuario = ''){
	echo '<div class="alert alert-danger" role="alert">';
	echo "Usuario o Contraseña Incorrecta. Reintente Por Favor...";
	echo '<br>';
	echo "O no tiene permisos o no ha iniciado sesion...";
	echo "</div>";
	echo '<a href="../../logout.php"><br><br><button type="submit" class="btn btn-primary">Aceptar</button></a>';	
	die();
	}
?>



<!DOCTYPE html>
<html lang="es">
<head>
  <title>SM Bienestar - Gabinete</title>
  <meta charset="utf-8">
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
  </style>
</head>
<body>

<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-3 sidenav">
    <hr><div class="alert alert-success">
      <br><h4 align="center"><strong>Bienvenido/a:</strong> <?php echo $nombre; ?></h4>
      </div><hr>
       <div class="panel-group">
        <div class="panel panel-default">
            <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" href="#collapse1" data-toggle="tooltip" data-placement="right" title="Menú Principal - Desplegame!"><img class="img-reponsive img-rounded" src="../../icons/categories/preferences-desktop-peripherals.png" /> Menú</a>
            </h4>
            </div>
            
            <div id="collapse1" class="panel-collapse collapse">
            <ul class="list-group">
            <form action="main.php" method="POST">
                <li class="list-group-item" align="center"><a href="#" data-toggle="tooltip" data-placement="right" title="Ver Turnos Disponibles"><button type="submit" class="btn btn-default btn-sm" name="A"><img class="img-reponsive img-rounded" src="../../icons/actions/view-calendar-timeline.png" /> Turnos Disponibles</button></a></li>
                <li class="list-group-item"><a href="#" data-toggle="tooltip" data-placement="right" title="Ver Mis Turnos"><button type="submit" class="btn btn-default btn-sm" name="B"><img class="img-reponsive img-rounded" src="../../icons/actions/documentation.png" /> Turnos Reservados</button></a></li>
                <li class="list-group-item"><a href="#" data-toggle="tooltip" data-placement="right" title="Editar Datos Personales"><button type="submit" class="btn btn-default btn-sm" name="C"><img class="img-reponsive img-rounded" src="../../icons/actions/user-group-properties.png" /> Datos Personales</button></a></li>
                <li class="list-group-item"><a href="#" data-toggle="tooltip" data-placement="right" title="Cambiar mi Contraseña"><button type="submit" class="btn btn-default btn-sm" name="D"><img class="img-reponsive img-rounded" src="../../icons/actions/view-refresh.png" /> Cambiar Password</button></a></li>
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
        <h4 align="center"><a href="main.php"><img class="img-reponsive img-rounded" src="../../icons/actions/view-calendar-timeline.png" /> <strong>Turnos Gabinete</strong></a></h4>
        </div><hr>
        
      <div class="alert alert-info"> 
      <h4><img class="img-reponsive img-rounded" src="../../icons/actions/help-about.png" /> Información</h4>
      </div><hr>
      
      <h5><span class="glyphicon glyphicon-time"></span> Post by Jane Dane, Sep 27, 2015.</h5>
      <h5><span class="label label-danger">Food</span> <span class="label label-primary">Ipsum</span></h5><br>
      <p>Food is my passion. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><hr>
      
      <?php
            
      if($conn){
      
      if(isset($_POST['A'])){
        gabineteTurnos($conn);
      }
      if(isset($_POST['C'])){
        loadUserBio($conn,$nombre);
      }
      if(isset($_POST['D'])){
        loadUserPass($conn,$nombre);
      }
      
      
      }else{
        mysqli_error($conn);
      }
      
      
      ?>
      
      
    
    </div>
  </div>
</div>

<footer class="container-fluid">
  <p>Footer Text</p>
</footer>

</body>
</html>
