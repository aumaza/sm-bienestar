<?php


/*
** funcion para filtrar los mensajes informativos que desea generar o modificar
*/
function formMensajesInformativos(){
  
   echo '<div class="alert alert-info" align="center">
	  <h3>Mensajes Informativos para espacios de usuario</h3>
	  <p>Seleccionar los mensajes informativos que desee generar o modificar</p>
	 </div><hr>
   
	  <form action="main.php" method="POST">
	    	    
	    <div class="form-group">
	      <label>Seleccione tipo de mensajes:</label>
	      <select class="form-control" name="info_mensajes" required>
		<option value="" disabled selected>Seleccionar</option>
		<option value="i_gabinete">Mensajes Gabinete</option>
		<option value="i_equipos">Mensajes Equipos</option>
		<option value="i_productos">Mensajes Productos</option>
	      </select>
	    </div><hr>
	    
	     
	  <div class="alert alert-success" align="center">
	   <button type="submit" class="btn btn-default" name="i_mensajes">
	      <img src="../../icons/actions/dialog-ok-apply.png"  class="img-reponsive img-rounded"> Aceptar</button>
      </div>
	 </form><br>';
  
  
}


/*
** funcion para editar / borrar / agregar mensajes en espacio alquiler de equipos
*/
function getMensajesInfoEquipos($conn){


if($conn){
	
	$sql = "SELECT * FROM smb_info_aequipos";
    	mysqli_select_db($conn,'smb_bienestar');
    	$resultado = mysqli_query($conn,$sql);
	//mostramos fila x fila
	$count = 0;
	echo '<div class="panel panel-success" >
	      <div class="panel-heading"><span class="pull-center "><img src="../../icons/actions/mail-mark-unread-new.png"  class="img-reponsive img-rounded"> Mensajes Informativos para Espacio Alquiler de Equipos';
	echo '</div><br>';

            echo "<table class='display compact' style='width:100%' id='myTable'>";
              echo "<thead>
		    <th class='text-nowrap text-center'>ID</th>
		    <th class='text-nowrap text-center'>Mensaje</th>
            <th>&nbsp;</th>
            </thead>";


	while($fila = mysqli_fetch_array($resultado)){
			  // Listado normal
			 echo "<tr>";
			 echo "<td align=center>".$fila['id']."</td>";
			 echo "<td align=center>".$fila['mensaje']."</td>";
			 echo "<td class='text-nowrap'>";
			  echo '<form <action="main.php" method="POST">
                    <input type="hidden" name="id" value="'.$fila['id'].'">
                    <button type="submit" class="btn btn-success btn-sm" name="edit_imensage_aequipos"><img src="../../icons/actions/document-edit.png"  class="img-reponsive img-rounded"> Editar</button>
                    <button type="submit" class="btn btn-danger btn-sm" name="del_imensage_aequipos"><img src="../../icons/actions/edit-delete.png"  class="img-reponsive img-rounded"> Eliminar</button>
                    </form>';
			 echo "</td>";
			 $count++;
		}

		echo "</table>";
		echo "<br>";
		echo '<form <action="main.php" method="POST">
                    <button type="submit" class="btn btn-default btn-sm" name="add_imensage_aequipos"><img src="../../icons/actions/list-add.png"  class="img-reponsive img-rounded"> Nuevo Mensaje</button>
                   </form>';
		echo '</div>';
		}else{
		  echo 'Connection Failure...';
		}

    mysqli_close($conn);

}

/*
** funcion para editar / borrar / agregar mensajes en espacio turnos gabinete
*/
function getMensajesInfoGabinete($conn){


if($conn){
	
	$sql = "SELECT * FROM smb_info_gabinete";
    	mysqli_select_db($conn,'smb_bienestar');
    	$resultado = mysqli_query($conn,$sql);
	//mostramos fila x fila
	$count = 0;
	echo '<div class="panel panel-success" >
	      <div class="panel-heading"><span class="pull-center "><img src="../../icons/actions/mail-mark-unread-new.png"  class="img-reponsive img-rounded"> Mensajes Informativos para Espacio Turnos Gabinete';
	echo '</div><br>';

            echo "<table class='display compact' style='width:100%' id='myTable'>";
              echo "<thead>
		    <th class='text-nowrap text-center'>ID</th>
		    <th class='text-nowrap text-center'>Mensaje</th>
            <th>&nbsp;</th>
            </thead>";


	while($fila = mysqli_fetch_array($resultado)){
			  // Listado normal
			 echo "<tr>";
			 echo "<td align=center>".$fila['id']."</td>";
			 echo "<td align=center>".$fila['mensaje']."</td>";
			 echo "<td class='text-nowrap'>";
			  echo '<form <action="main.php" method="POST">
                    <input type="hidden" name="id" value="'.$fila['id'].'">
                    <button type="submit" class="btn btn-success btn-sm" name="edit_imensage_gabinete"><img src="../../icons/actions/document-edit.png"  class="img-reponsive img-rounded"> Editar</button>
                    <button type="submit" class="btn btn-danger btn-sm" name="del_imensage_gabinete"><img src="../../icons/actions/edit-delete.png"  class="img-reponsive img-rounded"> Eliminar</button>
                    </form>';
			 echo "</td>";
			 $count++;
		}

		echo "</table>";
		echo "<br>";
		echo '<form <action="main.php" method="POST">
                    <button type="submit" class="btn btn-default btn-sm" name="add_imensage_gabinete"><img src="../../icons/actions/list-add.png"  class="img-reponsive img-rounded"> Nuevo Mensaje</button>
                   </form>';
		echo '</div>';
		}else{
		  echo 'Connection Failure...';
		}

    mysqli_close($conn);

}

/*
** funcion para editar / borrar / agregar mensajes en espacio venta de productos
*/
function getMensajesInfoProductos($conn){


if($conn){
	
	$sql = "SELECT * FROM smb_info_productos";
    	mysqli_select_db($conn,'smb_bienestar');
    	$resultado = mysqli_query($conn,$sql);
	//mostramos fila x fila
	$count = 0;
	echo '<div class="panel panel-success" >
	      <div class="panel-heading"><span class="pull-center "><img src="../../icons/actions/mail-mark-unread-new.png"  class="img-reponsive img-rounded"> Mensajes Informativos para Espacio Venta de Productos';
	echo '</div><br>';

            echo "<table class='display compact' style='width:100%' id='myTable'>";
              echo "<thead>
		    <th class='text-nowrap text-center'>ID</th>
		    <th class='text-nowrap text-center'>Mensaje</th>
            <th>&nbsp;</th>
            </thead>";


	while($fila = mysqli_fetch_array($resultado)){
			  // Listado normal
			 echo "<tr>";
			 echo "<td align=center>".$fila['id']."</td>";
			 echo "<td align=center>".$fila['mensaje']."</td>";
			 echo "<td class='text-nowrap'>";
			  echo '<form <action="main.php" method="POST">
                    <input type="hidden" name="id" value="'.$fila['id'].'">
                    <button type="submit" class="btn btn-success btn-sm" name="edit_imensage_productos"><img src="../../icons/actions/document-edit.png"  class="img-reponsive img-rounded"> Editar</button>
                    <button type="submit" class="btn btn-danger btn-sm" name="del_imensage_productos"><img src="../../icons/actions/edit-delete.png"  class="img-reponsive img-rounded"> Eliminar</button>
                    </form>';
			 echo "</td>";
			 $count++;
		}

		echo "</table>";
		echo "<br>";
		echo '<form <action="main.php" method="POST">
                    <button type="submit" class="btn btn-default btn-sm" name="add_imensage_productos"><img src="../../icons/actions/list-add.png"  class="img-reponsive img-rounded"> Nuevo Mensaje</button>
                   </form>';
		echo '</div>';
		}else{
		  echo 'Connection Failure...';
		}

    mysqli_close($conn);

}


/*
** funcion para cargar formulario de nuevo mensaje informativo para turnos gabinete
*/
function formNewMensajesGabinete(){
  
    
   echo '<div class="alert alert-info" align="center">
	  <h3>Mensajes Informativos para espacio de usuario en Turnos Gabinete</h3>
	  <p>Nuevo Mensaje</p>
	 </div><hr>
   
	  <form action="main.php" method="POST">
                
	     <div class="form-group">
            <label for="comment">Mensaje:</label>
            <textarea class="form-control" name="mensaje_gabinete" rows="5" id="comment" maxlength="240"></textarea>
         </div><hr>
	    
	     
	  <div class="alert alert-success" align="center">
	   <button type="submit" class="btn btn-default" name="new_mensajes_gabinete">
	      <img src="../../icons/actions/dialog-ok-apply.png"  class="img-reponsive img-rounded"> Guardar</button>
      </div>
	 </form><br>';
  
  
}


/*
** funcion para cargar formulario de edicion de mensaje informativo para turnos gabinete
*/
function formEditMensajesGabinete($id,$conn){
  
  $sql = "select * from smb_info_gabinete where id = '$id'";
  mysqli_select_db($conn,'smb_bienestar');
  $query = mysqli_query($conn,$sql);
  while($row = mysqli_fetch_array($query)){
        $mensaje = $row['mensaje'];
  }
  
   echo '<div class="alert alert-info" align="center">
	  <h3>Mensajes Informativos para espacio de usuario en Turnos Gabinete</h3>
	  <p>Editar Mensaje</p>
	 </div><hr>
   
	  <form action="main.php" method="POST">
        <input type="hidden" name="id" value="'.$id.'">
        
	     <div class="form-group">
            <label for="comment">Mensaje:</label>
            <textarea class="form-control" name="mensaje_gabinete" rows="5" id="comment" maxlength="240">'.$mensaje.'</textarea>
         </div><hr>
	    
	     
	  <div class="alert alert-success" align="center">
	   <button type="submit" class="btn btn-default" name="update_mensajes_gabinete">
	      <img src="../../icons/actions/dialog-ok-apply.png"  class="img-reponsive img-rounded"> Guardar</button>
      </div>
	 </form><br>';
  
  
}



/*
** funcion para cargar formulario de nuevo mensaje informativo para turnos alquiler de equipos
*/
function formNewMensajesAEquipos(){
  
    
   echo '<div class="alert alert-info" align="center">
	  <h3>Mensajes Informativos para espacio de usuario en Turnos Alquiler de Equipos</h3>
	  <p>Nuevo Mensaje</p>
	 </div><hr>
   
	  <form action="main.php" method="POST">
                
	     <div class="form-group">
            <label for="comment">Mensaje:</label>
            <textarea class="form-control" name="mensaje_equipos" rows="5" id="comment" maxlength="240"></textarea>
         </div><hr>
	    
	     
	  <div class="alert alert-success" align="center">
	   <button type="submit" class="btn btn-default" name="new_mensajes_aequipos">
	      <img src="../../icons/actions/dialog-ok-apply.png"  class="img-reponsive img-rounded"> Guardar</button>
      </div>
	 </form><br>';
  
  
}


/*
** funcion para cargar formulario de edicion de mensaje informativo para turnos alquiler de equipos
*/
function formEditMensajesAEquipos($id,$conn){
  
  $sql = "select * from smb_info_aequipos where id = '$id'";
  mysqli_select_db($conn,'smb_bienestar');
  $query = mysqli_query($conn,$sql);
  while($row = mysqli_fetch_array($query)){
        $mensaje = $row['mensaje'];
  }
  
   echo '<div class="alert alert-info" align="center">
	  <h3>Mensajes Informativos para espacio de usuario en Turnos Alquiler de Equipos</h3>
	  <p>Editar Mensaje</p>
	 </div><hr>
   
	  <form action="main.php" method="POST">
        <input type="hidden" name="id" value="'.$id.'">
        
	     <div class="form-group">
            <label for="comment">Mensaje:</label>
            <textarea class="form-control" name="mensaje_aequipos" rows="5" id="comment" maxlength="240">'.$mensaje.'</textarea>
         </div><hr>
	    
	     
	  <div class="alert alert-success" align="center">
	   <button type="submit" class="btn btn-default" name="update_mensajes_aequipos">
	      <img src="../../icons/actions/dialog-ok-apply.png"  class="img-reponsive img-rounded"> Guardar</button>
      </div>
	 </form><br>';
  
  
}


/*
** funcion para cargar formulario de nuevo mensaje informativo para Venta de Productos
*/
function formNewMensajesProductos(){
  
    
   echo '<div class="alert alert-info" align="center">
	  <h3>Mensajes Informativos para espacio de usuario en Venta de Productos</h3>
	  <p>Nuevo Mensaje</p>
	 </div><hr>
   
	  <form action="main.php" method="POST">
                
	     <div class="form-group">
            <label for="comment">Mensaje:</label>
            <textarea class="form-control" name="mensaje_productos" rows="5" id="comment" maxlength="240"></textarea>
         </div><hr>
	    
	     
	  <div class="alert alert-success" align="center">
	   <button type="submit" class="btn btn-default" name="new_mensajes_productos">
	      <img src="../../icons/actions/dialog-ok-apply.png"  class="img-reponsive img-rounded"> Guardar</button>
      </div>
	 </form><br>';
  
  
}

/*
** funcion para cargar formulario de edicion de mensaje informativo para turnos alquiler de equipos
*/
function formEditMensajesProductos($id,$conn){
  
  $sql = "select * from smb_info_productos where id = '$id'";
  mysqli_select_db($conn,'smb_bienestar');
  $query = mysqli_query($conn,$sql);
  while($row = mysqli_fetch_array($query)){
        $mensaje = $row['mensaje'];
  }
  
   echo '<div class="alert alert-info" align="center">
	  <h3>Mensajes Informativos para espacio de usuario en Compra de Productos</h3>
	  <p>Editar Mensaje</p>
	 </div><hr>
   
	  <form action="main.php" method="POST">
        <input type="hidden" name="id" value="'.$id.'">
        
	     <div class="form-group">
            <label for="comment">Mensaje:</label>
            <textarea class="form-control" name="mensaje_productos" rows="5" id="comment" maxlength="240">'.$mensaje.'</textarea>
         </div><hr>
	    
	     
	  <div class="alert alert-success" align="center">
	   <button type="submit" class="btn btn-default" name="update_mensajes_productos">
	      <img src="../../icons/actions/dialog-ok-apply.png"  class="img-reponsive img-rounded"> Guardar</button>
      </div>
	 </form><br>';
  
  
}


/*
** funcion actualizar mensaje informativo turno gabinete
*/
function updateMensajeGabinete($id,$mensaje,$conn){

    $sql = "update smb_info_gabinete set mensaje = '$mensaje' where id = '$id'";
    mysqli_select_db($conn,'smb_bienestar');
    $query = mysqli_query($conn,$sql);
    
    if($query){
            echo "<br>";
		    echo '<div class="container">';
		    echo '<div class="alert alert-success" role="alert">';
		    echo '<img class="img-reponsive img-rounded" src="../../icons/actions/dialog-ok-apply.png" /> Mensaje Actualizado Satisfactoriamente.';
		    echo "</div>";
		    echo "</div>";
    }else{
			    echo "<br>";
			    echo '<div class="container">';
			    echo '<div class="alert alert-warning" role="alert">';
			    echo '<img class="img-reponsive img-rounded" src="../../icons/status/task-attempt.png" /> Hubo un problema al actualizar el Mensaje.'  .mysqli_error($conn);
			    echo "</div>";
			    echo "</div>";
		    }

}


/*
** funcion actualizar mensaje informativo turno alquiler equipos
*/
function updateMensajeAEquipos($id,$mensaje,$conn){

    $sql = "update smb_info_aequipos set mensaje = '$mensaje' where id = '$id'";
    mysqli_select_db($conn,'smb_bienestar');
    $query = mysqli_query($conn,$sql);
    
    if($query){
            echo "<br>";
		    echo '<div class="container">';
		    echo '<div class="alert alert-success" role="alert">';
		    echo '<img class="img-reponsive img-rounded" src="../../icons/actions/dialog-ok-apply.png" /> Mensaje Actualizado Satisfactoriamente.';
		    echo "</div>";
		    echo "</div>";
    }else{
			    echo "<br>";
			    echo '<div class="container">';
			    echo '<div class="alert alert-warning" role="alert">';
			    echo '<img class="img-reponsive img-rounded" src="../../icons/status/task-attempt.png" /> Hubo un problema al actualizar el Mensaje.'  .mysqli_error($conn);
			    echo "</div>";
			    echo "</div>";
		    }

}


/*
** funcion actualizar mensaje informativo turno alquiler equipos
*/
function updateMensajeProductos($id,$mensaje,$conn){

    $sql = "update smb_info_productos set mensaje = '$mensaje' where id = '$id'";
    mysqli_select_db($conn,'smb_bienestar');
    $query = mysqli_query($conn,$sql);
    
    if($query){
            echo "<br>";
		    echo '<div class="container">';
		    echo '<div class="alert alert-success" role="alert">';
		    echo '<img class="img-reponsive img-rounded" src="../../icons/actions/dialog-ok-apply.png" /> Mensaje Actualizado Satisfactoriamente.';
		    echo "</div>";
		    echo "</div>";
    }else{
			    echo "<br>";
			    echo '<div class="container">';
			    echo '<div class="alert alert-warning" role="alert">';
			    echo '<img class="img-reponsive img-rounded" src="../../icons/status/task-attempt.png" /> Hubo un problema al actualizar el Mensaje.'  .mysqli_error($conn);
			    echo "</div>";
			    echo "</div>";
		    }

}


/*
** funcion persistencia de mensaje nuevo en espacio de usuario para Turnos Gabinete
*/
function addMensajeGabinete($mensaje,$conn){

        $sql = "INSERT INTO smb_info_gabinete".
            "(mensaje)".
            "VALUES ".
        "('$mensaje')";
        mysqli_select_db($conn,'smb_bienestar');
        $resp = mysqli_query($conn,$sql);
        
        
        if($resp){
            echo "<br>";
		    echo '<div class="container">';
		    echo '<div class="alert alert-success" alert-dismissible">
		    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
		    echo '<img class="img-reponsive img-rounded" src="../../icons/actions/dialog-ok-apply.png" /> Mensaje Guardado Satisfactoriamente.';
		    echo "</div>";
		    echo "</div>";
    }else{
			    echo "<br>";
			    echo '<div class="container">';
                echo '<div class="alert alert-warning" alert-dismissible">
			    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
			    echo '<img class="img-reponsive img-rounded" src="../../icons/status/task-attempt.png" /> Hubo un problema al Guardar el Mensaje. '  .mysqli_error($conn);
			    echo "</div>";
			    echo "</div>";
		    }

}

/*
** funcion persistencia de mensaje nuevo en espacio de usuario para Turnos Alquiler de equipos
*/
function addMensajeAEquipos($mensaje,$conn){

        $sql = "INSERT INTO smb_info_aequipos".
            "(mensaje)".
            "VALUES ".
        "('$mensaje')";
        mysqli_select_db($conn,'smb_bienestar');
        $resp = mysqli_query($conn,$sql);
        
        
        if($resp){
            echo "<br>";
		    echo '<div class="container">';
		    echo '<div class="alert alert-success" alert-dismissible">
		    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
		    echo '<img class="img-reponsive img-rounded" src="../../icons/actions/dialog-ok-apply.png" /> Mensaje Guardado Satisfactoriamente.';
		    echo "</div>";
		    echo "</div>";
    }else{
			    echo "<br>";
			    echo '<div class="container">';
                echo '<div class="alert alert-warning" alert-dismissible">
			    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
			    echo '<img class="img-reponsive img-rounded" src="../../icons/status/task-attempt.png" /> Hubo un problema al Guardar el Mensaje. '  .mysqli_error($conn);
			    echo "</div>";
			    echo "</div>";
		    }

}



/*
** funcion persistencia de mensaje nuevo en espacio de usuario para Venta de Productos
*/
function addMensajeProductos($mensaje,$conn){

        $sql = "INSERT INTO smb_info_productos".
            "(mensaje)".
            "VALUES ".
        "('$mensaje')";
        mysqli_select_db($conn,'smb_bienestar');
        $resp = mysqli_query($conn,$sql);
        
        
        if($resp){
            echo "<br>";
		    echo '<div class="container">';
		    echo '<div class="alert alert-success" alert-dismissible">
		    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
		    echo '<img class="img-reponsive img-rounded" src="../../icons/actions/dialog-ok-apply.png" /> Mensaje Guardado Satisfactoriamente.';
		    echo "</div>";
		    echo "</div>";
    }else{
			    echo "<br>";
			    echo '<div class="container">';
                echo '<div class="alert alert-warning" alert-dismissible">
			    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
			    echo '<img class="img-reponsive img-rounded" src="../../icons/status/task-attempt.png" /> Hubo un problema al Guardar el Mensaje. '  .mysqli_error($conn);
			    echo "</div>";
			    echo "</div>";
		    }

}


/*
** funcion para eliminar un registro de mensaje de turnos gabinete
*/
function formEliminarMensajeGabinete($id,$conn){

        $sql = "select * from smb_info_gabinete where id = '$id'";
        mysqli_select_db($conn,'smb_bienestar');
        $query = mysqli_query($conn,$sql);
        while($fila = mysqli_fetch_array($query)){
                $mensaje = $fila['mensaje'];
            }
            
            echo '<div class="container">
            <div class="row">
            <div class="col-sm-8">
            
            <div class="panel panel-danger">
            <div class="panel-heading"><img class="img-reponsive img-rounded" src="../../icons/status/security-low.png" /> Mensajes Turnos Gabinete - Eliminar Registro</div>
            <div class="panel-body">
            <form action="main.php" method="POST">
            <input type="hidden" class="form-control" name="id" value="'.$id.'">
            
                <div class="alert alert-danger">
                <img class="img-reponsive img-rounded" src="../../icons/status/task-attempt.png" /> <strong>Atención!</strong><hr>
                <p>Está por eliminar el registro del mensaje Informativo de Espacio del Usuario Turnos Gabinete</p>
                <p>Si está seguro, presione Aceptar, de lo contrario presione Cancelar.</p>
                </div><hr>
                
                <div class="form-group">
                <label for="comment">Mensaje:</label>
                <textarea class="form-control" name="mensaje_productos" rows="5" id="comment" maxlength="240" readonly>'.$mensaje.'</textarea>
            </div><hr>
            
            <button type="submit" class="btn btn-success btn-block" name="delete_mensaje_gabinete">Aceptar</button><br>
            </form>
            <a href="main.php"><button type="button" class="btn btn-danger btn-block">Cancelar</button></a>
            </div>
            </div>
            
            </div>
            </div>
            </div>';
}


/*
** funcion para eliminar un registro de mensaje de alquiler de equipos
*/
function formEliminarMensajeAEquipos($id,$conn){

        $sql = "select * from smb_info_aequipos where id = '$id'";
        mysqli_select_db($conn,'smb_bienestar');
        $query = mysqli_query($conn,$sql);
        while($fila = mysqli_fetch_array($query)){
                $mensaje = $fila['mensaje'];
            }
            
            echo '<div class="container">
            <div class="row">
            <div class="col-sm-8">
            
            <div class="panel panel-danger">
            <div class="panel-heading"><img class="img-reponsive img-rounded" src="../../icons/status/security-low.png" /> Mensajes Alquiler de Equipos - Eliminar Registro</div>
            <div class="panel-body">
            <form action="main.php" method="POST">
            <input type="hidden" class="form-control" name="id" value="'.$id.'">
            
                <div class="alert alert-danger">
                <img class="img-reponsive img-rounded" src="../../icons/status/task-attempt.png" /> <strong>Atención!</strong><hr>
                <p>Está por eliminar el registro del mensaje Informativo del Espacio de Usuario Alquiler de Equipos</p>
                <p>Si está seguro, presione Aceptar, de lo contrario presione Cancelar.</p>
                </div><hr>
                
                <div class="form-group">
                <label for="comment">Mensaje:</label>
                <textarea class="form-control" name="mensaje_productos" rows="5" id="comment" maxlength="240" readonly>'.$mensaje.'</textarea>
            </div><hr>
            
            <button type="submit" class="btn btn-success btn-block" name="delete_mensaje_aequipos">Aceptar</button><br>
            </form>
            <a href="main.php"><button type="button" class="btn btn-danger btn-block">Cancelar</button></a>
            </div>
            </div>
            
            </div>
            </div>
            </div>';
}


/*
** funcion para eliminar un registro de mensaje de venta de productos
*/
function formEliminarMensajeProductos($id,$conn){

        $sql = "select * from smb_info_productos where id = '$id'";
        mysqli_select_db($conn,'smb_bienestar');
        $query = mysqli_query($conn,$sql);
        while($fila = mysqli_fetch_array($query)){
                $mensaje = $fila['mensaje'];
            }
            
            echo '<div class="container">
            <div class="row">
            <div class="col-sm-8">
            
            <div class="panel panel-danger">
            <div class="panel-heading"><img class="img-reponsive img-rounded" src="../../icons/status/security-low.png" /> Mensajes Venta de Productos - Eliminar Registro</div>
            <div class="panel-body">
            <form action="main.php" method="POST">
            <input type="hidden" class="form-control" name="id" value="'.$id.'">
            
                <div class="alert alert-danger">
                <img class="img-reponsive img-rounded" src="../../icons/status/task-attempt.png" /> <strong>Atención!</strong><hr>
                <p>Está por eliminar el registro del mensaje Informativo del Espacio de Usuario Venta de Prodcutos</p>
                <p>Si está seguro, presione Aceptar, de lo contrario presione Cancelar.</p>
                </div><hr>
                
                <div class="form-group">
                <label for="comment">Mensaje:</label>
                <textarea class="form-control" name="mensaje_productos" rows="5" id="comment" maxlength="240" readonly>'.$mensaje.'</textarea>
            </div><hr>
            
            <button type="submit" class="btn btn-success btn-block" name="delete_mensaje_productos">Aceptar</button><br>
            </form>
            <a href="main.php"><button type="button" class="btn btn-danger btn-block">Cancelar</button></a>
            </div>
            </div>
            
            </div>
            </div>
            </div>';
}


/*
** funcion que elimina registro de mensajes turnos gabinete
*/
function deleteMensajeGabinete($id,$conn){

    $sql = "delete from smb_info_gabinete where id = '$id'";
    mysqli_select_db($conn,'smb_bienestar');
    $query = mysqli_query($conn,$sql);
    
    if($query){
            echo "<br>";
		    echo '<div class="container">';
		    echo '<div class="alert alert-success" role="alert">';
		    echo '<img class="img-reponsive img-rounded" src="../../icons/actions/dialog-ok-apply.png" /> Registro Eliminado Satisfactoriamente.';
		    echo "</div>";
		    echo "</div>";
    }else{
			    echo "<br>";
			    echo '<div class="container">';
			    echo '<div class="alert alert-warning" role="alert">';
			    echo '<img class="img-reponsive img-rounded" src="../../icons/status/task-attempt.png" /> Hubo un problema al Eliminar el Registro.'  .mysqli_error($conn);
			    echo "</div>";
			    echo "</div>";
		    }

}


/*
** funcion que elimina registro de mensajes turnos gabinete
*/
function deleteMensajeAEquipos($id,$conn){

    $sql = "delete from smb_info_aequipos where id = '$id'";
    mysqli_select_db($conn,'smb_bienestar');
    $query = mysqli_query($conn,$sql);
    
    if($query){
            echo "<br>";
		    echo '<div class="container">';
		    echo '<div class="alert alert-success" role="alert">';
		    echo '<img class="img-reponsive img-rounded" src="../../icons/actions/dialog-ok-apply.png" /> Registro Eliminado Satisfactoriamente.';
		    echo "</div>";
		    echo "</div>";
    }else{
			    echo "<br>";
			    echo '<div class="container">';
			    echo '<div class="alert alert-warning" role="alert">';
			    echo '<img class="img-reponsive img-rounded" src="../../icons/status/task-attempt.png" /> Hubo un problema al Eliminar el Registro.'  .mysqli_error($conn);
			    echo "</div>";
			    echo "</div>";
		    }

}


/*
** funcion que elimina registro de mensajes turnos gabinete
*/
function deleteMensajeProductos($id,$conn){

    $sql = "delete from smb_info_productos where id = '$id'";
    mysqli_select_db($conn,'smb_bienestar');
    $query = mysqli_query($conn,$sql);
    
    if($query){
            echo "<br>";
		    echo '<div class="container">';
		    echo '<div class="alert alert-success" role="alert">';
		    echo '<img class="img-reponsive img-rounded" src="../../icons/actions/dialog-ok-apply.png" /> Registro Eliminado Satisfactoriamente.';
		    echo "</div>";
		    echo "</div>";
    }else{
			    echo "<br>";
			    echo '<div class="container">';
			    echo '<div class="alert alert-warning" role="alert">';
			    echo '<img class="img-reponsive img-rounded" src="../../icons/status/task-attempt.png" /> Hubo un problema al Eliminar el Registro.'  .mysqli_error($conn);
			    echo "</div>";
			    echo "</div>";
		    }

}


?>
