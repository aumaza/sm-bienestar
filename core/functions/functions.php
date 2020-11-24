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
** funcion formulario de edicion de password de usuario
*/

function editPassUser($id,$conn){

      $sql = "select * from smb_usuarios where id = '$id'";
      mysqli_select_db('smb_bienestar');
      $res = mysqli_query($conn,$sql);
      $fila = mysqli_fetch_assoc($res);
      

      echo   '<h2>Cambiar Password</h2><hr>
	      
	      <form action="formUpdatePass.php" method="post">
	      <input type="hidden" id="id" name="id" value="' . $fila['id'].'" />
   
         
	  <div class="input-group">
	    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
	    <input id="text" type="text" class="form-control" value="' . $fila['nombre'].'" name="nombre" value="" onkeyup="this.value=Text(this.value);" readonly required>
	  </div>
	
	  <div class="input-group">
	    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
	    <input id="text" type="text" class="form-control" name="user" onKeyDown="limitText(this,20);" onKeyUp="limitText(this,20);" value="' . $fila['user'].'" readonly required>
	  </div>
	  
	  <div class="input-group">
	    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
	    <input id="password" type="password" class="form-control" name="pass1" onKeyDown="limitText(this,15);" onKeyUp="limitText(this,15);" placeholder="Password" >
	  </div>
	 
	 <div class="input-group">
	    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
	    <input  type="password" class="form-control" name="pass2" onKeyDown="limitText(this,15);" onKeyUp="limitText(this,15);" placeholder="Repita Password" >
	  </div>
	  <br>
	
	  <button type="submit" class="btn btn-success btn-block" name="A"><img src="../../icons/actions/dialog-ok-apply.png"  class="img-reponsive img-rounded">  Cambiar Password</button>
	  </form>
	  <a href="../main/main.php"><button type="button" class="btn btn-primary btn-block"><img src="../../icons/actions/go-previous-view.png"  class="img-reponsive img-rounded"> Volver</button></a>';

}

/*
** funcion formulario de edicion de password de usuario
*/
function updatePassUser($id,$password1,$conn){

    mysqli_select_db('smb_bienestar');
	$sqlInsert = "update smb_usuarios set password = '$password1' where id = '$id'";
    $res = mysqli_query($conn,$sqlInsert);


	if($res){
		echo "<br>";
		echo '<div class="alert alert-success" role="alert">';
		echo 'Password Actualizada Correctamente.  Deberá Ingresar Nuevamente. Aguarde un Instante que será Redireccionado. ';
		echo "</div>";
		echo '<meta http-equiv="refresh" content="5;URL=../../logout.php">';
	}else{
		echo "<br>";
		echo '<div class="alert alert-warning" role="alert">';
		echo "Hubo un error al Actualizar el Password!. Aguarde un Instante que será Redireccionado" .mysqli_error($conn);
		echo "</div>";
		echo '<meta http-equiv="refresh" content="5;URL=../main/main.php>';
	}
	}


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
function addCliente($nombre,$dni,$direccion,$direccion1,$direccion2,$tel,$movil,$email,$conn){

    mysqli_select_db('smb_bienestar');	

	$sql = "INSERT INTO smb_clientes ".
		"(nombre,dni,direccion,direccion1,direccion2,tel,movil,email)".
		"VALUES ".
      "('$nombre','$dni','$direccion','$direccion1','$direccion2','$tel','$movil','$email')";
    
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
			 echo '<a href="../usuarios/edit_password.php?id='.$fila['id'].'" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-pencil"></span> Cambiar Password</a>';
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

/*
** funcion editar datos de cliente
*/
function editCliente($id,$conn){

    $sql = "select * from smb_clientes where id = '$id'";
    mysqli_select_db('smb_bienestar');
    $resp = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($resp);
        
    echo '<h2>Editar Datos Cliente</h2><hr>
            
            <form action="../usuarios/form_update.php" method="POST">
            <input type="hidden" class="form-control" id="id" name="id" value="'.$id.'">
            
                <div class="form-group">
                <label for="email">Nombre y Apellido:</label>
                <input type="text" class="form-control" id="nombre" value="'.$row['nombre'].'" name="nombre" readonly required>
                </div>
                
                <div class="form-group">
                <label for="pwd">DNI:</label>
                <input type="text" class="form-control" id="dni" value="'.$row['dni'].'" name="dni" readonly required>
                </div>
                
                <div class="form-group">
                <label for="pwd">Dirección:</label>
                <input type="text" class="form-control" id="direccion" value="'.$row['direccion'].'" name="direccion" required>
                </div>
                
                <h1>Para Clientes de Alquiler de Equipos</h1>
                <p>En caso de tener más de una Dirección, complete las siguientes.</p>
                
                
                <div class="form-group">
                <label for="pwd">Dirección (2):</label>
                <input type="text" class="form-control" id="direccion1" value="'.$row['direccion1'].'" name="direccion1">
                </div>
                
                <div class="form-group">
                <label for="pwd">Dirección (3):</label>
                <input type="text" class="form-control" id="direccion2" value="'.$row['direccion2'].'" name="direccion2">
                </div>
                
                <div class="form-group">
                <label for="pwd">Teléfono:</label>
                <input type="text" class="form-control" id="tel" value="'.$row['tel'].'" name="tel" required>
                </div>
                
                <div class="form-group">
                <label for="pwd">Móvil:</label>
                <input type="text" class="form-control" id="movil" value="'.$row['movil'].'" name="movil" required>
                </div>
                
                <div class="form-group">
                <label for="pwd">Email:</label>
                <input type="email" class="form-control" id="email" value="'.$row['email'].'" name="email" required>
                </div>
                
                <button type="submit" class="btn btn-success btn-block"><img src="../../icons/actions/dialog-ok-apply.png"  class="img-reponsive img-rounded"> Aceptar</button><br>
            </form>
            <a href="../main/main.php"><button type="button" class="btn btn-primary btn-block"><img src="../../icons/actions/go-previous-view.png"  class="img-reponsive img-rounded"> Volver</button></a>';



}

/////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////// FIN SECCION ADMINISTRACION DE USUARIOS ////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////




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
////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////// FIN SECCION GENERACION PASSWORD////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////


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
	echo '</div><br>
            <p><strong>Nota:</strong> Aquí se encuentran todos los turnos disponibles, aquellos que aparecen en color Rojo sobre la fecha, significa que ya fueron tomados, si desea tomar un turno, presione el botón <strong>Reservar</strong> y podrá tramitar dicho turno</p><hr>';

            echo "<table class='display compact' style='width:100%' id='myTable'>";
              echo "<thead>
		    <th class='text-nowrap text-center'>ID</th>
		    <th class='text-nowrap text-center'>Fecha</th>
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
			 echo "<td align=center>".$fila['hora']."</td>";
			 echo "<td class='text-nowrap'>";
			 if($fila['estado'] == 'Libre'){
			 echo '<a href="../turnos/reservar.php?id='.$fila['id'].'" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-ok"></span> Reservar</a>';
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


/*
** funcion ver turnos reservados (entorno de usuario)
*/
function userTurnos($nombre,$conn){

if($conn){
	
	$sql = "SELECT * FROM smb_turnos_gabinete where cliente = '$nombre'";
    	mysqli_select_db('smb_bienestar');
    	$resultado = mysqli_query($conn,$sql);
	//mostramos fila x fila
	$count = 0;
	echo '<div class="panel panel-success" >
	      <div class="panel-heading"><span class="pull-center "><img src="../../icons/actions/documentation.png"  class="img-reponsive img-rounded"> Turnos Reservados';
	echo '</div><br>
            <p><strong>Nota: </strong> Todos los turnos que haya solicitado apareceran con estado <strong>Stand-By</strong> por defecto en color Amarillo, cuando el Centro de Estética confirme su solicitud aparecerá como <strong>Confirmado</strong> y en color verde, si lo cancelacen aparecerá con color Rojo</p>
            <p>En caso de cancelar un turno, por favor hágalo con 48 hs de antelación. Muchas Gracias.</p><hr>';

            echo "<table class='display compact' style='width:100%' id='myTable'>";
              echo "<thead>
		    <th class='text-nowrap text-center'>ID</th>
		    <th class='text-nowrap text-center'>Fecha</th>
            <th class='text-nowrap text-center'>Hora</th>
            <th class='text-nowrap text-center'>Especialidad</th>
            <th class='text-nowrap text-center'>Solicitud</th>
            <th>&nbsp;</th>
            </thead>";


	while($fila = mysqli_fetch_array($resultado)){
			  // Listado normal
			 echo "<tr>";
			 echo "<td align=center>".$fila['id']."</td>";
			 if($fila['solicitud'] == 'Stand-By'){
			 echo '<td align=center style="background-color:yellow"><font color="black">'.$fila['f_turno'].'</font></td>';
			 }
			 if($fila['solicitud'] == 'Confirmado'){
			 echo '<td align=center style="background-color:green"><font color="white">'.$fila['f_turno'].'</font></td>';
			 }
			 if($fila['solicitud'] == 'Cancelado'){
			 echo '<td align=center style="background-color:red"><font color="white">'.$fila['f_turno'].'</font></td>';
			 }
			 echo "<td align=center>".$fila['hora']."</td>";
			 echo "<td align=center>".$fila['especialidad']."</td>";
			 echo "<td align=center>".$fila['solicitud']."</td>";
			 echo "<td class='text-nowrap'>";
			 if($fila['estado'] == 'Ocupado'){
			 echo '<a data-toggle="modal" data-target="#myModal" href="#" data-id="'.$fila['id'].'" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove-circle"></span> Cancelar Reserva</button></a>';
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



/*
** funcion formulario de solicutd turno
*/
function reservaGabinete($id,$nombre,$conn){

$sql = "select * from smb_turnos_gabinete where id = '$id'";
mysqli_select_db('smb_bienestar');
$resp = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($resp)){
    $hora = $row['hora'];
    $fecha = $row['f_turno'];
}

 echo '<form action="form_reserva.php" method="POST">
        <input type="hidden" class="form-control" id="id" name="id" value="'.$id.'">
  
  <div class="form-group">
    <label for="f_turno">Fecha Turno:</label>
    <input type="date" class="form-control" id="f_turno" value="'.$fecha.'" readonly required>
  </div>
  
         <div class="form-group">
		  <label for="sel1">Especialidad</label>
		  <select class="form-control" name="especialidad" required>
		  <option value="" disabled selected>Seleccionar</option>';
		    
		    if($conn){

		      $query = "SELECT * FROM smb_especialidades";
		      mysqli_select_db('smb_bienestar');
		      $res = mysqli_query($conn,$query);

		      if($res)
		      {
			
			  while ($valores = mysqli_fetch_array($res))
			    {
				echo '<option value="'.$valores[descripcion].'">'.$valores[descripcion].'</option>';
			    }
			}
			}

			//mysqli_close($conn);
		  
		 echo '</select>
		</div>
  
  <div class="form-group">
    <label for="hora">Hora:</label>
    <input type="time" class="form-control" id="hora" name="hora" value="'.$hora.'" readonly required>
  </div>
  
  <div class="form-group">
    <label for="cliente">Cliente:</label>
    <input type="text" class="form-control" id="cliente" name="cliente" value="'.$nombre.'" readonly required>
  </div>
  
  <button type="submit" class="btn btn-success btn-block" ><img src="../../icons/actions/dialog-ok-apply.png"  class="img-reponsive img-rounded"> Aceptar</button><br>  
</form>
<a href="../main/main.php"><button class="btn btn-primary btn-block" ><img src="../../icons/actions/go-previous-view.png"  class="img-reponsive img-rounded"> Volver</button></a>';

}

/*
** Funcion finaliza la reserva de turno en gabinete
*/
function closeReserva($id,$especialidad,$nombre,$estado,$solicitud,$conn){

    mysqli_select_db('smb_bienestar');
	$sqlInsert = "update smb_turnos_gabinete set especialidad = '$especialidad', cliente = '$nombre', estado = '$estado', solicitud = '$solicitud' where id = '$id'";
           
	$res = mysqli_query($conn,$sqlInsert);


	if($res){
		echo "<br>";
		echo '<div class="alert alert-success" role="alert">';
		echo 'Turno Solicitado Exitosamente. Aguarde un Instante que será Redireccionado';
		echo "</div>";	
	}else{
		echo "<br>";
		echo '<div class="alert alert-warning" role="alert">';
		echo "Hubo un error al Solicitar Turno!. Aguarde un Instante que será Redireccionado" .mysqli_error($conn);
		echo "</div>";
	}
}

/*
** funcion cancelar turno por parte del usuario
*/
function cancelReserva($id,$estado,$conn){
    
    mysqli_select_db('smb_bienestar');
	$sqlInsert = "update smb_turnos_gabinete set cliente = '', estado = '$estado' where id = '$id'";
           
	$res = mysqli_query($conn,$sqlInsert);


	if($res){
		echo "<br>";
		echo '<div class="alert alert-success" role="alert">';
		echo '<img src="../../icons/actions/dialog-ok-apply.png"  class="img-reponsive img-rounded"> Ha Cancelado su Turno';
		echo "</div>";	
	}else{
		echo "<br>";
		echo '<div class="alert alert-warning" role="alert">';
		echo '<img src="../../icons/status/task-attempt.png"  class="img-reponsive img-rounded"> Hubo un error al Cancelar Turno!.' .mysqli_error($conn);
		echo "</div>";
	}


}






?>
