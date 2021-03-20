<?php

/*
** Funcion que carga mensajes de usuarios
*/
function mensajes($nombre,$email,$mensaje,$conn){

    mysqli_select_db($conn,'smb_bienestar');	

	$sql = "INSERT INTO smb_mensajes ".
		"(fecha,nombre,email,mensaje)".
		"VALUES ".
      "(NOW(),'$nombre','$email','$mensaje')";
    
    $resp = mysqli_query($conn,$sql);
    
    if($resp){
            echo "<br>";
		    echo '<div class="container">';
		    echo '<div class="alert alert-success alert-dismissible">
		    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
		    echo '<img class="img-reponsive img-rounded" src="core/icons/actions/dialog-ok-apply.png" /> Su Mensaje fue enviado Satisfactoriamente.';
		    echo "</div>";
		    echo "</div>";
    }else{
			    echo "<br>";
			    echo '<div class="container">';
			    echo '<div class="alert alert-warning alert-dismissible">
			    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
			    echo '<img class="img-reponsive img-rounded" src="core/icons/status/task-attempt.png" /> Hubo un problema al intentar enviar mensaje.'  .mysqli_error($conn);
			    echo "</div>";
			    echo "</div>";
		    }


}

/*
** Funcion que carga esqueleto del sistema
*/

function skeleton(){

  echo '<link rel="stylesheet" href="/sm-bienestar/skeleton/css/bootstrap.min.css" >
	<link rel="stylesheet" href="/sm-bienestar/skeleton/css/bootstrap-theme.css" >
	<link rel="stylesheet" href="/sm-bienestar/skeleton/css/bootstrap-theme.min.css" >
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
	
	<script src="/sm-bienestar/skeleton/Chart.js/Chart.min.js"></script>
	<script src="/sm-bienestar/skeleton/Chart.js/Chart.bundle.min.js"></script>
	<script src="/sm-bienestar/skeleton/Chart.js/Chart.bundle.js"></script>
	<script src="/sm-bienestar/skeleton/Chart.js/Chart.js"></script>';
}

/*
** funcion de recepcion de mensajes
*/


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

    mysqli_select_db($conn,'smb_bienestar');
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

mysqli_select_db($conn,'smb_bienestar');	

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

    mysqli_select_db($conn,'smb_bienestar');	

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
** funcion formulario de edicion de datos de cliente
*/
function updateCliente($id,$direccion,$direccion1,$direccion2,$tel,$movil,$email,$conn){

    mysqli_select_db($conn,'smb_bienestar');
	$sqlInsert = "update smb_clientes set direccion = '$direccion', direccion1 = '$direccion1', direccion2 = '$direccion2', tel = '$tel', movil = '$movil', email = '$email' where id = '$id'";
    $res = mysqli_query($conn,$sqlInsert);


	if($res){
		echo "<br>";
		echo '<div class="alert alert-success" role="alert">';
		echo 'Cliente Actualizado Correctamente. Aguarde un Instante que será Redireccionado. ';
		echo "</div>";
		echo '<meta http-equiv="refresh" content="5;URL=../main/main.php">';
	}else{
		echo "<br>";
		echo '<div class="alert alert-warning" role="alert">';
		echo "Hubo un error al Actualizar el Cliente!. Aguarde un Instante que será Redireccionado" .mysqli_error($conn);
		echo "</div>";
		echo '<meta http-equiv="refresh" content="5;URL=../main/main.php>';
	}
	}

/*
* Funcion para cambiar avatar de usuario
*/
function uploadAvatar($id){

    echo '<div class="panel panel-success" >
	      <div class="panel-heading"><span class="pull-center "><img src="../../icons/actions/svn-commit.png"  class="img-reponsive img-rounded"> Subir Archivo';
	echo '</div><br>';
	           
                          
	echo '
	  <div class="container">
	    <div class="row">
	      <div class="col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                <strong>Seleccione el Archivo a Subir:</strong><br>
                <form action="form_update_avatar.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="'.$id.'">
                
                <input type="file" name="file"><br>
                <button type="submit" name="submit"><span class="glyphicon glyphicon-cloud-upload"></span> Subir</button>
                </form>
                <hr><a href="../main/main.php"><button type="button" class="btn btn-primary btn-block"><img src="../../icons/actions/go-previous-view.png"  class="img-reponsive img-rounded"> Volver</button></a>
                </div>
            </div>
	      </div>  
	    </div>
	  </div>';
}

function uploadFileAvatar($nombre,$conn){

// File upload path
$targetDir = '../../avatar/';
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
//$destinationPath = '../../avatar/';

if(!empty($_FILES["file"]["name"])){
    // Allow certain file formats
    $allowTypes = array('jpg','png','jpeg','gif');
    
    if(in_array($fileType, $allowTypes)){
    
        // Upload file to server
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
           
            
            // Insert image file name into database
           
           $sqlInsert = "UPDATE smb_usuarios set avatar = '$targetFilePath' where nombre = '$nombre'";
			   mysqli_select_db($conn,'smb_bienestar');
			  $insert = mysqli_query($conn,$sqlInsert);
           
           
            if($insert){
            
			  echo '<div class="alert alert-success" role="alert">';
			  echo '<h1 class="panel-title text-left" contenteditable="true"><img class="img-reponsive img-rounded" src="../../icons/actions/dialog-ok-apply.png" /><strong> Base de Datos Actualizada. El Archivo '.$fileName. ' se ha subido correctamente..</strong>';
                          echo "</div><hr>";
                          //copy($fileName, "$destinationPath/$fileName");
                          //unlink($fileName);
                          //echo '<meta http-equiv="refresh" content="5;URL=../main/main.php "/>';
                          
                                           
            }else{
		  
			  echo '<div class="alert alert-success" role="alert">';
			  echo '<h1 class="panel-title text-left" contenteditable="true"><img class="img-reponsive img-rounded" src="../../icons/actions/dialog-ok-apply.png" /><strong> El Archivo '.$fileName. ' se ha subido correctamente.</strong>';
                          echo "</div><hr>";
                          //echo '<meta http-equiv="refresh" content="5;URL=../main/main.php "/>';
                         
                
            } 
        }else{
			  echo '<div class="alert alert-warning" role="alert">';
			  echo '<h1 class="panel-title text-left" contenteditable="true"><img class="img-reponsive img-rounded" src="../../icons/actions/dialog-cancel.png" /><strong> Ups. Hubo un error subiendo el Archivo.</strong>';
                          echo "</div><hr>";
                          //echo '<meta http-equiv="refresh" content="5;URL=../main/main.php "/>';
                          
        }
    }else{
			  echo '<div class="alert alert-danger" role="alert">';
			  echo '<h1 class="panel-title text-left" contenteditable="true"><img class="img-reponsive img-rounded" src="../../icons/actions/dialog-cancel.png" /><strong> Ups, solo archivos con extensión: JPG, PNG, BMP, GIF son soportados.</strong>';
			  echo "</div><hr>";
                          //cho '<meta http-equiv="refresh" content="5;URL=../main/main.php "/>';
                        
    }
}else{
			  echo '<div class="alert alert-info" role="alert">';
                          echo '<h1 class="panel-title text-left" contenteditable="true"><img class="img-reponsive img-rounded" src="../../icons/actions/system-reboot.png" /><strong> Por favor, seleccione al archivo a subir.</strong>';
                          echo "</div><hr>";
                         // echo '<meta http-equiv="refresh" content="5;URL=../main/main.php "/>';
                          
}
}

/*
* Funcion formulario para agregar modulos de sistema al usuario
*/
function formModulos($entorno,$descripcion,$nombre,$conn){

    $sql = "select entorno as entornos from smb_usuarios where nombre = '$nombre'";
    mysqli_select_db($conn,'smb_bienestar');
    $resp = mysqli_query($conn,$sql);
    while($fila = mysqli_fetch_array($resp)){
            $entornos = $fila['entornos'];
    }

    echo '<div class="container">
            <div class="row">
            <div class="col-sm-8">
            
            <div class="panel panel-success">
            <div class="panel-heading"><img class="img-reponsive img-rounded" src="../../icons/apps/kcmdf.png" /> Suscribirse a Modulo</div>
            <div class="panel-body">
            <form action="main.php" method="POST">
            
            <div class="form-group">
                <label for="email">Usted está conectado ahora al Módulo:</label>
                <input type="text" class="form-control" id="email" value="'.$entorno.' '.$descripcion.'" readonly>
            </div><hr>
            
            <p><strong>Además ya está suscripto en los Módulos:</strong> '.$entornos.'</p><hr>
            
            
            <p><strong>Seleccione el Módulo al que desea sumarse</strong></p><hr>
             <div class="form-group">
                <label for="sel1">Módulo:</label>
                <select class="form-control" id="modulo" name="valor" required>
                    <option value="" disabled selected>Seleccionar</option>';
                    if($entorno != "VP"){
                    echo '<option value="VP">VP - Venta de Productos</option>';
                    }
                    if($entorno != "TG"){
                    echo '<option value="TG">TG - Turnos Gabinete</option>';
                    }
                    if($entorno != "TE"){
                    echo '<option value="TE">TE - Alquiler de Equipos</option>';
                    }
                    if($entorno != "VE"){
                    echo '<option value="VE">VE - Venta de Equipos</option>';
                    }
                    if($entorno != "CA"){
                    echo '<option value="CA">CA - Capacitación</option>';
                    }
                echo '</select>
                </div> 
            <button type="submit" class="btn btn-success btn-block" name="modulo">Aceptar</button>
            </form>
            </div>
            </div>
            
            </div>
            </div>
            </div>';
}

/*
* Funcion agregar modulo al usuario
*/
function addModulo($modulo,$nombre,$conn){

        mysqli_select_db($conn,'smb_bienestar');
        
	$sql = "update smb_usuarios set entorno = CONCAT(entorno,',$modulo') where nombre = '$nombre'";
    
    $resp = mysqli_query($conn,$sql);
    
    if($resp){
            echo "<br>";
		    echo '<div class="container">';
		    echo '<div class="alert alert-success" role="alert">';
		    echo '<img class="img-reponsive img-rounded" src="../../icons/actions/dialog-ok-apply.png" /> Módulo Agregado Satisfactoriamente.';
		    echo "</div>";
		    echo "</div>";
    }else{
			    echo "<br>";
			    echo '<div class="container">';
			    echo '<div class="alert alert-warning" role="alert">';
			    echo '<img class="img-reponsive img-rounded" src="../../icons/status/task-attempt.png" /> Hubo un problema al agregar el Modulo.'  .mysqli_error($conn);
			    echo "</div>";
			    echo "</div>";
		    }

}


/*
** funcion listar usuarios
*/
function loadUsers($conn){

if($conn){
	
	$sql = "SELECT * FROM smb_usuarios";
    	mysqli_select_db($conn,'smb_bienestar');
    	$resultado = mysqli_query($conn,$sql);
	//mostramos fila x fila
	$count = 0;
	echo '<div class="panel panel-success" >
	      <div class="panel-heading"><span class="pull-center "><img src="../../icons/actions/meeting-attending.png"  class="img-reponsive img-rounded"> Usuarios';
	echo '</div><br>';

            echo "<table class='display compact' style='width:100%' id='myTable'>";
              echo "<thead>
		    <th class='text-nowrap text-center'>ID</th>
		    <th class='text-nowrap text-center'>Nombre</th>
            <th class='text-nowrap text-center'>Usuario</th>
            <th class='text-nowrap text-center'>Role</th>
            <th>&nbsp;</th>
            </thead>";


	while($fila = mysqli_fetch_array($resultado)){
			  // Listado normal
			 echo "<tr>";
			 echo "<td align=center>".$fila['id']."</td>";
			 echo "<td align=center>".$fila['nombre']."</td>";
			 echo "<td align=center>".$fila['user']."</td>";
			 echo "<td align=center>".$fila['role']."</td>";
			 echo "<td class='text-nowrap'>";
			 if($fila['user'] != 'root'){
			 echo '<form action="main.php" method="POST">
                    <input type="hidden" name="id" value="'.$fila['id'].'">
                <button type="submit" name="allow" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-pencil"></span> Cambiar Permisos</button>
                </form>';
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
* Funcion para cambiar los permisos de los usuarios al sistema
*/

function cambiarPermisos($id,$role,$conn){

  $sql = "UPDATE smb_usuarios set role = '$role' where id = '$id'";
  mysqli_select_db($conn,'smb_bienestar');
  $retval = mysqli_query($conn,$sql);
  if($retval){
    
    echo "<br>";
			echo '<div class="section"><br>
			      <div class="container">
			      <div class="row">
			      <div class="col-md-12">';
			echo '<div class="alert alert-success" role="alert">';
			echo '<img class="img-reponsive img-rounded" src="../../icons/actions/dialog-ok-apply.png" /> Permiso Actualizado Satisfactoriamente';
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
			echo '<img class="img-reponsive img-rounded" src="../../icons/status/task-attempt.png" /> Hubo un Error al intentar cambiar permisos. Intente Nuevamente!';
			echo "</div>";
			echo "</div>";
			echo "</div>";
			echo "</div>";
			echo "</div>";
		}
 
}

/*
** funcion formulario de edicion de password de usuario
*/

function formEditRole($id,$conn){

      $sql = "select * from smb_usuarios where id = '$id'";
      mysqli_select_db($conn,'smb_bienestar');
      $res = mysqli_query($conn,$sql);
      $fila = mysqli_fetch_assoc($res);
      

      echo   '<h2>Cambiar Permisos</h2><hr>
	      
	      <form action="main.php" method="POST">
	      <input type="hidden" id="id" name="id" value="'.$id.'" />
   
         
	  <div class="input-group">
	    <span class="input-group-addon">Nombre y Apellido</span>
	    <input id="text" type="text" class="form-control" value="' . $fila['nombre'].'" name="nombre" value="" onkeyup="this.value=Text(this.value);" readonly required>
	  </div>
	
	  <div class="input-group">
	    <span class="input-group-addon">Usuario</span>
	    <input id="text" type="text" class="form-control" name="user" onKeyDown="limitText(this,20);" onKeyUp="limitText(this,20);" value="' . $fila['user'].'" readonly required>
	  </div><hr>
	  
	   <div class="form-group">
        <label for="sel1">Seleccione Permiso:</label>
        <select class="form-control" id="sel1" name="role" required>
            <option value="" disabled selected>Seleccionar</option>
            <option value="1" '.($fila['role'] == "1" ? "selected" : ""). '>Usuario habilitado</option>
            <option value="0" '.($fila['role'] == "0" ? "selected" : ""). '>Usuario Deshabilitado</option>
            </select>
        </div> 
	  <br>
	
	  <button type="submit" class="btn btn-success btn-block" name="roles"><img src="../../icons/actions/dialog-ok-apply.png"  class="img-reponsive img-rounded">  Cambiar Permiso</button><br><hr>
	  </form>';
	  
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
			 echo "<td align=center>"."<a href='mailto:".$fila['email']."'>".$fila['email']."</td>";
			 echo "<td class='text-nowrap'>";
			 echo '<a href="../usuarios/bio_edit.php?id='.$fila['id'].'" class="btn btn-primary btn-sm">
                    <img src="../../icons/actions/document-edit.png"  class="img-reponsive img-rounded"> Editar</a>';
			 echo '<a href="../usuarios/avatar.php?id='.$fila['id'].'" class="btn btn-warning btn-sm">
                    <img src="../../icons/actions/edit-image-face-recognize.png"  class="img-reponsive img-rounded"> Avatar</a>';
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
            
            <form action="../usuarios/form_update_cliente.php" method="POST">
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






?>
