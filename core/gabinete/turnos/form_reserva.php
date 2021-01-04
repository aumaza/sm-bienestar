<?php include "../../connection/connection.php";
      include "../../functions/functions.php";
      
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
  <title>SM Bienestar - Finaliza Reserva de Turno</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php skeleton(); ?>
  
  </head>
  <body>
  <!-- User and system info -->
<div class="container-fluid">
      <div class="row">
      <div class="col-md-12 text-center"><br>
	<button><span class="glyphicon glyphicon-user"></span> Usuario: <?php echo $nombre ?></button>
	<?php setlocale(LC_ALL,"es_ES"); ?>
	<button><span class="glyphicon glyphicon-time"></span> <?php echo "Hora Actual: " . date("H:i"); ?></button>
	 <?php setlocale(LC_ALL,"es_ES"); ?>
	<button><span class="glyphicon glyphicon-calendar"></span> <?php echo "Fecha Actual: ". strftime("%d de %B del %Y"); ?> </button>
	</div>
	</div>
	</div>
<!-- end user and system info -->
	<hr>
	
<!-- main body -->
<div class="container"><br>
<div class="row">
<div class="col-sm-10">

<div class="panel panel-info" >
  <div class="panel-heading">
    <h2 class="panel-title text-center text-default "><span class="pull-center "><img src="../../icons/actions/go-jump-today.png"  class="img-reponsive img-rounded"> Finaliza Reserva de Turno Gabinete</h2>
  </div>
    <div class="panel-body">
    
    <?php 
    $id = mysqli_real_escape_string($conn,$_POST['id']);
    $especialidad = mysqli_real_escape_string($conn,$_POST['especialidad']);
    $espacio = mysqli_real_escape_string($conn,$_POST['espacio']);
    $nombre = mysqli_real_escape_string($conn,$_POST['cliente']);
    $hora = mysqli_real_escape_string($conn,$_POST['hora']);
    $fecha = mysqli_real_escape_string($conn,$_POST['f_turno']);
    $estado = 'Ocupado';
    $solicitud = 'Stand-By';
     
    $consulta = "select if(especialidad = 'Masajes', 1, 0) Masajes, if(especialidad = 'Tratamiento Facial', 1, 0) Tratamiento_Facial, if(especialidad = 'Depilación', 1, 0) Depilacion, if(especialidad = 'Asesoramiento Técnico', 1, 0) tecnico, if(especialidad = 'Tratamiento Corporal', 1, 0) corporal from smb_turnos_gabinete where f_turno = '$fecha' and hora = '$hora'";
    mysqli_select_db($conn,'smb_bienestar');
	$qry = mysqli_query($conn,$consulta);
	  
	 
    if($conn){
    
     while($fila = mysqli_fetch_array($qry)){
         
         if(mysqli_num_rows($qry) > 0){
           
                         
           if((strcmp($especialidad,'Masajes') == 0) || (strcmp($especialidad,'Tratamiento Facial') == 0) || (strcmp($especialidad,'Depilación') == 0)){
                
                $flag = 0;
                
                if(($fila['Masajes'] == 1) || ($fila['Tratamiento_Facial'] == 1) || ($fila['Depilacion'] == 1)){
                 
                 echo "<br>";
                 echo '<div class="alert alert-warning" alert-dismissible role="alert">';
                 echo '<img src="../../icons/status/task-attempt.png"  class="img-reponsive img-rounded"> Por Favor Seleccione la Especialidad: <strong>'.$especialidad.'</strong> en otro Horario u otra Fecha';
                 echo "</div>";
                 $flag = 1;
                 echo '<meta http-equiv="refresh" content="5;URL=../main/main.php"/>';
                 break;
                        }
                    }
                    }// fin if (nums_rows)
                    }// fin del while
                    
                    if($flag == 0){
                    
                    if(($fila['Masajes'] == 0) && ($fila['Tratamiento_Facial'] == 0) && ($fila['Depilacion'] == 0)){
          
                        closeReserva($id,$especialidad,$nombre,$estado,$solicitud,$conn);
                        echo '<meta http-equiv="refresh" content="5;URL=../main/main.php"/>';
                        exit;
          
                        }
                        if((strcmp($especialidad,'Asesoramiento Técnico') == 0) || (strcmp($especialidad,'Tratamiento Corporal') == 0)){
                        
                            if(($fila['tecnico'] == 1) || ($fila['corporal'] == 1) || ($fila['tecnico'] == 0) || ($fila['corporal'] == 0)){
                            closeReserva($id,$especialidad,$nombre,$estado,$solicitud,$conn);
                            echo '<meta http-equiv="refresh" content="5;URL=../main/main.php"/>';
                            exit;
                    
                        }
                        }
                        }
                        
                }else{
                        mysqli_error($conn);
                    }
	  
    
    ?>
</div>
</div>
</div>
</div>
<!-- <meta http-equiv="refresh" content="5;URL=../main/main.php"/> -->
</body>
</html>
