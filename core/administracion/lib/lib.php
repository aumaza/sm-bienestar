<?php
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////// SECCION TURNOS GABINETE /////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////

/*
** funcion turnos gabinete 
*/
function turnosGabinete($conn){


if($conn){
	
	//"SELECT * FROM smb_turnos_gabinete where f_turno BETWEEN CURDATE() and CURDATE() + INTERVAL 90 DAY";
	$sql = "SELECT * FROM smb_turnos_gabinete where f_turno = '2020-01-01' and CURDATE() + INTERVAL 90 DAY and cliente <> 'NULL'";
    	mysqli_select_db($conn,'smb_bienestar');
    	$resultado = mysqli_query($conn,$sql);
	//mostramos fila x fila
	$count = 0;
	echo '<div class="panel panel-success" >
	      <div class="panel-heading"><span class="pull-center "><img src="../../icons/actions/view-calendar-timeline.png"  class="img-reponsive img-rounded"> Turnos Gabinete Solicitados';
	echo '</div><br>
            <p><strong>Nota:</strong> Aquí se encuentran todos los turnos disponibles, aquellos que aparecen en color Rojo sobre la fecha, significa que ya fueron tomados, si desea tomar un turno, presione el botón <strong>Reservar</strong> y podrá tramitar dicho turno</p><hr>';

      echo "<table class='display compact' style='width:100%' id='myTable'>";
      echo "<thead>
		    <th class='text-nowrap text-center'>ID</th>
		    <th class='text-nowrap text-center'>Fecha</th>
            <th class='text-nowrap text-center'>Hora</th>
            <th class='text-nowrap text-center'>Cliente</th>
            <th class='text-nowrap text-center'>Especialidad</th>
            <th class='text-nowrap text-center'>Espacio</th>
            <th class='text-nowrap text-center'>Pagos</th>
            <th class='text-nowrap text-center'>Importe</th>
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
			 if($fila['solicitud'] == 'Cancelado'){
                echo '<td align=center style="background-color:red"><font color="white">'.$fila['f_turno'].'</font></td>';
			 }
			 if($fila['solicitud'] == 'Confirmado'){
                echo '<td align=center style="background-color:green"><font color="white">'.$fila['f_turno'].'</font></td>';
			 }
			 if($fila['solicitud'] == 'Atendido'){
                echo '<td align=center style="background-color:blue"><font color="white">'.$fila['f_turno'].'</font></td>';
			 }
			 echo "<td align=center>".$fila['hora']."</td>";
			 echo "<td align=center>".$fila['cliente']."</td>";
			 echo "<td align=center>".$fila['especialidad']."</td>";
			 echo "<td align=center>".$fila['espacio']."</td>";
			 echo "<td align=center>".$fila['pagos']."</td>";
			 echo "<td align=center>".$fila['importe']."</td>";
			 echo "<td align=center>".$fila['solicitud']."</td>";
			 echo "<td class='text-nowrap'>";
			 echo '<form <action="main.php" method="POST">
                    <input type="hidden" name="id" value="'.$fila['id'].'">
                    <button type="submit" class="btn btn-primary btn-sm" name="estado"><img src="../../icons/actions/view-calendar-upcoming-events.png"  class="img-reponsive img-rounded"> Estado Solicitud</button>
                    <button type="submit" class="btn btn-success btn-sm" name="pay"><img src="../../icons/actions/view-loan.png"  class="img-reponsive img-rounded"> Pagos</button>
                    </form>';
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
** funcion para cambiar estado de la solicitud de turno
*/
function formEstado($id,$conn){

    $sql = "select * from smb_turnos_gabinete where id = '$id'";
    mysqli_select_db($conn,'smb_bienestar');
   $resultado = mysqli_query($conn,$sql);
   while($fila = mysqli_fetch_array($resultado)){
        $fecha = $fila['f_turno'];
        $hora = $fila['hora'];
        $cliente = $fila['cliente'];
        $espacio = $fila['espacio'];
        $solicitud = $fila['solicitud'];
        $especialidad = $fila['especialidad'];
   }
   
   echo '<div class="container">
            <div class="row">
            <div class="col-sm-8">
            
            <div class="panel panel-success">
            <div class="panel-heading"><img class="img-reponsive img-rounded" src="../../icons/actions/view-calendar-upcoming-events.png" /> Cambiar Estado Solicitud</div>
            <div class="panel-body">
            <form action="main.php" method="POST">
            <input type="hidden" class="form-control" name="id" value="'.$id.'">
            
            <div class="form-group">
                <label for="email">Fecha:</label>
                <input type="text" class="form-control" value="'.$fecha.'" readonly>
            </div><hr>
            
            <div class="form-group">
                <label for="email">Hora:</label>
                <input type="text" class="form-control" value="'.$hora.'" readonly>
            </div><hr>
            
            <div class="form-group">
                <label for="email">Cliente:</label>
                <input type="text" class="form-control" value="'.$cliente.'" readonly>
            </div><hr>
            
            <div class="form-group">
                <label for="email">Espacio:</label>
                <input type="text" class="form-control" value="'.$espacio.'" readonly>
            </div><hr>
            
            <div class="form-group">
                <label for="email">Especialidad:</label>
                <input type="text" class="form-control" value="'.$especialidad.'" readonly>
            </div><hr>
           
           <p><strong>Seleccione el Estado al que desea cambiar</strong></p>
           <p><strong>Estado actual</strong>: '.$solicitud.'
           <div class="form-group">
                <label for="sel1">Estado:</label>
                <select class="form-control" name="solicitud" required>
                    <option value="" disabled selected>Seleccionar</option>';
                    if($solicitud != "Stand-By"){
                    echo '<option value="Stand-By">Stand-By</option>';
                    }
                    if($solicitud != "Confirmado"){
                    echo '<option value="Confirmado">Confirmar</option>';
                    }
                    if($solicitud != "Cancelado"){
                    echo '<option value="Cancelado">Cancelar</option>';
                    }
                    if($solicitud != "Atendido"){
                    echo '<option value="Atendido">Atendido</option>';
                    }
          echo '</select>
                </div> 
            <button type="submit" class="btn btn-success btn-block" name="updateRequest">Aceptar</button>
            </form>
            </div>
            </div>
            
            </div>
            </div>
            </div>';

}

/*
** funcion actualizar estado solicitud turno gabinete
*/
function updateSolicitud($id,$solicitud,$conn){

    $sql = "update smb_turnos_gabinete set solicitud = '$solicitud' where id = '$id'";
    mysqli_select_db($conn,'smb_bienestar');
    $query = mysqli_query($conn,$sql);
    
    if($query){
            echo "<br>";
		    echo '<div class="container">';
		    echo '<div class="alert alert-success" role="alert">';
		    echo '<img class="img-reponsive img-rounded" src="../../icons/actions/dialog-ok-apply.png" /> Solicitud Actualizada Satisfactoriamente.';
		    echo "</div>";
		    echo "</div>";
    }else{
			    echo "<br>";
			    echo '<div class="container">';
			    echo '<div class="alert alert-warning" role="alert">';
			    echo '<img class="img-reponsive img-rounded" src="../../icons/status/task-attempt.png" /> Hubo un problema al actualizar la Solicitud.'  .mysqli_error($conn);
			    echo "</div>";
			    echo "</div>";
		    }

}

/*
** funcion para cargar pagos realizados en turnos gabinete
*/
function pagos($id,$conn){

    $sql = "select * from smb_turnos_gabinete where id = '$id'";
    mysqli_select_db($conn,'smb_bienestar');
   $resultado = mysqli_query($conn,$sql);
   while($fila = mysqli_fetch_array($resultado)){
        $fecha = $fila['f_turno'];
        $hora = $fila['hora'];
        $cliente = $fila['cliente'];
        $espacio = $fila['espacio'];
        $solicitud = $fila['solicitud'];
        $especialidad = $fila['especialidad'];
        $pagos = $fila['pagos'];
        $importe = $fila['importe'];
   }
   
   echo '<div class="container">
            <div class="row">
            <div class="col-sm-8">
            
            <div class="panel panel-success">
            <div class="panel-heading"><img class="img-reponsive img-rounded" src="../../icons/actions/view-loan.png" /> Cargar Pagos</div>
            <div class="panel-body">
            <form action="main.php" method="POST">
            <input type="hidden" class="form-control" name="id" value="'.$id.'">
            
            <div class="form-group">
                <label for="email">Fecha:</label>
                <input type="text" class="form-control" value="'.$fecha.'" readonly>
            </div><hr>
            
            <div class="form-group">
                <label for="email">Hora:</label>
                <input type="text" class="form-control" value="'.$hora.'" readonly>
            </div><hr>
            
            <div class="form-group">
                <label for="email">Cliente:</label>
                <input type="text" class="form-control" value="'.$cliente.'" readonly>
            </div><hr>
            
            <div class="form-group">
                <label for="email">Espacio:</label>
                <input type="text" class="form-control" value="'.$espacio.'" readonly>
            </div><hr>
            
            <div class="form-group">
                <label for="email">Especialidad:</label>
                <input type="text" class="form-control" value="'.$especialidad.'" readonly>
            </div><hr>
           
           <p><strong>Estado actual</strong>: '.$solicitud.'</p><hr>
           <div class="form-group">
                <label for="sel1">Pago:</label>
                <select class="form-control" name="pagos" required>';
                    if($pagos == ''){
                    echo '<option value="" disabled selected>Seleccionar</option>';
                    }if($pagos == 'Pagó'){
                    echo '<option value="Pagó" selected>Pagó</option>';
                    }else{
                    echo '<option value="Pagó">Pagó</option>';
                    }if($pagos == 'Debe'){
                    echo '<option value="Debe" selected>Debe</option>';
                    }else{
                    echo '<option value="Debe">Debe</option>';
                    }
          echo '</select>
                </div><hr>
                
            <div class="form-group">
                <label for="email">Importe:</label>';
                if($importe == ''){
                echo '<input type="text" class="form-control" name="importe" placeholder="Ingrese el importe. Ejemplo: 1500.60" required>';
                }else{
                echo '<input type="text" class="form-control" name="importe" value="'.$importe.'" required>';
                }
            echo '</div><hr>
            
            <button type="submit" class="btn btn-success btn-block" name="updatePagos">Aceptar</button>
            </form>
            </div>
            </div>
            
            </div>
            </div>
            </div>';

}

/*
** funcion actualizar pagos turno gabinete
*/
function updatePagos($id,$pagos,$importe,$conn){

    $sql = "update smb_turnos_gabinete set pagos = '$pagos', importe = '$importe' where id = '$id'";
    mysqli_select_db($conn,'smb_bienestar');
    $query = mysqli_query($conn,$sql);
    
    if($query){
            echo "<br>";
		    echo '<div class="container">';
		    echo '<div class="alert alert-success" role="alert">';
		    echo '<img class="img-reponsive img-rounded" src="../../icons/actions/dialog-ok-apply.png" /> Pago Actualizado Satisfactoriamente.';
		    echo "</div>";
		    echo "</div>";
    }else{
			    echo "<br>";
			    echo '<div class="container">';
			    echo '<div class="alert alert-warning" role="alert">';
			    echo '<img class="img-reponsive img-rounded" src="../../icons/status/task-attempt.png" /> Hubo un problema al actualizar el Pago.'  .mysqli_error($conn);
			    echo "</div>";
			    echo "</div>";
		    }

}


/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////// FIN SECCION TURNOS GABINETE /////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////



/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////// SECCION MENSAJES USUARIOS /////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////

/*
** funcion MUESTRA MENSAJES DE USUARIOS 
*/
function getMensajes($conn){


if($conn){
	
	$sql = "SELECT * FROM smb_mensajes where fecha = curdate()";
    	mysqli_select_db($conn,'smb_bienestar');
    	$resultado = mysqli_query($conn,$sql);
	//mostramos fila x fila
	$count = 0;
	echo '<div class="panel panel-success" >
	      <div class="panel-heading"><span class="pull-center "><img src="../../icons/actions/mail-mark-unread-new.png"  class="img-reponsive img-rounded"> Mensajes recibidos';
	echo '</div><br>';

            echo "<table class='display compact' style='width:100%' id='myTable'>";
              echo "<thead>
		    <th class='text-nowrap text-center'>ID</th>
		    <th class='text-nowrap text-center'>Recibido</th>
            <th class='text-nowrap text-center'>Nombre y Apellido</th>
            <th class='text-nowrap text-center'>Email</th>
            <th class='text-nowrap text-center'>Mensaje</th>
            <th>&nbsp;</th>
            </thead>";


	while($fila = mysqli_fetch_array($resultado)){
			  // Listado normal
			 echo "<tr>";
			 echo "<td align=center>".$fila['id']."</td>";
			 echo "<td align=center>".$fila['fecha']."</td>";
			 echo "<td align=center>".$fila['nombre']."</td>";
			 echo "<td align=center>"."<a href='mailto:".$fila['email']."'>".$fila['email']."</td>";
			 echo "<td align=center>".$fila['mensaje']."</td>";
			 echo "<td class='text-nowrap'>";
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

/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////// FIN SECCION MENSAJES USUARIOS ///////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////



/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////// SECCION LOCALIDADES /////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
/*
** funcion listar localidades
*/
function localidades($conn){

if($conn){
	
	$sql = "SELECT * FROM smb_localidades";
    	mysqli_select_db($conn,'smb_bienestar');
    	$resultado = mysqli_query($conn,$sql);
	//mostramos fila x fila
	$count = 0;
	echo '<div class="panel panel-success" >
	      <div class="panel-heading"><span class="pull-center "><img src="../../icons/apps/lokalize.png"  class="img-reponsive img-rounded"> Localidades';
	echo '</div><br>';

            echo "<table class='display compact' style='width:100%' id='myTable'>";
              echo "<thead>
		    <th class='text-nowrap text-center'>ID</th>
		    <th class='text-nowrap text-center'>Cod. Localidad</th>
            <th class='text-nowrap text-center'>Localidad</th>
            <th class='text-nowrap text-center'>Kms</th>
            <th class='text-nowrap text-center'>Valor Km</th>
            <th class='text-nowrap text-center'>Importe Final</th>
            <th>&nbsp;</th>
            </thead>";


	while($fila = mysqli_fetch_array($resultado)){
			  // Listado normal
			 echo "<tr>";
			 echo "<td align=center>".$fila['id']."</td>";
			 echo "<td align=center>".$fila['cod_loc']."</td>";
			 echo "<td align=center>".$fila['localidad']."</td>";
			 echo "<td align=center>".$fila['kilometros']."</td>";
			 echo "<td align=center>".$fila['valor_kilometro']."</td>";
			 echo "<td align=center>".$fila['monto_final']."</td>";
			 echo "<td class='text-nowrap'>";
			 echo '<form <action="main.php" method="POST">
                    <input type="hidden" name="id" value="'.$fila['id'].'">
                    <button type="submit" class="btn btn-success btn-sm" name="edit_loc"><img src="../../icons/actions/document-edit.png"  class="img-reponsive img-rounded"> Editar</button>
                    <button type="submit" class="btn btn-danger btn-sm" name="del_loc"><img src="../../icons/actions/edit-delete.png"  class="img-reponsive img-rounded"> Eliminar</button>
                    </form>';
			 echo "</td>";
			 $count++;
		}

		echo "</table>";
		echo "<br>";
		echo '<form <action="main.php" method="POST">
                    <button type="submit" class="btn btn-default btn-sm" name="add_loc"><img src="../../icons/actions/list-add.png"  class="img-reponsive img-rounded"> Agregar Localidad</button>
                    <button type="submit" class="btn btn-default btn-sm" name="update_val_km"><img src="../../icons/actions/games-solve.png"  class="img-reponsive img-rounded"> Actualizar Valor Km</button>
                    </form>';
		echo '</div><br>';
		}else{
		  echo 'Connection Failure...';
		}

    mysqli_close($conn);

}

/*
** funcion editar localidad
*/
function formEditLocalidad($id,$conn){

  $sql = "select * from smb_localidades where id = '$id'";
  mysqli_select_db($conn,'smb_bienestar');
  $query = mysqli_query($conn,$sql);
  while($fila = mysqli_fetch_array($query)){
        $cod = $fila['cod_loc'];
        $localidad = $fila['localidad'];
        $km = $fila['kilometros'];
       }
       
       echo '<div class="container">
            <div class="row">
            <div class="col-sm-8">
            
            <div class="panel panel-success">
            <div class="panel-heading"><img class="img-reponsive img-rounded" src="../../icons/apps/lokalize.png" /> Editar Localidad</div>
            <div class="panel-body">
            <form action="main.php" method="POST">
            <input type="hidden" class="form-control" name="id" value="'.$id.'">
            
            <div class="form-group">
                <label for="email">Código Localidad:</label>
                <input type="text" class="form-control" name="cod_loc" value="'.$cod.'" readonly>
            </div><hr>
            
            <div class="form-group">
                <label for="email">Localidad:</label>
                <input type="text" class="form-control" name="localidad" value="'.$localidad.'">
            </div><hr>
            
            <div class="form-group">
                <label for="email">Kilometros:</label>
                <input type="text" class="form-control" name="km" value="'.$km.'">
            </div><hr>
            
                 
            <button type="submit" class="btn btn-success btn-block" name="updateLoc">Aceptar</button>
            </form>
            </div>
            </div>
            
            </div>
            </div>
            </div>';


}

/*
** funcion actualizar localidad en base de datos
*/
function updateLocalidad($id,$localidad,$km,$conn){

        $request = "select valor_kilometro from smb_localidades limit 1";
        mysqli_select_db($conn,'smb_bienestar');
        $retval = mysqli_query($conn,$request);
        while($fila = mysqli_fetch_array($retval)){
            $valor = $fila['valor_kilometro'];
        }
    
        $km = number_format($km,2);
        $valor = number_format($valor,2);
        $monto_final  = $km * $valor;
        
        $sql = "update smb_localidades set localidad = '$localidad', kilometros = '$km', monto_final = '$monto_final' where id = '$id'";
        mysqli_select_db($conn,'smb_bienestar');
        $query = mysqli_query($conn,$sql);
        
        if($query){
            echo "<br>";
		    echo '<div class="container">';
		    echo '<div class="alert alert-success" alert-dismissible">
		    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
		    echo '<img class="img-reponsive img-rounded" src="../../icons/actions/dialog-ok-apply.png" /> Registro Actualizado Satisfactoriamente.';
		    echo "</div>";
		    echo "</div>";
        }else{
                    echo "<br>";
                    echo '<div class="container">';
                    echo '<div class="alert alert-warning" alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                    echo '<img class="img-reponsive img-rounded" src="../../icons/status/task-attempt.png" /> Hubo un problema al Actualizar el Registro. '  .mysqli_error($conn);
                    echo "</div>";
                    echo "</div>";
                }


}


/*
** funcion para dar el alta a nueva localidad
*/
function formAddLocalidad(){

        echo '<div class="container">
            <div class="row">
            <div class="col-sm-8">
            
            <div class="panel panel-success">
            <div class="panel-heading"><img class="img-reponsive img-rounded" src="../../icons/actions/list-add.png" /> Agregar Localidad</div>
            <div class="panel-body">
            <form action="main.php" method="POST">
            
            <div class="form-group">
                <label for="email">Código Localidad:</label>
                <div class="alert alert-info">
                <img class="img-reponsive img-rounded" src="../../icons/actions/games-hint.png" /> <strong>Ayuda!</strong><hr>
                <p>Recuerde que el código de la localidad debe ser descriptivo de la misma.</p>
                <p><strong>Ejemplo</strong>: Para la localidad EZEIZA podría ser EZE.</p>
                </div>
                <input type="text" class="form-control" name="cod_loc" maxlength="3" placeholder="Ingrese Código de Localidad, este debe tener como máximo 3 caracteres" required>
            </div><hr>
            
            <div class="form-group">
                <label for="email">Localidad:</label>
                <input type="text" class="form-control" name="localidad" placeholder="Ingrese el Nombre de la localidad" required>
            </div><hr>
            
            <div class="form-group">
                <label for="email">Kilometros:</label>
                <input type="text" class="form-control" name="km" placeholder="Ingrese la cantidad de km hasta dicha localidad" required>
            </div><hr>
            
                 
            <button type="submit" class="btn btn-success btn-block" name="agregarLoc">Aceptar</button>
            </form>
            </div>
            </div>
            
            </div>
            </div>
            </div>';
}

/*
** funcion que agrega localidad 
*/
function addLocalidad($cod_loc,$localidad,$km,$conn){

    $sql = "select cod_loc, localidad from smb_localidades where cod_loc = '$cod_loc' and localidad = '$localidad'";
    mysqli_select_db($conn,'smb_bienestar');
    $query = mysqli_query($conn,$sql);
    $rows = mysqli_num_rows($query);
    
    $request = "select valor_kilometro from smb_localidades limit 1";
    mysqli_select_db($conn,'smb_bienestar');
    $retval = mysqli_query($conn,$request);
    while($fila = mysqli_fetch_array($retval)){
        $valor = $fila['valor_kilometro'];
    }
   
    $km = number_format($km,2);
    $valor = number_format($valor,2);
    $monto_final  = $km * $valor;
        
    if($rows == 0){
            
            $consulta = "INSERT INTO smb_localidades ".
            "(cod_loc,localidad,kilometros,valor_kilometro,monto_final)".
            "VALUES ".
        "('$cod_loc','$localidad','$km','$valor','$monto_final')";
        mysqli_select_db($conn,'smb_bienestar');
        $resp = mysqli_query($conn,$consulta);
            
            if($resp){
            echo "<br>";
		    echo '<div class="container">';
		    echo '<div class="alert alert-success" alert-dismissible">
		    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
		    echo '<img class="img-reponsive img-rounded" src="../../icons/actions/dialog-ok-apply.png" /> Registro Agregado Satisfactoriamente.';
		    echo "</div>";
		    echo "</div>";
    }else{
			    echo "<br>";
			    echo '<div class="container">';
			     echo '<div class="alert alert-warning" alert-dismissible">
			    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
			    echo '<img class="img-reponsive img-rounded" src="../../icons/status/task-attempt.png" /> Hubo un problema al Agregar el Registro. '  .mysqli_error($conn);
			    echo "</div>";
			    echo "</div>";
		    }
		    }else{
		    
                echo "<br>";
			    echo '<div class="container">';
			     echo '<div class="alert alert-warning" alert-dismissible">
			    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
			    echo '<img class="img-reponsive img-rounded" src="../../icons/status/task-attempt.png" /> Ya existe registro de esa Localidad.';
			    echo "</div>";
			    echo "</div>";
			    exit;
		    
		    }

}

/*
** funcion actualizar valor de kilometro
*/
function formUpdateValorKm(){

    echo '<div class="container">
            <div class="row">
            <div class="col-sm-8">
            
            <div class="panel panel-success">
            <div class="panel-heading"><img class="img-reponsive img-rounded" src="../../icons/actions/games-solve.png" /> Actualizar Valor Kilometro</div>
            <div class="panel-body">
            <form action="main.php" method="POST">
            
            <div class="form-group">
                <div class="alert alert-info">
                <img class="img-reponsive img-rounded" src="../../icons/actions/games-hint.png" /> <strong>Ayuda!</strong><hr>
                <p>Ingrese el valor sin separar por miles y para separar decimales use un punto en lugar de coma.</p>
                <p><strong>Ejemplo</strong>: 150.85</p>
                </div>
                <label for="email">Monto:</label>
                <input type="text" class="form-control" name="v_km" placeholder="Ingrese el monto" required>
            </div><hr>
            
            <button type="submit" class="btn btn-success btn-block" name="updateV_km">Aceptar</button>
            </form>
            </div>
            </div>
            
            </div>
            </div>
            </div>';
}


/*
** funcion que actualiza monto del valor de kilometraje
*/
function updateValorKm($v_km,$conn){

    $sql = "update smb_localidades set valor_kilometro = '$v_km', monto_final = (kilometros * '$v_km')";
    mysqli_select_db($conn,'smb_bienestar');
    $query = mysqli_query($conn,$sql);
    
    if($query){
            echo "<br>";
		    echo '<div class="container">';
		    echo '<div class="alert alert-success" alert-dismissible">
		    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
		    echo '<img class="img-reponsive img-rounded" src="../../icons/actions/dialog-ok-apply.png" /> Valor Actualizado Satisfactoriamente.';
		    echo "</div>";
		    echo "</div>";
    }else{
			    echo "<br>";
			    echo '<div class="container">';
			    echo '<div class="alert alert-warning" alert-dismissible">
			    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
			    echo '<img class="img-reponsive img-rounded" src="../../icons/status/task-attempt.png" /> Hubo un problema al Actualizar el Valor. '  .mysqli_error($conn);
			    echo "</div>";
			    echo "</div>";
		    }



}

/*
** funcion para eliminar un registro de localidades
*/
function eliminarLoc($id,$conn){

        $sql = "select * from smb_localidades where id = '$id'";
        mysqli_select_db($conn,'smb_bienestar');
        $query = mysqli_query($conn,$sql);
        while($fila = mysqli_fetch_array($query)){
                $localidad = $fila['localidad'];
            }
            
            echo '<div class="container">
            <div class="row">
            <div class="col-sm-8">
            
            <div class="panel panel-danger">
            <div class="panel-heading"><img class="img-reponsive img-rounded" src="../../icons/status/security-low.png" /> Localidades - Eliminar Registro</div>
            <div class="panel-body">
            <form action="main.php" method="POST">
            <input type="hidden" class="form-control" name="id" value="'.$id.'">
            
                <div class="alert alert-danger">
                <img class="img-reponsive img-rounded" src="../../icons/status/task-attempt.png" /> <strong>Atención!</strong><hr>
                <p>Está por eliminar el registro: <strong>'.$localidad.'</strong></p>
                <p>Si está seguro, presione Aceptar, de lo contrario presione Cancelar.</p>
                </div><hr>
            
            <button type="submit" class="btn btn-success btn-block" name="delete_loc">Aceptar</button><br>
            </form>
            <a href="main.php"><button type="button" class="btn btn-danger btn-block">Cancelar</button></a>
            </div>
            </div>
            
            </div>
            </div>
            </div>';
}

/*
** funcion que elimina registro de localidades
*/
function deleteLoc($id,$conn){

    $sql = "delete from smb_localidades where id = '$id'";
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


/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////// FIN SECCION LOCALIDADES /////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
?>
