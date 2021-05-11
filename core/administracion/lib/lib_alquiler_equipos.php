<?php

/*
** funcion ver entrega de equipos el dia de la fecha
*/
function equiposEntrega($conn){

if($conn){
	
	$sql = "SELECT * FROM smb_turnos_equipos where estado = 'Ocupado' and f_turno = curdate()";
    	mysqli_select_db($conn,'smb_bienestar');
    	$resultado = mysqli_query($conn,$sql);
	//mostramos fila x fila
	$count = 0;
	echo '<div class="panel panel-success" >
	      <div class="panel-heading"><span class="pull-center "><img src="../../icons/actions/im-aim.png"  class="img-reponsive img-rounded"> ALQUILER EQUIPOS - A entregar Hoy';
	echo '</div><br>';
            
            echo "<table class='display compact' style='width:100%' id='myTable'>";
              echo "<thead>
		    <th class='text-nowrap text-center'>ID</th>
		    <th class='text-nowrap text-center'>Fecha</th>
		    <th class='text-nowrap text-center'>Equipo</th>
		    <th class='text-nowrap text-center'>Hora Entrega</th>
		    <th class='text-nowrap text-center'>Cliente</th>
		    <th class='text-nowrap text-center'>Dirección</th>
		    <th class='text-nowrap text-center'>Localidad</th>
		    <th class='text-nowrap text-center'>Móvil</th>
		    <th class='text-nowrap text-center'>A Pagar</th>
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
			 echo "<td align=center>".$fila['cliente']."</td>";
			 echo "<td align=center>".$fila['direccion']."</td>";
			 echo "<td align=center>".$fila['localidad']."</td>";
			 echo "<td align=center>".$fila['movil']."</td>";
			 echo "<td align=center>$".$fila['monto']."</td>";
			 echo "<td class='text-nowrap'>";
			 echo "</td>";
			 $count++;
		}

		echo "</table>";
		echo "<br>";
		echo '<button type="button" class="btn btn-primary">Cantidad de Entregas:  ' .$count; echo '</button>';
		echo '</div>';
		}else{
		  echo 'Connection Failure...';
		}

    mysqli_close($conn);

}


/*
** funcion ver retiro de equipos el dia de la fecha
*/
function equiposRetiro($conn){

if($conn){
	
	$sql = "SELECT * FROM smb_turnos_equipos where estado = 'Ocupado' and f_turno = curdate()";
    	mysqli_select_db($conn,'smb_bienestar');
    	$resultado = mysqli_query($conn,$sql);
	//mostramos fila x fila
	$count = 0;
	echo '<div class="panel panel-success" >
	      <div class="panel-heading"><span class="pull-center "><img src="../../icons/status/task-reminder.png"  class="img-reponsive img-rounded"> ALQUILER EQUIPOS - A Retirar Hoy';
	echo '</div><br>';
            
            echo "<table class='display compact' style='width:100%' id='myTable'>";
              echo "<thead>
		    <th class='text-nowrap text-center'>ID</th>
		    <th class='text-nowrap text-center'>Fecha</th>
		    <th class='text-nowrap text-center'>Equipo</th>
		    <th class='text-nowrap text-center'>Hora Retiro</th>
		    <th class='text-nowrap text-center'>Cliente</th>
		    <th class='text-nowrap text-center'>Dirección</th>
		    <th class='text-nowrap text-center'>Localidad</th>
		    <th class='text-nowrap text-center'>Móvil</th>
		    <th class='text-nowrap text-center'>A Pagar</th>
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
			 echo "<td align=center>".$fila['hora_hasta']."</td>";
			 echo "<td align=center>".$fila['cliente']."</td>";
			 echo "<td align=center>".$fila['direccion']."</td>";
			 echo "<td align=center>".$fila['localidad']."</td>";
			 echo "<td align=center>".$fila['movil']."</td>";
			 echo "<td align=center>$".$fila['monto']."</td>";
			 echo "<td class='text-nowrap'>";
			 echo "</td>";
			 $count++;
		}

		echo "</table>";
		echo "<br>";
		echo '<button type="button" class="btn btn-primary">Cantidad de Retiros:  ' .$count; echo '</button>';
		echo '</div>';
		}else{
		  echo 'Connection Failure...';
		}

    mysqli_close($conn);

}


/*
** funcion para visualizar los alquileres de equipos
*/
function equiposTurnos($conn){

if($conn){
	
	$sql = "SELECT * FROM smb_turnos_equipos where f_turno BETWEEN CURDATE() and CURDATE() + interval 1 week";
    	mysqli_select_db($conn,'smb_bienestar');
    	$resultado = mysqli_query($conn,$sql);
	//mostramos fila x fila
	$count = 0;
	echo '<div class="panel panel-success" >
	      <div class="panel-heading"><span class="pull-center ">
		<img src="../../icons/status/task-reminder.png"  class="img-reponsive img-rounded"> ALQUILER EQUIPOS - Turnos';
	echo '</div><br>';
            
            echo "<table class='display compact' style='width:100%' id='myTable'>";
              echo "<thead>
		    <th class='text-nowrap text-center'>ID</th>
		    <th class='text-nowrap text-center'>Estado</th>
		    <th class='text-nowrap text-center'>Pagos</th>
		    <th class='text-nowrap text-center'>Fecha</th>
		    <th class='text-nowrap text-center'>Equipo</th>
		    <th class='text-nowrap text-center'>Hora Entrega</th>
		    <th class='text-nowrap text-center'>Cliente</th>
		    <th class='text-nowrap text-center'>Dirección</th>
		    <th class='text-nowrap text-center'>Localidad</th>
		    <th class='text-nowrap text-center'>Móvil</th>
		    <th class='text-nowrap text-center'>A Pagar</th>
		    <th>&nbsp;</th>
		    </thead>";


	while($fila = mysqli_fetch_array($resultado)){
			  // Listado normal
			 echo "<tr>";
			 echo "<td align=center>".$fila['id']."</td>";
			 if($fila['solicitud'] == 'Confirmado'){
			 echo '<td align=center style="background-color:green"><font color="black">'.$fila['solicitud'].'</font></td>'; 
			 }
			 if($fila['solicitud'] == 'Stand-By'){
			 echo '<td align=center style="background-color:yellow"><font color="black">'.$fila['solicitud'].'</font></td>';
			 }
			 if($fila['solicitud'] == 'Cancelado'){
			 echo '<td align=center style="background-color:red"><font color="white">'.$fila['solicitud'].'</font></td>';
			 }
			 if($fila['estado_cobro'] == ''){
			 echo "<td align=center>".$fila['estado_cobro']."</td>";
			 }
			 if($fila['estado_cobro'] == 'Pago'){
			 echo '<td align=center style="background-color:greenyellow"><font color="black">'.$fila['estado_cobro'].'</font></td>'; 
			 }
			 if($fila['estado_cobro'] == 'Debe'){
			 echo '<td align=center style="background-color:orange"><font color="white">'.$fila['estado_cobro'].'</font></td>';
			 }
			 if($fila['estado'] == 'Ocupado'){
			 echo '<td align=center style="background-color:red"><font color="white">'.$fila['f_turno'].'</font></td>';
			 }else{
			 echo "<td align=center>".$fila['f_turno']."</td>";
			 }
			 echo "<td align=center>".$fila['equipo']."</td>";
			 echo "<td align=center>".$fila['hora_desde']."</td>";
			 echo "<td align=center>".$fila['cliente']."</td>";
			 echo "<td align=center>".$fila['direccion']."</td>";
			 echo "<td align=center>".$fila['localidad']."</td>";
			 echo "<td align=center>".$fila['movil']."</td>";
			 echo "<td align=center>$".$fila['monto']."</td>";
			 echo "<td class='text-nowrap'>";
			 echo '<form <action="main.php" method="POST">
				
				<input type="hidden" name="id" value="'.$fila['id'].'">
				<button type="submit" class="btn btn-primary btn-sm" name="estado_solicitud">
				  <img src="../../icons/actions/view-calendar-upcoming-events.png"  class="img-reponsive img-rounded" /> Solicitud</button>';
				if($fila['estado_cobro'] == 'Pago'){
				echo '<button type="submit" class="btn btn-warning btn-sm" name="estado_pagos">
				  <img src="../../icons/status/wallet-closed.png"  class="img-reponsive img-rounded" /> Pagos</button>';
				}
				if($fila['estado_cobro'] == 'Debe'){
				 echo '<button type="submit" class="btn btn-warning btn-sm" name="estado_pagos">
				  <img src="../../icons/status/wallet-open.png"  class="img-reponsive img-rounded" /> Pagos</button>'; 
				}
				if($fila['estado_cobro'] == ''){
				 echo '<button type="submit" class="btn btn-warning btn-sm" name="estado_pagos">
				  <img src="../../icons/status/security-medium.png"  class="img-reponsive img-rounded" /> Pagos</button>'; 
				}
			 echo '</form>';
			 echo "</td>";
			 $count++;
		}

		echo "</table>";
		echo "<br>";
		echo '<button type="button" class="btn btn-primary">Cantidad de Retiros:  ' .$count; echo '</button>';
		echo '</div>';
		}else{
		  echo 'Connection Failure...';
		}

    mysqli_close($conn);

}

/*
** funcion para cambiar estado de la solicitud de turno equipos
*/
function formEstadoSolicitud($id,$conn){

    $sql = "select * from smb_turnos_equipos where id = '$id'";
    mysqli_select_db($conn,'smb_bienestar');
   $resultado = mysqli_query($conn,$sql);
   while($fila = mysqli_fetch_array($resultado)){
        $fecha = $fila['f_turno'];
        $hora = $fila['hora_desde'];
        $cliente = $fila['cliente'];
        $equipo = $fila['equipo'];
        $solicitud = $fila['solicitud'];
        $localidad = $fila['localidad'];
        $direccion = $fila['direccion'];
   }
   
   echo '<div class="container">
            <div class="row">
            <div class="col-sm-8">
            
            <div class="panel panel-success">
            <div class="panel-heading">
	      <img class="img-reponsive img-rounded" src="../../icons/actions/view-calendar-upcoming-events.png" /> Alquiler Equipos - Cambiar Estado Solicitud </div>
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
                <label for="email">Equipo:</label>
                <input type="text" class="form-control" value="'.$equipo.'" readonly>
            </div><hr>
            
            <div class="form-group">
                <label for="email">Dirección:</label>
                <input type="text" class="form-control" value="'.$direccion.'" readonly>
            </div><hr>
            
            <div class="form-group">
                <label for="email">Localidad:</label>
                <input type="text" class="form-control" value="'.$localidad.'" readonly>
            </div><hr>
           
           <p><strong>Seleccione el Estado al que desea cambiar</strong></p>
           <p><strong>Estado actual</strong>: '.$solicitud.'
           <div class="form-group">
                <label for="sel1">Estado:</label>
                <select class="form-control" name="solicitud_equipo" required>
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
          echo '</select>
                </div> 
            <button type="submit" class="btn btn-success btn-block" name="updateSolicitud">Aceptar</button>
            </form>
            </div>
            </div>
            
            </div>
            </div>
            </div>';

}

/*
** funcion actualizar estado solicitud turnos alquiler equipos
*/
function updateSolicitudEquipo($id,$solicitud,$conn){

    if($solicitud == 'Confirmado'){
    
    $sql = "update smb_turnos_equipos set solicitud = '$solicitud' where id = '$id'";
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
	 
    if($solicitud == 'Cancelado'){
      
      $consulta = "update smb_turnos_equipos set solicitud = '$solicitud', estado = 'Libre' where id = '$id'";
      mysqli_select_db($conn,'smb_bienestar');
      $resval = mysqli_query($conn,$consulta);
      
      if($resval){
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

}


/*
** funcion para cambiar estado de debe a pagó
*/
function cambiarEstadoPago($id,$conn){
    
    echo '<div class="container">
	   <div class="alert alert-success" role="alert">
	    <img class="img-reponsive img-rounded" src="../../icons/emblems/vcs-locally-modified.png" /> Cambiar Estado de Pago en Alquiler de Equipos.
	   </div>
		
    
	   <form action="main.php" method="POST">
            <input type="hidden" class="form-control" id="id" name="id" value="'.$id.'">
            <div class="form-group">
                <div class="form-group">
                    <label for="sel1">Seleccione Estado</label>
                       <select class="form-control" name="state">
                            <option value="" disabled selected>Seleccionar</option>
                            <option value="Pago">Pagó</option>
                            <option value="Debe">Debe</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success btn-block" name="update_estado_equi">
                        <img src="../../icons/actions/edit-redo.png"  class="img-reponsive img-rounded"> Cambiar</button>
            </form>
            </div><br>';

}

/*
** persistencia del cambio de estado
*/
function actualizarEstadoPagos($id,$estado,$conn){

    $sql = "update smb_turnos_equipos set estado_cobro = '$estado' where id = '$id'";
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
** funcion para análisis de montos cobrados en alquiler equipos por intervalos de tiempo
*/
function filtrosEquipos(){
  
   echo '<div class="alert alert-info" align="center">
	  <h3>Alquiler de Equipos</h3>
	  <p>Filtros para cierre de Pagos y Deudas por Día / Semana / Mes / Año</p>
	 </div><hr>
   
	  <form action="main.php" method="POST">
	    <div class="form-group">
	      <label>Seleccione Fecha:</label>
	      <input type="date" class="form-control" name="fecha" required>
	    </div><hr>
	    
	    <div class="form-group">
	      <label>Seleccione Estado de Pago:</label>
	      <select class="form-control" name="pago" required>
		<option value="" disabled selected>Seleccionar</option>
		<option value="Pago">Pagó</option>
		<option value="Debe">Debe</option>
	      </select>
	    </div><hr>
	    
	    <div class="alert alert-warning" alert-dismissible role="alert" align="center">
              <img src="../../icons/status/task-attempt.png"  class="img-reponsive img-rounded">
		<strong>Importante:</strong> Tenga en cuenta, que el filtro calculará una semana, mes o año a partir de la fecha que usted seleccione
            </div><hr>
	  
	  <div class="alert alert-warning" align="center">
	   <button type="submit" class="btn btn-default" name="d_equipo">
	      <img src="../../icons/actions/view-calendar-day.png"  class="img-reponsive img-rounded"> Filtrar Día</button>
	    <button type="submit" class="btn btn-default" name="s_equipo">
	      <img src="../../icons/actions/view-calendar-week.png"  class="img-reponsive img-rounded"> Filtrar Semana</button>
	    <button type="submit" class="btn btn-default" name="m_equipo">
	      <img src="../../icons/actions/view-calendar-month.png"  class="img-reponsive img-rounded"> Filtrar Mes</button>
	    <button type="submit" class="btn btn-default" name="a_equipo">
	      <img src="../../icons/actions/view-calendar.png"  class="img-reponsive img-rounded"> Filtrar Año</button>
	  </div>
	 </form><br>';
  
  
}


/*
** funcion que devuelve el filtro aplicado para un día
*/
function filtroDiaEquipos($fecha,$pago,$conn){
  
  $sql = "select sum(monto) as monto_total from smb_turnos_equipos where f_turno = '$fecha' and estado_cobro = '$pago'";
  mysqli_select_db($conn,'smb_bienestar');
  $query = mysqli_query($conn,$sql);
  while($row = mysqli_fetch_array($query)){
    $total = $row['monto_total'];
  }
  
  if($total == ''){
    
    $total = '0.00';
    
    
  }
  
  if($query){
  
  setlocale(LC_ALL,"es_ES");
  $fecha = strftime("%d %b %Y", strtotime($fecha));
    
    if($pago == 'Pago'){
     
	echo '<div class="alert alert-success" alert-dismissible role="alert">
		<img src="../../icons/status/task-complete.png"  class="img-reponsive img-rounded">
		  <strong>Atención:</strong> El total de Pagos para la fecha: <strong>'."$fecha".'</strong>  es de <strong>$'."$total".'</strong>
	      </div>';
    
  }
  if($pago == 'Debe'){
    
    echo '<div class="alert alert-warning" alert-dismissible role="alert">
	    <img src="../../icons/status/task-attempt.png"  class="img-reponsive img-rounded">
	      <strong>Atención:</strong> El total de Deuda para la fecha: <strong>'."$fecha".'</strong> es de <strong>$'."$total".'</strong>
	  </div>';
  }
  }else{
    
    echo '<div class="alert alert-success" alert-dismissible role="alert">
	    <img src="../../icons/emblems/emblem-important.png"  class="img-reponsive img-rounded">
	      <strong>Atención:</strong> Hubo un error al intentar realizar la consulta...
	  </div>';
  }
 
}


/*
** funcion que devuelve el filtro aplicado para una semana
*/
function filtroSemanaEquipos($fecha,$pago,$conn){
  
  $sql = "select date(date_add('$fecha', interval 1 week)) as semana, sum(monto) as monto_total from smb_turnos_equipos where estado_cobro = '$pago'";
  mysqli_select_db($conn,'smb_bienestar');
  $query = mysqli_query($conn,$sql);
  while($row = mysqli_fetch_array($query)){
    $total = $row['monto_total'];
    $f_hasta = $row['semana'];
  }
  
  if($total == ''){
    
    $total = '0.00';
    
    
  }
  
  if($query){
  
  setlocale(LC_ALL,"es_ES");
  $fecha = strftime("%d %b %Y", strtotime($fecha));
  $f_hasta = strftime("%d %b %Y", strtotime($f_hasta));
    
    if($pago == 'Pago'){
     
	echo '<div class="alert alert-success" alert-dismissible role="alert">
		<img src="../../icons/status/task-complete.png"  class="img-reponsive img-rounded">
		  <strong>Atención:</strong> El total de Pagos para el intervalo de fechas: <strong>'."$fecha".'</strong> hasta <strong>'."$f_hasta".'</strong> es de <strong>$'."$total".'</strong>
	      </div>';
    
  }
  if($pago == 'Debe'){
    
    echo '<div class="alert alert-warning" alert-dismissible role="alert">
	    <img src="../../icons/status/task-attempt.png"  class="img-reponsive img-rounded">
	      <strong>Atención:</strong> El total de Deuda para el intervalo de fechas: <strong>'."$fecha".'</strong> hasta <strong>'."$f_hasta".'</strong> es de <strong>$'."$total".'</strong>
	  </div>';
  }
  }else{
    
    echo '<div class="alert alert-success" alert-dismissible role="alert">
	    <img src="../../icons/emblems/emblem-important.png"  class="img-reponsive img-rounded">
	      <strong>Atención:</strong> Hubo un error al intentar realizar la consulta...
	  </div>';
  }
  
}


/*
** funcion que devuelve el filtro aplicado para un mes
*/
function filtroMesEquipos($fecha,$pago,$conn){
  
  $sql = "select date(date_add('$fecha', interval 1 month)) as semana, sum(monto) as monto_total from smb_turnos_equipos where estado_cobro = '$pago'";
  mysqli_select_db($conn,'smb_bienestar');
  $query = mysqli_query($conn,$sql);
  while($row = mysqli_fetch_array($query)){
    $total = $row['monto_total'];
    $f_hasta = $row['semana'];
  }
  
  if($total == ''){
    
    $total = '0.00';
    
    
  }
  
  if($query){
  
  setlocale(LC_ALL,"es_ES");
  $fecha = strftime("%d %b %Y", strtotime($fecha));
  $f_hasta = strftime("%d %b %Y", strtotime($f_hasta));
    
    if($pago == 'Pago'){
     
	echo '<div class="alert alert-success" alert-dismissible role="alert">
		<img src="../../icons/status/task-complete.png"  class="img-reponsive img-rounded">
		  <strong>Atención:</strong> El total de Pagos para el intervalo de fechas: <strong>'."$fecha".'</strong> hasta <strong>'."$f_hasta".'</strong> es de <strong>$'."$total".'</strong>
	      </div>';
    
  }
  if($pago == 'Debe'){
    
    echo '<div class="alert alert-warning" alert-dismissible role="alert">
	    <img src="../../icons/status/task-attempt.png"  class="img-reponsive img-rounded">
	      <strong>Atención:</strong> El total de Deuda para el intervalo de fechas: <strong>'."$fecha".'</strong> hasta <strong>'."$f_hasta".'</strong> es de <strong>$'."$total".'</strong>
	  </div>';
  }
  }else{
    
    echo '<div class="alert alert-success" alert-dismissible role="alert">
	    <img src="../../icons/emblems/emblem-important.png"  class="img-reponsive img-rounded">
	      <strong>Atención:</strong> Hubo un error al intentar realizar la consulta...
	  </div>';
  }
  
}


/*
** funcion que devuelve el filtro aplicado para un año
*/
function filtroAnioEquipos($fecha,$pago,$conn){
  
  $sql = "select date(date_add('$fecha', interval 1 year)) as semana, sum(monto) as monto_total from smb_turnos_equipos where estado_cobro = '$pago'";
  mysqli_select_db($conn,'smb_bienestar');
  $query = mysqli_query($conn,$sql);
  while($row = mysqli_fetch_array($query)){
    $total = $row['monto_total'];
    $f_hasta = $row['semana'];
  }
  
  if($total == ''){
    
    $total = '0.00';
    
    
  }
  
  if($query){
  
  setlocale(LC_ALL,"es_ES");
  $fecha = strftime("%d %b %Y", strtotime($fecha));
  $f_hasta = strftime("%d %b %Y", strtotime($f_hasta));
    
    if($pago == 'Pago'){
     
	echo '<div class="alert alert-success" alert-dismissible role="alert">
		<img src="../../icons/status/task-complete.png"  class="img-reponsive img-rounded">
		  <strong>Atención:</strong> El total de Pagos para el intervalo de fechas: <strong>'."$fecha".'</strong> hasta <strong>'."$f_hasta".'</strong> es de <strong>$'."$total".'</strong>
	      </div>';
    
  }
  if($pago == 'Debe'){
    
    echo '<div class="alert alert-warning" alert-dismissible role="alert">
	    <img src="../../icons/status/task-attempt.png"  class="img-reponsive img-rounded">
	      <strong>Atención:</strong> El total de Deuda para el intervalo de fechas: <strong>'."$fecha".'</strong> hasta <strong>'."$f_hasta".'</strong> es de <strong>$'."$total".'</strong>
	  </div>';
  }
  }else{
    
    echo '<div class="alert alert-success" alert-dismissible role="alert">
	    <img src="../../icons/emblems/emblem-important.png"  class="img-reponsive img-rounded">
	      <strong>Atención:</strong> Hubo un error al intentar realizar la consulta...
	  </div>';
  }
  
}

?>
