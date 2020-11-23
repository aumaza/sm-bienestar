<?php

/*
** Funcion que carga el skeleto del sistema
*/

function skeleton(){

  echo '<link rel="stylesheet" href="/sm-bienestar/skeleton/css/bootstrap.min.css" >
	<link rel="stylesheet" href="/sm-bienestar/skeleton/css/bootstrap-theme.css" >
	<link rel="stylesheet" href="/sm-bienestar/skeleton/css/bootstrap-theme.min.css" >
	<link rel="stylesheet" href="/sm-bienestar/skeleton/css/scrolling-nav.css" >
	<link rel="stylesheet" href="/sm-bienestar/skeleton/css/fontawesome.css">
	<link rel="stylesheet" href="/sm-bienestar/skeleton/css/fontawesome.min.css" >
	<link rel="stylesheet" href="/sm-bienestar/skeleton/css/jquery.dataTables.min.css" >
	<link rel="stylesheet" href="/sm-bienestar/skeleton/Chart.js/Chart.min.css" >
	<link rel="stylesheet" href="/sm-bienestar/skeleton/Chart.js/Chart.css" >
	
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="/sm-bienestar/skeleton/js/jquery-3.4.1.min.js"></script>
	<script src="/sm-bienestar/skeleton/js/bootstrap.min.js"></script>
	
	<script src="/sm-bienestar/skeleton/js/jquery.dataTables.min.js"></script>
	<script src="/sm-bienestar/skeleton/js/dataTables.editor.min.js"></script>
	<script src="/sm-bienestar/skeleton/js/dataTables.select.min.js"></script>
	<script src="/sm-bienestar/skeleton/js/dataTables.buttons.min.js"></script>
	
	<script src="/sm-bienestar/js/scrolling-nav.js"></script>
	<script src="/sm-bienestar/skeleton/Chart.js/Chart.min.js"></script>
	<script src="/sm-bienestar/skeleton/Chart.js/Chart.bundle.min.js"></script>
	<script src="/sm-bienestar/skeleton/Chart.js/Chart.bundle.js"></script>
	<script src="/sm-bienestar/skeleton/Chart.js/Chart.js"></script>';
}



/////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////// SECCION ADMINISTRACION DE USUARIOS ////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////

/*
** funcion para agregar usuarios
*/
function addUser($nombre,$password1,$email,$role,$entorno,$conn){

mysqli_select_db('smb_bienestar');	

	$sql = "INSERT INTO smb_usuarios ".
		"(nombre,user,email,password,role,entorno)".
		"VALUES ".
      "('$nombre','$email','$email','$password1','$role','$entorno')";
      $resp = mysqli_query($conn,$sql);
		
	 if($resp){
            echo "<br>";
		    echo '<div class="container">';
		    echo '<div class="alert alert-success" role="alert">';
		    echo '<img class="img-reponsive img-rounded" src="../icons/actions/dialog-ok-apply.png" /> Usuario Creado Satisfactoriamente.';
		    echo "</div>";
		    echo "</div>";
		    
		    switch($entorno){
		    
		    case "VP":  echo   '<br>
                                <div class="container">
                                <div class="alert alert-success" role="alert">
                                <a href="../productos/"><button type="button" class="btn btn-success">Ingresar</button></a>
                                </div></div>'; break;
		    
		    case "TG":  echo   '<br>
                                <div class="container">
                                <div class="alert alert-success" role="alert">
                                <a href="../gabinete/"><button type="button" class="btn btn-success">Ingresar</button></a>
                                </div></div>'; break;
		    
		    case "TE":  echo   '<br>
                                <div class="container">
                                <div class="alert alert-success" role="alert">
                                <a href="../equipos/"><button type="button" class="btn btn-success">Ingresar</button></a>
                                </div></div>'; break;
		    case "VE":  echo   '<br>
                                <div class="container">
                                <div class="alert alert-success" role="alert">
                                <a href="../venta_equipos/"><button type="button" class="btn btn-success">Ingresar</button></a>
                                </div></div>'; break;
		    
		    case "CA":  echo   '<br>
                                <div class="container">
                                <div class="alert alert-success" role="alert">
                                <a href="../capacitacion/"><button type="button" class="btn btn-success">Ingresar</button></a>
                                </div></div>'; break;
		      
		    }
		    
    }else{
			    echo "<br>";
			    echo '<div class="container">';
			    echo '<div class="alert alert-warning" role="alert">';
			    echo '<img class="img-reponsive img-rounded" src="../icons/status/task-attempt.png" /> Hubo un problema al intentar crear el Usuario.'  .mysqli_error($conn);
			    echo "</div>";
			    echo "</div>";
		    }

}

/*
** funcion para agregar clientes
*/
function addCliente($nombre,$dni,$direccion,$tel,$movil,$email,$conn){

    mysqli_select_db('smb_bienestar');	

	$sql = "INSERT INTO smb_clientes ".
		"(nombre,dni,direccion,tel,movil,email)".
		"VALUES ".
      "('$nombre','$dni','$direccion','$tel','$movil','$email')";
    
    $resp = mysqli_query($conn,$sql);
    
    if($resp){
            echo "<br>";
		    echo '<div class="container">';
		    echo '<div class="alert alert-success" role="alert">';
		    echo '<img class="img-reponsive img-rounded" src="../icons/actions/dialog-ok-apply.png" /> Cliente Creado Satisfactoriamente.';
		    echo "</div>";
		    echo "</div>";
    }else{
			    echo "<br>";
			    echo '<div class="container">';
			    echo '<div class="alert alert-warning" role="alert">';
			    echo '<img class="img-reponsive img-rounded" src="../icons/status/task-attempt.png" /> Hubo un problema al intentar crear el Cliente.'  .mysqli_error($conn);
			    echo "</div>";
			    echo "</div>";
		    }
    
}


/*
* Funcion para cambiar los permisos de los usuarios al sistema
*/

function cambiarPermisos($id,$role,$conn){

  $sql = "UPDATE smb_usuarios set role = '$role' where id = '$id'";
  mysqli_select_db('smb_bienestar');
  $retval = mysqli_query($conn,$sql);
  if($retval){
    
    echo "<br>";
			echo '<div class="section"><br>
			      <div class="container">
			      <div class="row">
			      <div class="col-md-12">';
			echo '<div class="alert alert-success" role="alert">';
			echo 'Rol Actualizado Satisfactoriamente';
			echo "</div>";
			echo "</div>";
			echo "</div>";
			echo "</div>";
			echo "</div>";
  
	  }else{
			echo "<br>";
			echo '<div class="section"><br>
			      <div class="container">
			      <div class="row">
			      <div class="col-md-12">';
			echo '<div class="alert alert-warning" role="alert">';
			echo "El usuario no existe. Intente Nuevamente!";
			echo "</div>";
			echo "</div>";
			echo "</div>";
			echo "</div>";
			echo "</div>";
		}
 
}

/*
** funcion editar password del usuario (entorno de usuario)
*/
function loadUserPass($conn,$nombre){

if($conn){
	
	$sql = "SELECT * FROM smb_usuarios where nombre = '$nombre'";
    	mysqli_select_db('smb_bienestar');
    	$resultado = mysqli_query($conn,$sql);
	//mostramos fila x fila
	$count = 0;
	echo '<div class="panel panel-success" >
	      <div class="panel-heading"><span class="pull-center "><img src="../../icons/actions/view-refresh.png"  class="img-reponsive img-rounded"> Cambiar Password';
	echo '</div><br>';

            echo "<table class='display compact' style='width:100%' id='myTable'>";
              echo "<thead>
		    <th class='text-nowrap text-center'>ID</th>
		    <th class='text-nowrap text-center'>Nombre</th>
                    <th class='text-nowrap text-center'>Usuario</th>
                    <th>&nbsp;</th>
                    </thead>";


	while($fila = mysqli_fetch_array($resultado)){
			  // Listado normal
			 echo "<tr>";
			 echo "<td align=center>".$fila['id']."</td>";
			 echo "<td align=center>".$fila['nombre']."</td>";
			 echo "<td align=center>".$fila['user']."</td>";
			 echo "<td class='text-nowrap'>";
			 echo '<a href="../usuarios/editar.php?id='.$fila['id'].'" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-pencil"></span> Cambiar Password</a>';
			 echo "</td>";
			 $count++;
		}

		echo "</table>";
		echo "<br>";
		echo '</div>';
		}else{
		  echo 'Connection Failure...';
		}

    mysqli_close($conn);

}


/*
** funcion editar datos del usuario (entorno de usuario)
*/
function loadUserBio($conn,$nombre){

if($conn){
	
	$sql = "SELECT * FROM smb_clientes where nombre = '$nombre'";
    	mysqli_select_db('smb_bienestar');
    	$resultado = mysqli_query($conn,$sql);
	//mostramos fila x fila
	$count = 0;
	echo '<div class="panel panel-success" >
	      <div class="panel-heading"><span class="pull-center "><img src="../../icons/actions/user-group-properties.png"  class="img-reponsive img-rounded"> Datos Personales';
	echo '</div><br>';

            echo "<table class='display compact' style='width:100%' id='myTable'>";
              echo "<thead>
		    <th class='text-nowrap text-center'>ID</th>
		    <th class='text-nowrap text-center'>Nombre</th>
            <th class='text-nowrap text-center'>DNI</th>
            <th class='text-nowrap text-center'>Dirección</th>
            <th class='text-nowrap text-center'>Teléfono</th>
            <th class='text-nowrap text-center'>Móvil</th>
            <th class='text-nowrap text-center'>Email</th>
            <th>&nbsp;</th>
            </thead>";


	while($fila = mysqli_fetch_array($resultado)){
			  // Listado normal
			 echo "<tr>";
			 echo "<td align=center>".$fila['id']."</td>";
			 echo "<td align=center>".$fila['nombre']."</td>";
			 echo "<td align=center>".$fila['dni']."</td>";
			 echo "<td align=center>".$fila['direccion']."</td>";
			 echo "<td align=center>".$fila['tel']."</td>";
			 echo "<td align=center>".$fila['movil']."</td>";
			 echo "<td align=center>".$fila['email']."</td>";
			 echo "<td class='text-nowrap'>";
			 echo '<a href="../usuarios/bio_edit.php?id='.$fila['id'].'" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-pencil"></span> Editar</a>';
			 echo "</td>";
			 $count++;
		}

		echo "</table>";
		echo "<br>";
		echo '</div>';
		}else{
		  echo 'Connection Failure...';
		}

    mysqli_close($conn);

}

///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////// SECCION REGENERACION PASSWORD ///////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
/*
** Funcion para generar archivo de password
*/


function gentxt($usuario,$password){
  
  $fileName = "gen_pass/$usuario.pass.txt"; 
    
  if (file_exists($fileName)){
  
  //echo "Archivo Existente...";
  //echo "Se actualizaran los datos...";
  $file = fopen($fileName, 'w+') or die("Se produjo un error al crear el archivo");
  
  fwrite($file, $password) or die("No se pudo escribir en el archivo");
  
  fclose($file);
	
	echo '<div class="alert alert-info" role="alert">';
	echo "Se ha generado su archivo de password. Descargue el archivo generado. Recuerde modificar su Password cuando ingrese nuevamente.";
	echo "</div>";
  echo "<hr>";
  echo '<a href="download_pass.php?file_name='.$fileName.'" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-save"></span> Descargar</a>';
 
  }else{
  
      //echo "Se Generará archivo de respaldo..."
      $file = fopen($fileName, 'w') or die("Se produjo un error al crear el archivo");
      fwrite($file, $password) or die("No se pudo escribir en el archivo");
      fclose($file);
	
        echo '<div class="alert alert-info" role="alert">';
	echo "Se ha generado su archivo de password. Descargue el archivo generado. Recuerde modificar su Password cuando ingrese nuevamente.";
	echo "</div>";
        echo "<hr>";
        echo '<a href="download_pass.php?file_name='.$fileName.'" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-save"></span> Descargar</a>';
       
  
  }
  
  
}


/*
** Funcion para generar password aleatorio
*/

function genPass(){
    //Se define una cadena de caractares.
    //Os recomiendo desordenar las minúsculas, mayúsculas y números para mejorar la probabilidad.
    $string = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890@";
    //Obtenemos la longitud de la cadena de caracteres
    $stringLong = strlen($string);
 
    //Definimos la variable que va a contener la contraseña
    $pass = "";
    //Se define la longitud de la contraseña, puedes poner la longitud que necesites
    //Se debe tener en cuenta que cuanto más larga sea más segura será.
    $longPass=15;
 
    //Creamos la contraseña recorriendo la cadena tantas veces como hayamos indicado
    for($i=1 ; $i<=$longPass ; $i++){
        //Definimos numero aleatorio entre 0 y la longitud de la cadena de caracteres-1
        $pos = rand(0,$stringLong-1);
 
        //Vamos formando la contraseña con cada carácter aleatorio.
        $pass .= substr($string,$pos,1);
    }
    return $pass;
}

/*
** Funcion para blanquear password
*/

function resetPass($conn,$usuario){

  $password = genPass();
  
  $sql = "UPDATE smb_usuarios SET password = '$password' where user = '$usuario'";
  
  $retval = mysqli_query($conn,$sql);
 
  
  if($retval){
    echo '<div class="container">
      <div class="row">
      <div class="col-md-6">';
    
    echo '<div class="alert alert-success" role="alert">';
    echo "Su Password fue blanqueada con Exito!";
    echo "<br>";
    gentxt($usuario,$password);
    
    echo "</div>";
    echo '</div>
	  </div>
	  </div>';
    
  }else{
    
    echo '<div class="container">
      <div class="row">
      <div class="col-md-6">';
    echo '<div class="alert alert-danger" role="alert">';
    echo "Error al Blanquear Password";
    echo "</div>";
     echo '</div>
	  </div>
	  </div>';
    
  }
   
}



/////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////// SECCION TURNOS GABINETE ////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/*
** funcion ver turnos disponibles (entorno de usuario)
*/
function gabineteTurnos($conn){

if($conn){
	
	$sql = "SELECT * FROM smb_turnos_gabinete";
    	mysqli_select_db('smb_bienestar');
    	$resultado = mysqli_query($conn,$sql);
	//mostramos fila x fila
	$count = 0;
	echo '<div class="panel panel-success" >
	      <div class="panel-heading"><span class="pull-center "><img src="../../icons/actions/view-calendar-timeline.png"  class="img-reponsive img-rounded"> Turnos Disponibles';
	echo '</div><br>';

            echo "<table class='display compact' style='width:100%' id='myTable'>";
              echo "<thead>
		    <th class='text-nowrap text-center'>ID</th>
		    <th class='text-nowrap text-center'>Fecha</th>
            <th class='text-nowrap text-center'>Especialidad</th>
            <th class='text-nowrap text-center'>Hora</th>
            <th>&nbsp;</th>
            </thead>";


	while($fila = mysqli_fetch_array($resultado)){
			  // Listado normal
			 echo "<tr>";
			 echo "<td align=center>".$fila['id']."</td>";
			 if($fila['estado'] == 'Ocupado'){
			 echo '<td align=center style="background-color:red"><font color="white">'.$fila['f_turno'].'</font></td>';
			 }else{
			 echo "<td align=center>".$fila['f_turno']."</td>";
			 }
			 echo "<td align=center>".$fila['especialidad']."</td>";
			 echo "<td align=center>".$fila['hora']."</td>";
			 echo "<td class='text-nowrap'>";
			 if($fila['estado'] == 'Libre'){
			 echo '<a href="../turnos/reservar.php?id='.$fila['id'].'" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-pencil"></span> Reservar</a>';
			 }
			 echo "</td>";
			 $count++;
		}

		echo "</table>";
		echo "<br>";
		echo '</div>';
		}else{
		  echo 'Connection Failure...';
		}

    mysqli_close($conn);

}







?>
