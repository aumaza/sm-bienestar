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

<html><head>
	<meta charset="utf-8">
	<title>Cambio de Avatar</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="../../icons/actions/view-media-artist.png" />
	<?php skeleton();?>

	
</head>
<body>

<!-- User and system info -->
<div class="container-fluid">
      <div class="row">
      <div class="col-md-12 text-center"><br>
	<button><span class="glyphicon glyphicon-user"></span> Usuario: <?php echo $nombre; ?></button>
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

<?php


$id = mysqli_real_escape_string($conn,$_POST['id']);

if($conn){

// File upload path
$targetDir = '../../user_avatar/';
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"])){
    // Allow certain file formats
    $allowTypes = array('jpg','png','jpeg','gif');
    
    if(in_array($fileType, $allowTypes)){
    
        // Upload file to server
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
           
            
            // Insert image file name into database
           
           $sqlInsert = "UPDATE smb_clientes set avatar = '$targetFilePath' where id = '$id'";
			   mysqli_select_db($conn,'smb_bienestar');
			  $insert = mysqli_query($conn,$sqlInsert);
           
           
            if($insert){
            
			  echo '<div class="alert alert-success" role="alert">';
			  echo '<h1 class="panel-title text-left" contenteditable="true"><img class="img-reponsive img-rounded" src="../../icons/actions/dialog-ok-apply.png" /><strong> Base de Datos Actualizada. El Archivo '.$fileName. ' se ha subido correctamente..</strong>';
                          echo "</div><hr>";
                          echo '<a href="../main/main.php"><button type="button" class="btn btn-primary "><img src="../../icons/actions/go-previous-view.png"  class="img-reponsive img-rounded"> Volver</button></a>';
                          
                                           
            }else{
		  
			  echo '<div class="alert alert-success" role="alert">';
			  echo '<h1 class="panel-title text-left" contenteditable="true"><img class="img-reponsive img-rounded" src="../../icons/actions/dialog-ok-apply.png" /><strong> El Archivo '.$fileName. ' se ha subido correctamente.</strong>';
                          echo "</div><hr>";
                          echo '<a href="../main/main.php"><button type="button" class="btn btn-primary "><img src="../../icons/actions/go-previous-view.png"  class="img-reponsive img-rounded"> Volver</button></a>';
                         
                
            } 
        }else{
			  echo '<div class="alert alert-warning" role="alert">';
			  echo '<h1 class="panel-title text-left" contenteditable="true"><img class="img-reponsive img-rounded" src="../../icons/actions/dialog-cancel.png" /><strong> Ups. Hubo un error subiendo el Archivo.</strong>';
                          echo "</div><hr>";
                          echo '<a href="../main/main.php"><button type="button" class="btn btn-primary "><img src="../../icons/actions/go-previous-view.png"  class="img-reponsive img-rounded"> Volver</button></a>';
                          
        }
    }else{
			  echo '<div class="alert alert-danger" role="alert">';
			  echo '<h1 class="panel-title text-left" contenteditable="true"><img class="img-reponsive img-rounded" src="../../icons/actions/dialog-cancel.png" /><strong> Ups, solo archivos con extensión: JPG, PNG, BMP, GIF son soportados.</strong>';
			  echo "</div><hr>";
                          echo '<a href="../main/main.php"><button type="button" class="btn btn-primary "><img src="../../icons/actions/go-previous-view.png"  class="img-reponsive img-rounded"> Volver</button></a>';
                        
    }
}else{
			  echo '<div class="alert alert-info" role="alert">';
                          echo '<h1 class="panel-title text-left" contenteditable="true"><img class="img-reponsive img-rounded" src="../../icons/actions/system-reboot.png" /><strong> Por favor, seleccione al archivo a subir.</strong>';
                          echo "</div><hr>";
                          echo '<a href="../main/main.php"><button type="button" class="btn btn-primary "><img src="../../icons/actions/go-previous-view.png"  class="img-reponsive img-rounded"> Volver</button></a>';
                          
}

}else{
    mysqli_error($conn);
}


?>

</div>
</div>
</div>


</body>
</html>
