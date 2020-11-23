<?php include "connection/connection.php";
      include "functions/functions.php";

	$usuario = mysqli_real_escape_string($conn,$_POST["usuario"]);
	$password = mysqli_real_escape_string($conn,$_POST["password"]);
	$entorno = mysqli_real_escape_string($conn,$_POST["entorno"]);
	
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
	
	session_start();
	$_SESSION['usuario'] = $usuario;
	$_SESSION['password'] = $password;
	$_SESSION['entorno'] = $entorno;
	
	
      if($conn){
	        
	mysqli_select_db('smb_bienestar');
	
	$sql = "SELECT * FROM smb_usuarios where user = '$usuario' and password = '$password' and role = 1 and entorno = '$entorno'";
	$q = mysqli_query($conn,$sql);
	
	$query = "SELECT * FROM smb_usuarios where user = '$usuario' and password = '$password' and role = 0";
	$retval = mysqli_query($conn,$query);
	
	}else{
	
        mysqli_error($conn);
	}

?>
  <html style="height: 100%">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="icons/actions/bookmarks-organize.png" />
   <?php skeleton();?>
	
    <title>Bienvenido</title>
    </head>
    <body background="img/login-img.jpg" class="img-fluid" alt="Responsive image" style="background-repeat: no-repeat; background-position: center center; background-size: cover" style="height: 100%"><br>
    <div class="container">
    <div class="main">
    <h2></h2>

<?php
	
    		if(!$q && !$retval){	
			echo '<div class="alert alert-danger" role="alert">';
			echo "Error de Conexion..." .mysqli_error($conn);
			echo "</div>";
			echo '<a href="logout.php"><br><br><button type="submit" class="btn btn-primary">Aceptar</button></a>';	
			exit;			
			
			}if($user = mysqli_fetch_assoc($retval)){
				

				echo '<div class="alert alert-danger" role="alert">';
				echo "<strong>Atención!  </strong>" .$_SESSION["user"];
				echo "<br>";
				echo '<span class="pull-center "><img src="icons/status/security-low.png"  class="img-reponsive img-rounded"><strong> Usuario Bloqueado. Contacte al Administrador.</strong>';
				echo "</div>";
				echo '<meta http-equiv="refresh" content="5;URL=logout.php "/>';
				exit;
			}else if($user = mysqli_fetch_assoc($q)){

				if(strcmp($_SESSION["usuario"], 'root') == 0){
				//logs($_SESSION["user"]);
				echo "<br>";
				echo '<div class="alert alert-success" role="alert">';
				echo '<span class="pull-center "><img src="../img/tenor.gif" class="img-reponsive img-rounded" weight="5%" height="5%">';
				echo "<strong> Bienvenido!  </strong>" .$_SESSION["usuario"];
				echo "<strong> Aguarde un Instante...</strong>";
				echo "<br>";
				echo "</div>";
  				echo '<meta http-equiv="refresh" content="5;URL=administracion/main/main.php "/>';
				
				}else{
				//logs($_SESSION["user"]);
				echo '<div class="alert alert-success" role="alert">';
				echo '<span class="pull-center "><img src="../img/tenor.gif" class="img-reponsive img-rounded"  weight="5%" height="5%">';
				echo "<strong> Bienvenido!  </strong>" .$_SESSION["usuario"];
				echo "<hr>";
				echo "<p>Será dirigido al Entorno " .$descripcion. " Aguarde un Instante...</p>"; 
				echo "</div>";
				
				if($_SESSION['entorno'] == 'VP'){
  				echo '<meta http-equiv="refresh" content="5;URL=productos/main/main.php "/>';
  				}
  				if($_SESSION['entorno'] == 'TG'){
                    echo '<meta http-equiv="refresh" content="5;URL=gabinete/main/main.php "/>';
  				}
  				if($_SESSION['entorno'] == 'TE'){
                    echo '<meta http-equiv="refresh" content="5;URL=equipos/main/main.php "/>';
  				}
  				if($_SESSION['entorno'] == 'VE'){
                    echo '<meta http-equiv="refresh" content="5;URL=ventas_equipos/main/main.php "/>';
  				}
  				if($_SESSION['entorno'] == 'CA'){
                    echo '<meta http-equiv="refresh" content="5;URL=capacitacion/main/main.php "/>';
  				}
				}
			}else{
				echo '<div class="alert alert-danger" role="alert">';
				echo '<span class="pull-center "><img src="icons/status/dialog-warning.png"  class="img-reponsive img-rounded"> Usuario o                   Contraseña Incorrecta. O no tiene tiene permisos el entorno ' .$descripcion. '. Reintente Por Favor....';
				echo "</div>";
				echo '<meta http-equiv="refresh" content="5;URL=logout.php "/>';
				
				}
	
			
	
	//cerramos la conexion
	
	mysqli_close($conn);
    ?>
</div>
</div>
</body>
</html>
