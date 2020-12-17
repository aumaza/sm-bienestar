<?php include "../../connection/connection.php";
      include "../../functions/functions.php";
      
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
	echo '<div class="alert alert-danger" role="alert">';
	echo "Usuario o Contraseña Incorrecta. Reintente Por Favor...";
	echo '<br>';
	echo "O no tiene permisos o no ha iniciado sesion...";
	echo "</div>";
	echo '<a href="../../logout.php"><br><br><button type="submit" class="btn btn-primary">Aceptar</button></a>';	
	die();
	}
	
	$qry = "select * from smb_info_productos";
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
  <title>SM Bienstar - Venta de Productos</title>
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
    /* Remove the navbar's default rounded borders and increase the bottom margin */ 
    .navbar {
      margin-bottom: 50px;
      border-radius: 0;
    }
    
    /* Remove the jumbotron's default bottom margin */ 
     .jumbotron {
      margin-bottom: 0;
    }
   
    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }
    .affix {
    top: 0;
    width: 100%;
    z-index: 9999 !important;
  }

  .affix ~ .container-fluid {
    position: relative;
    padding-top: 70px;
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

<div class="jumbotron">
  <div class="container text-center">
   <h1><img src="../../../img/logo.png" class="img-rounded" alt="Random Name" width="180" height="50"></h1>
   <h2>Bienvenido/a <strong><?php echo $nombre; ?> </strong>a Venta de Productos</h2> 
   <a href="../../logout.php" data-toggle="tooltip" data-placement="right" title="Salir del Sistema"><button type="button" class="btn btn-default btn-sm"><img class="img-reponsive img-rounded" src="../../icons/actions/go-previous-view.png" /> Salir</button></a>
    </div>
</div>

<nav class="navbar navbar-inverse" data-spy="affix" data-offset-top="197">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <img src="<?php echo $avatar; ?>" alt="Avatar" class="avatar" >
     </div>
     <form action="main.php" method="POST">
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="main.php" data-toggle="tooltip" data-placement="right" title="Panel Principal"><button type="submit" class="btn btn-default btn-sm"><img class="img-reponsive img-rounded" src="../../icons/actions/go-home.png" /> Home</button></a></li>
        
        <li><a href="#" data-toggle="tooltip" data-placement="right" title="Cartelera de Productos"><button type="submit" class="btn btn-default btn-sm" name="A"><img class="img-reponsive img-rounded" src="../../icons/actions/feed-subscribe.png" /> Productos</button></a></li>
        
        <li><a href="#">Deals</a></li>
        <li><a href="#">Stores</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#" data-toggle="tooltip" data-placement="right" title="Editar Datos Personales"><button type="submit" class="btn btn-default btn-sm" name="C"><img class="img-reponsive img-rounded" src="../../icons/actions/user-group-properties.png" /> Datos Personales</button></a></li>
        
        <li><a href="#" data-toggle="tooltip" data-placement="right" title="Cambiar mi Contraseña"><button type="submit" class="btn btn-default btn-sm" name="D"><img class="img-reponsive img-rounded" src="../../icons/actions/view-refresh.png" /> Cambiar Password</button></a></li>
        
        <li><a href="#" data-toggle="tooltip" data-placement="right" title="Susbribirse a otro Módulo"><button type="submit" class="btn btn-default btn-sm" name="F"><img class="img-reponsive img-rounded" src="../../icons/apps/kcmdf.png" /> Agregar Módulo</button></a></li>
        </ul>
     </div>
  </div>
  </form>
</nav>

<div class="container">
<div class="row">
<div class="col-sm-12">

<?php

if($conn){

if(isset($_POST['A'])){
    cartelera($conn);
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
<hr><br><br><br><br>



</body>
</html>
