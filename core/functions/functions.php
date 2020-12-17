<?php

/*
** Funcion que carga el skeleto del sistema
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
		    echo '<div class="alert alert-success alert-dismissible fade in">
		    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
		    echo '<img class="img-reponsive img-rounded" src="core/icons/actions/dialog-ok-apply.png" /> Su Mensaje fue enviado Satisfactoriamente.';
		    echo "</div>";
		    echo "</div>";
    }else{
			    echo "<br>";
			    echo '<div class="container">';
			    echo '<div class="alert alert-warning alert-dismissible fade in">
			    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
			    echo '<img class="img-reponsive img-rounded" src="core/icons/status/task-attempt.png" /> Hubo un problema al intentar enviar mensaje.'  .mysqli_error($conn);
			    echo "</div>";
			    echo "</div>";
		    }


}

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
			 echo '<a href="../usuarios/bio_edit.php?id='.$fila['id'].'" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-pencil"></span> Editar</a>';
			 echo '<a href="../usuarios/avatar.php?id='.$fila['id'].'" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-pencil"></span> Avatar</a>';
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
            <th class='text-nowrap text-center'>Espacio</th>
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
			 echo "<td align=center>".$fila['espacio']."</td>";
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
            <th class='text-nowrap text-center'>Espacio</th>
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
			 echo "<td align=center>".$fila['espacio']."</td>";
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
    $espacio = $row['espacio'];
}

 echo '<form action="form_reserva.php" method="POST">
        <input type="hidden" class="form-control" id="id" name="id" value="'.$id.'">
  
  <div class="form-group">
    <label for="f_turno">Fecha Turno:</label>
    <input type="date" class="form-control" id="f_turno" name="f_turno" value="'.$fecha.'" readonly required>
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
    <label for="cliente">Espacio:</label>
    <input type="text" class="form-control" id="espacio" name="espacio" value="'.$espacio.'" readonly required>
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
	$sqlInsert = "update smb_turnos_gabinete set cliente = 'NULL', especialidad = 'NULL', estado = '$estado' where id = '$id'";
           
	$res = mysqli_query($conn,$sqlInsert);


	if($res){
		echo "<br>";
		echo '<div class="alert alert-success" alert-dismissible role="alert">';
		echo '<img src="../../icons/actions/dialog-ok-apply.png"  class="img-reponsive img-rounded"> Ha Cancelado su Turno';
		echo "</div>";	
	}else{
		echo "<br>";
		echo '<div class="alert alert-warning" alert-dismissible role="alert">';
		echo '<img src="../../icons/status/task-attempt.png"  class="img-reponsive img-rounded"> Hubo un error al Cancelar Turno!.' .mysqli_error($conn);
		echo "</div>";
	}


}

////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////// FIN SECCION TURNOS GABINETE ///////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////// SECCION TURNOS EQUIPOS /////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/*
** funcion ver turnos disponibles EQUIPOS(entorno de usuario)
*/
function equiposTurnos($conn){

if($conn){
	
	$sql = "SELECT * FROM smb_turnos_equipos where estado = 'Ocupado'";
    	mysqli_select_db($conn,'smb_bienestar');
    	$resultado = mysqli_query($conn,$sql);
	//mostramos fila x fila
	$count = 0;
	echo '<div class="panel panel-success" >
	      <div class="panel-heading"><span class="pull-center "><img src="../../icons/actions/view-calendar-timeline.png"  class="img-reponsive img-rounded"> EQUIPOS - Turnos Tomados';
	echo '</div><br>
            <p><strong>Nota:</strong> Aquí se encuentran todos los equipos que han sido tomados, aquellos que aparecen en color Rojo sobre la fecha, significa que ya fueron tomados, si desea tomar un turno, presione el botón <strong>Reservar</strong> y podrá tramitar dicho turno</p><hr>';

            echo "<table class='display compact' style='width:100%' id='myTable'>";
              echo "<thead>
		    <th class='text-nowrap text-center'>ID</th>
		    <th class='text-nowrap text-center'>Fecha</th>
		    <th class='text-nowrap text-center'>Equipo</th>
            <th class='text-nowrap text-center'>Hora Desde</th>
            <th class='text-nowrap text-center'>Hora Hasta</th>
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
			 echo "<td align=center>".$fila['equipo']."</td>";
			 echo "<td align=center>".$fila['hora_desde']."</td>";
			 echo "<td align=center>".$fila['hora_hasta']."</td>";
			 echo "<td class='text-nowrap'>";
			 echo "</td>";
			 $count++;
		}

		echo "</table>";
		echo "<br>";
		echo '<form <action="main.php" method="POST">
		<button type="submit" class="btn btn-success" name="reservar"><img src="../../icons/actions/flag-blue.png"  class="img-reponsive img-rounded"> Reservar</button><br>  
        </form>';
		echo '</div>';
		}else{
		  echo 'Connection Failure...';
		}

    mysqli_close($conn);

}


/*
** funcion ver turnos solicitados por usuario EQUIPOS(entorno de usuario)
*/
function equiposTurnosUser($nombre,$conn){

if($conn){
	
	$sql = "SELECT * FROM smb_turnos_equipos where cliente = '$nombre'";
    	mysqli_select_db($conn,'smb_bienestar');
    	$resultado = mysqli_query($conn,$sql);
	//mostramos fila x fila
	$count = 0;
	echo '<div class="panel panel-success" >
	      <div class="panel-heading"><span class="pull-center "><img src="../../icons/actions/view-calendar-timeline.png"  class="img-reponsive img-rounded"> EQUIPOS - Mis Turnos Reservados';
	echo '</div><br>
            <p><strong>Nota:</strong> Aquí se encuentran todos los equipos que usted ha reservado para alquiler, aquellos que aparecen en color Rojo sobre la fecha, significa que fueron Cancelados, en color verde Confirmados y en color Amarillo están en estado Stand-By a la espera de confirmación de parte del administrador</p><hr>';

            echo "<table class='display compact' style='width:100%' id='myTable'>";
              echo "<thead>
		    <th class='text-nowrap text-center'>ID</th>
		    <th class='text-nowrap text-center'>Fecha</th>
		    <th class='text-nowrap text-center'>Equipo</th>
            <th class='text-nowrap text-center'>Hora Desde</th>
            <th class='text-nowrap text-center'>Hora Hasta</th>
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
			 echo '<td align=center style="background-color:green"><font color="black">'.$fila['f_turno'].'</font></td>';
			 }
			 if($fila['solicitud'] == 'Cancelado'){
			 echo '<td align=center style="background-color:red"><font color="white">'.$fila['f_turno'].'</font></td>';
			 }
			 echo "<td align=center>".$fila['equipo']."</td>";
			 echo "<td align=center>".$fila['hora_desde']."</td>";
			 echo "<td align=center>".$fila['hora_hasta']."</td>";
			 echo "<td class='text-nowrap'>";
			 echo '<a data-toggle="modal" data-target="#myModal" href="#" data-id="'.$fila['id'].'" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove-circle"></span> Cancelar Reserva</button></a>';
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
** funcion formulario de solicutd turno equipos
*/
function formReservaEquipo($nombre,$conn){

$sql = "select * from smb_clientes where nombre = '$nombre'";
mysqli_select_db($conn,'smb_bienestar');
$resp = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($resp)){
        $direccion = $row['direccion'];
        $direccion1 = $row['direccion1'];
        $direccion2 = $row['direccion2'];
        $dni = $row['dni'];
        $movil = $row['movil'];
}
  
  
 echo '<div class="container">
        <div class="row">
        <div class="col-sm-8">
        
        <div class="panel panel-success">
        <div class="panel-heading"><img src="../../icons/actions/flag-blue.png"  class="img-reponsive img-rounded"> Solicitud Alquier Equipo</div>
        <div class="panel-body">';
        
 echo '<form action="main.php" method="POST">
          
  <div class="form-group">
    <label for="f_turno">Fecha Turno:</label>
    <input type="date" class="form-control" id="f_turno" name="f_turno" min = '.$hoy=date("Y-m-d").' '.$hoy.' required>
  </div><hr>
  
  <p><strong>Seleccione la Dirección a donde desea que le Entreguen el Equipo si posee más de una.</strong></p>
   <div class="radio">
    <label><input type="radio" name="direccion" value="'.$direccion.'" checked > '.$direccion.'</label>
    </div>
    <div class="radio">
    <label><input type="radio" name="direccion" value"'.$direccion1.'" > '.$direccion1.'</label>
    </div>
    <div class="radio ">
    <label><input type="radio" name="direccion" value"'.$direccion2.'" > '.$direccion2.'</label>
    </div><hr>
    
    <p><strong>Especifique a partir de que hora.</strong</p>
    <div class="form-group">
    <label for="usr">Hora:</label>
    <input type="time" class="form-control" id="usr" name="hora_desde" min="08:00" max="20:00" required>
    </div><hr>
    
    <p><strong>Ingrese Cantidad de Horas de alquiler.</strong></<p>
    
    <div class="checkbox">
    <label><input type="radio" value="06:00" name="cantidad_horas" > 6 Horas</label>
    </div>
    <div class="checkbox">
    <label><input type="radio" value="08:00" name="cantidad_horas" > 8 Horas</label>
    </div>
    <div class="checkbox ">
    <label><input type="radio" value="12:00" name="cantidad_horas"> 12 Horas</label>
    </div><hr>
  
         <div class="form-group">
		  <label for="sel1">Equipo:</label>
		  <select class="form-control" name="equipo" required>
		  <option value="" disabled selected>Seleccionar</option>';
		    
		    if($conn){

		      $query = "SELECT * FROM smb_equipos";
		      mysqli_select_db('smb_bienestar');
		      $res = mysqli_query($conn,$query);

		      if($res)
		      {
			
			  while ($valores = mysqli_fetch_array($res))
			    {
				echo '<option value="'.$valores[cod_equipo].'">'.$valores[modelo].'</option>';
			    }
			}
			}

			//mysqli_close($conn);
		  
		 echo '</select>
		</div><hr>
  
  <h2><strong>Datos del Cliente</strong></h2><hr>
   <div class="form-group">
    <label for="cliente">Cliente:</label>
    <input type="text" class="form-control" id="cliente" name="cliente" value="'.$nombre.'" readonly required>
  </div>
  
  <div class="form-group">
    <label for="hora">DNI:</label>
    <input type="text" class="form-control" id="hora" name="dni" value="'.$dni.'" readonly required>
  </div>
  
  <div class="form-group">
    <label for="hora">Movil:</label>
    <input type="text" class="form-control" id="hora" name="movil" value="'.$movil.'" readonly required>
  </div><hr>
  
  <button type="submit" class="btn btn-success btn-block" name="reserva_ok"><img src="../../icons/actions/dialog-ok-apply.png"  class="img-reponsive img-rounded"> Aceptar</button><br>  
</form>

</div></div></div>
    </div>
    </div>';

}

/*
** funcion sumar horas
*/
    function suma_horas($hora1,$hora2){

    $hora1=explode(":",$hora1);
    $hora2=explode(":",$hora2);
    $temp=0;

   //sumo segundos 

    $segundos=(int)$hora1[2]+(int)$hora2[2];
    while($segundos>=60){
        $segundos=$segundos-60;
        $temp++;
    }

    //sumo minutos 
    $minutos=(int)$hora1[1]+(int)$hora2[1]+$temp;
    $temp=0;
    while($minutos>=60){
        $minutos=$minutos-60;
        $temp++;
    }

    //sumo horas 
    $horas=(int)$hora1[0]+(int)$hora2[0]+$temp;

    if($horas<10)
        $horas= '0'.$horas;

    if($minutos<10)
        $minutos= '0'.$minutos;

    if($segundos<10)
        $segundos= '0'.$segundos;

    $sum_hrs = $horas.':'.$minutos.':'.$segundos;

    return ($sum_hrs);

    }
    
    
/*
** funcion restar horas
*/
function restar_horas($hora1,$hora2){

    $temp1 = explode(":",$hora1);
    $temp_h1 = (int)$temp1[0];
    $temp_m1 = (int)$temp1[1];
    $temp_s1 = (int)$temp1[2];
    $temp2 = explode(":",$hora2);
    $temp_h2 = (int)$temp2[0];
    $temp_m2 = (int)$temp2[1];
    $temp_s2 = (int)$temp2[2];
    // si $hora2 es mayor que la $hora1, invierto 
    if( $temp_h1 < $temp_h2 ){

        $temp  = $hora1;
        $hora1 = $hora2;
        $hora2 = $temp;

    }

    /* si $hora2 es igual $hora1 y los minutos de 
       $hora2 son mayor que los de $hora1, invierto*/

    elseif( $temp_h1 == $temp_h2 && $temp_m1 < $temp_m2){
        $temp  = $hora1;
        $hora1 = $hora2;
        $hora2 = $temp;

    }

    /* horas y minutos iguales, si los segundos de  
       $hora2 son mayores que los de $hora1,invierto*/

    elseif( $temp_h1 == $temp_h2 && $temp_m1 == $temp_m2 && $temp_s1 < $temp_s2){
        $temp  = $hora1;
        $hora1 = $hora2;
        $hora2 = $temp;

    }

    $hora1=explode(":",$hora1);
    $hora2=explode(":",$hora2);
    $temp_horas = 0;
    $temp_minutos = 0;

    //resto segundos 
    $segundos;
    if( (int)$hora1[2] < (int)$hora2[2] ){
        $temp_minutos = -1;
        $segundos = ( (int)$hora1[2] + 60 ) - (int)$hora2[2];
      }else{

        $segundos = (int)$hora1[2] - (int)$hora2[2];
        }
        
    //resto minutos 
    $minutos;

    if( (int)$hora1[1] < (int)$hora2[1] ){
        $temp_horas = -1;
        $minutos = ( (int)$hora1[1] + 60 ) - (int)$hora2[1] + $temp_minutos;
    }else{
        $minutos =  (int)$hora1[1] - (int)$hora2[1] + $temp_minutos; 
     }
    //resto horas     
    $horas = (int)$hora1[0]  - (int)$hora2[0] + $temp_horas;

    if($horas<10)
        $horas= '0'.$horas;

        if($minutos<10)
            $minutos= '0'.$minutos;
      
           if($segundos<10)
               $segundos= '0'.$segundos;

    $rst_hrs = $horas.':'.$minutos.':'.$segundos;

     return ($rst_hrs);
     
     }

/*
** funcion formulario de solicutd turno equipos
*/
function addTurnoEquipo($f_turno,$direccion,$hora_desde,$cantidad_horas,$equipo,$cliente,$dni,$movil,$conn){
    
    $hora_hasta = suma_horas($hora_desde,$cantidad_horas);
    $estado = 'Ocupado';
    $solicitud = 'Stand-By';
           
    mysqli_select_db($conn,'smb_bienestar');	

	$sql = "INSERT INTO smb_turnos_equipos ".
		"(f_turno,direccion,equipo,hora_desde,hora_hasta,cliente,dni,movil,estado,solicitud)".
		"VALUES ".
      "('$f_turno','$direccion','$equipo','$hora_desde','$hora_hasta','$cliente','$dni','$movil','$estado','$solicitud')";
    
    $resp = mysqli_query($conn,$sql);
    
    if($resp){
            echo "<br>";
		    echo '<div class="container">';
		    echo '<div class="alert alert-success" alert-dismissible role="alert">';
		    echo '<img class="img-reponsive img-rounded" src="../../icons/actions/dialog-ok-apply.png" /> Turno Gestionado Satisfactoriamente.';
		    echo "</div>";
		    echo "</div>";
    }else{
			    echo "<br>";
			    echo '<div class="container">';
			    echo '<div class="alert alert-warning" alert-dismissible role="alert">';
			    echo '<img class="img-reponsive img-rounded" src="../../icons/status/task-attempt.png" /> Hubo un problema al Gestionar el Turno.'  .mysqli_error($conn);
			    echo "</div>";
			    echo "</div>";
		    }

}


/*
** funcion cancelar turno de alquiler de equipo por parte del usuario
*/
function cancelReservaEquipo($id,$estado,$conn){
    
    mysqli_select_db($conn,'smb_bienestar');
	$sqlInsert = "delete from smb_turnos_equipos where id = '$id'";
           
	$res = mysqli_query($conn,$sqlInsert);


	if($res){
		echo "<br>";
		echo '<div class="alert alert-success" alert-dismissible role="alert">';
		echo '<img src="../../icons/actions/dialog-ok-apply.png"  class="img-reponsive img-rounded"> Ha Cancelado su Turno';
		echo "</div>";	
	}else{
		echo "<br>";
		echo '<div class="alert alert-warning" alert-dismissible role="alert">';
		echo '<img src="../../icons/status/task-attempt.png"  class="img-reponsive img-rounded"> Hubo un error al Cancelar Turno!.' .mysqli_error($conn);
		echo "</div>";
	}


}







////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////// FIN SECCION TURNOS EQUIPOS ////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////// SECCION VENTA PRODUCTOS /////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////

/*
** funciion de carga de cartelera
*/
function cartelera($conn){

if($conn)
{
	$sql = "SELECT * FROM smb_productos";
    	mysqli_select_db($conn,'smb_bienestar');
    	$resultado = mysqli_query($conn,$sql);
	//mostramos fila x fila
	$count = 0;
	echo '<div class="panel panel-default" >
	      <div class="panel-heading"><span class="pull-center "><img src="../../icons/status/mail-tagged.png"  class="img-reponsive img-rounded"> Productos';
	echo '</div><br>';

            echo "<table class='display compact' style='width:100%' id='myTable'>";
              echo "<thead>
		    <th class='text-nowrap text-center'>ID</th>
		    <th class='text-nowrap text-center'>Imagen</th>
		    <th class='text-nowrap text-center'>Codigo Producto</th>
		    <th class='text-nowrap text-center'>Marca</th>
		    <th class='text-nowrap text-center'>Descripción</th>
                    <th class='text-nowrap text-center'>Precio</th>
                    
                    <th>&nbsp;</th>
                    </thead>";


	while($fila = mysqli_fetch_array($resultado)){
			  // Listado normal
			 echo "<tr>";
			 echo "<td align=center>".$fila['id']."</td>";
			 echo "<td align=center><img src='$fila[picture]' alt='Avatar' class='avatar' ></td>";
			 echo "<td align=center>".$fila['cod_producto']."</td>";
			 echo "<td align=center>".$fila['marca']."</td>";
			 echo "<td align=center>".$fila['descripcion']."</td>";
			 echo "<td align=center>".$fila['precio']."</td>";
			 echo "<td class='text-nowrap'>";
			 echo '<a href="../pedidos/newPedido.php?id='.$fila['id'].'" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-shopping-cart"></span> Hacer Pedido</a>';
			 echo "</td>";
			 $count++;
		}

		echo "</table>";
		echo "<br>";
		echo '<button type="button" class="btn btn-primary">Cantidad de Registros:  ' .$count; echo '</button>';
		echo '</div>';
		}else{
		  echo 'Connection Failure...';
		}

    mysqli_close($conn);
}

?>
