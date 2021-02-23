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
                    <button type="submit" class="btn btn-primary btn-sm" name="estado">
		      <img src="../../icons/actions/view-calendar-upcoming-events.png"  class="img-reponsive img-rounded"> Estado Solicitud</button>
                    <button type="submit" class="btn btn-success btn-sm" name="pay">
		      <img src="../../icons/actions/view-loan.png"  class="img-reponsive img-rounded"> Pagos</button>
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
                    echo '<option value="Pago" selected>Pagó</option>';
                    }else{
                    echo '<option value="Pago">Pagó</option>';
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


/*
** funcion ver turnos disponibles (entorno administrador)
*/
function gabineteTurno($conn){

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
		    <th class='text-nowrap text-center'>Cliente</th>
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
			 echo "<td align=center>".$fila['cliente']."</td>";
			 echo "<td class='text-nowrap'>";
			 if($fila['estado'] == 'Libre'){
			  
			 echo '<form <action="main.php" method="POST">
				<input type="hidden" name="id" value="'.$fila['id'].'">
				<button type="submit" class="btn btn-success btn-sm" name="reservaTurno">
				  <img src="../../icons/actions/view-calendar-upcoming-events.png"  class="img-reponsive img-rounded"> Reservar</button>';
				
			 }
			 if($fila['solicitud'] == 'Stand-By' && $fila['estado'] == 'Ocupado'){
			 
			 echo '<button type="submit" class="btn btn-primary btn-sm" name="cambiar_estado">
				  <img src="../../icons/actions/tools-wizard.png"  class="img-reponsive img-rounded"> Cambiar Estado</button>';
			  
			 }
			 echo '</form>';
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
** funcion formulario de solicitud turno
*/
function reserva($id,$conn){

$sql = "select * from smb_turnos_gabinete where id = '$id'";
mysqli_select_db($conn,'smb_bienestar');
$resp = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($resp)){
    $hora = $row['hora'];
    $fecha = $row['f_turno'];
    $espacio = $row['espacio'];
}

 echo '<form action="main.php" method="POST">
        <input type="hidden" class="form-control" id="id" name="id" value="'.$id.'">
  
	<div class="panel panel-success" >
	  <div class="panel-heading">
	    <span class="pull-center ">
	      <img src="../../icons/actions/documentation.png"  class="img-reponsive img-rounded"> Turno Gabinete
	</div><br>
  
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
		      mysqli_select_db($conn,'smb_bienestar');
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
		  <label for="sel1">Cliente</label>
		  <select class="form-control" name="cliente" required>
		  <option value="" disabled selected>Seleccionar</option>';
		    
		    if($conn){

		      $query = "SELECT * FROM smb_clientes";
		      mysqli_select_db($conn,'smb_bienestar');
		      $res = mysqli_query($conn,$query);

		      if($res)
		      {
			
			  while ($valores = mysqli_fetch_array($res))
			    {
				echo '<option value="'.$valores[nombre].'">'.$valores[nombre].'</option>';
			    }
			}
			}

			mysqli_close($conn);
		  
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
  
  
  <button type="submit" class="btn btn-success btn-block" name="reservar">
    <img src="../../icons/actions/dialog-ok-apply.png"  class="img-reponsive img-rounded"> Aceptar</button><br>  
</form>
</div>';

}

/*
** Función para guardar reserva de turno
*/
function addReserva($id,$especialidad,$espacio,$nombre,$hora,$fecha,$estado,$solicitud,$conn){
  
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
  
  
  
  
}

/*
** funcion para análisis de montos cobrados en gabinete por intervalos de tiempo
*/
function filtros(){
  
   echo '<div class="alert alert-info" align="center">
	  <h3>Turnos Gabinete</h3>
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
	   <button type="submit" class="btn btn-default" name="d">
	      <img src="../../icons/actions/view-calendar-day.png"  class="img-reponsive img-rounded"> Filtrar Día</button>
	    <button type="submit" class="btn btn-default" name="s">
	      <img src="../../icons/actions/view-calendar-week.png"  class="img-reponsive img-rounded"> Filtrar Semana</button>
	    <button type="submit" class="btn btn-default" name="m">
	      <img src="../../icons/actions/view-calendar-month.png"  class="img-reponsive img-rounded"> Filtrar Mes</button>
	    <button type="submit" class="btn btn-default" name="a">
	      <img src="../../icons/actions/view-calendar.png"  class="img-reponsive img-rounded"> Filtrar Año</button>
	  </div>
	 </form><br>';
  
  
}


/*
** funcion que devuelve el filtro aplicado para un día
*/
function filtroDia($fecha,$pago,$conn){
  
  $sql = "select sum(importe) as monto_total from smb_turnos_gabinete where f_turno = '$fecha' and pagos = '$pago'";
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
	    <img src="../../icons/status/task-complete.png"  class="img-reponsive img-rounded">
	      <strong>Atención:</strong> Hubo un error al intentar realizar la consulta...
	  </div>';
  }
  
  
  
}

/*
** funcion que devuelve el filtro aplicado para una semana
*/
function filtroSemana($fecha,$pago,$conn){
  
  $sql = "select date(date_add('$fecha', interval 1 week)) as semana, sum(importe) as monto_total from smb_turnos_gabinete where pagos = '$pago'";
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
	    <img src="../../icons/status/task-complete.png"  class="img-reponsive img-rounded">
	      <strong>Atención:</strong> Hubo un error al intentar realizar la consulta...
	  </div>';
  }
  
  
  
}


/*
** funcion que devuelve el filtro aplicado para un mes
*/
function filtroMes($fecha,$pago,$conn){
  
  $sql = "select date(date_add('$fecha', interval 1 month)) as semana, sum(importe) as monto_total from smb_turnos_gabinete where pagos = '$pago'";
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
	    <img src="../../icons/status/task-complete.png"  class="img-reponsive img-rounded">
	      <strong>Atención:</strong> Hubo un error al intentar realizar la consulta...
	  </div>';
  }
  
  
  
}


/*
** funcion que devuelve el filtro aplicado para un año
*/
function filtroAnio($fecha,$pago,$conn){
  
  $sql = "select date(date_add('$fecha', interval 1 year)) as semana, sum(importe) as monto_total from smb_turnos_gabinete where pagos = '$pago'";
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
	    <img src="../../icons/status/task-complete.png"  class="img-reponsive img-rounded">
	      <strong>Atención:</strong> Hubo un error al intentar realizar la consulta...
	  </div>';
  }
  
  
  
}

/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////// FIN SECCION TURNOS GABINETE /////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////




?>
