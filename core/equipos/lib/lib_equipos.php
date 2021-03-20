<?php

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
  
  <p><strong>Seleccione la Dirección en donde desea que le Entreguen el Equipo si posee más de una.</strong></p>
   <div class="radio">
    <label><input type="radio" name="direccion" value="'.$direccion.'" /> '.$direccion.'</label>
    </div>';
    
    if($direccion1 == ''){
    echo '<div class="radio">
    <label><input type="radio" name="direccion" value="'.$direccion1.'" hidden /> '.$direccion1.'</label>
    </div>';
    }else{
    echo '<div class="radio">
    <label><input type="radio" name="direccion" value="'.$direccion1.'" /> '.$direccion1.'</label>
    </div>';    
    }
    if($direccion2 == ''){
    echo '<div class="radio">
    <label><input type="radio" name="direccion" value="'.$direccion2.'" hidden /> '.$direccion2.'</label>
    </div><hr>';
    }else{
    echo '<div class="radio">
    <label><input type="radio" name="direccion" value="'.$direccion2.'" /> '.$direccion2.'</label>
    </div>';    
    }
    
    echo '<div class="form-group">
		  <label for="sel1">Seleccione Localidad:</label>
		  <select class="form-control" name="localidad" required>
		  <option value="" disabled selected>Seleccionar</option>';
		    
		    if($conn){

		      $query = "SELECT * FROM smb_localidades order by localidad ASC";
		      mysqli_select_db($conn,'smb_bienestar');
		      $res = mysqli_query($conn,$query);

		      if($res)
		      {
			
			  while ($valores = mysqli_fetch_array($res))
			    {
				echo '<option value="'.$valores[cod_loc].'">'.$valores[localidad].'</option>';
			    }
			}
			}

			//mysqli_close($conn);
		  
		 echo '</select>
		</div><hr>
    
    <p><strong>Especifique a partir de que hora.</strong</p>
    <div class="form-group">
    <label for="usr">Hora:</label>
    <input type="time" class="form-control" id="usr" name="hora_desde" min="08:00" max="15:00" step="1" required>
    </div><hr>
    
    <p><strong>Seleccione la cantidad de Horas de alquiler.</strong></<p>
    
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
  
  
  <button type="submit" class="btn btn-success btn-block" name="reserva_ok"><img src="../../icons/actions/dialog-ok-apply.png"  class="img-reponsive img-rounded"> Aceptar</button><br>  
</form>

</div></div></div>
    </div>
    </div>';

}


/*
** funcion formulario reserva de equipo 2
*/
function formReservaEquipo2($nombre,$f_turno,$direccion,$localidad,$h_desde,$c_horas,$equipo,$conn){
    
    mysqli_select_db($conn,'smb_bienestar');
   $consul = "select * from smb_equipos where cod_equipo = '$equipo'";
   $result = mysqli_query($conn,$consul);
   while($line = mysqli_fetch_array($result)){
    $modelo = $line['modelo'];
   }
   
   $sql = "select if(f_turno = '$f_turno', 1, 0) fe_turno, if(hora_desde = '$h_desde', 1, 0) h_desde, if(equipo = '$modelo', 1, 0) equipo, hora_hasta from smb_turnos_equipos";
   $resp = mysqli_query($conn,$sql);
    
   
   $query = "select * from smb_localidades where cod_loc = '$localidad'";
   $res = mysqli_query($conn,$query);
   while($fila = mysqli_fetch_array($res)){
   $loc = $fila['localidad'];
   $km = $fila['kilometros'];
   $monto = $fila['monto_final'];
   }
   
   $qry = "select * from smb_equipos where cod_equipo = '$equipo'";
   $result = mysqli_query($conn,$qry);
   while($row = mysqli_fetch_array($result)){
    $modelo = $row['modelo'];
   }
   
   $consulta = "select * from smb_clientes where nombre = '$nombre'";
   $resval = mysqli_query($conn,$consulta);
   while($linea = mysqli_fetch_array($resval)){
   $dni = $linea['dni'];
   $movil = $linea['movil'];
   }
   
   $hora1 = strtotime($h_desde);
   $hora2 = strtotime($c_horas);
   $banda1 = strtotime('06:00:00');
   $banda2 = strtotime('08:00:00');
   $banda3 = strtotime('12:00:00');
   $limA = strtotime('15:00:00');
   $limB = strtotime('13:00:00');
   $limC = strtotime('09:00:00');
   
   if(($hora1 <= $limA && $hora2 == $banda1) || ($hora1 <= $limB && $hora2 == $banda2) || ($hora1 == $limC && $hora2 == $banda3)){
   
      while($rows = mysqli_fetch_array($resp)){     
                      
                if($rows['fe_turno'] == 1 && $rows['h_desde'] == 1 && $rows['equipo'] == 1){
                
                echo '<div class="container">';
		echo '<div class="alert alert-warning" alert-dismissible role="alert">';
		echo '<img class="img-reponsive img-rounded" src="../../icons/status/task-attempt.png" /> El Equipo solicitado ya se encuentra reservado en dicha fecha y horario, seleccione una fecha u horario distinto';
		echo "</div>";
		echo "</div>";
		exit;
		
		}
		if($rows['fe_turno'] == 0 && $rows['h_desde'] == 0 && $rows['equipo'] == 0 || $rows['fe_turno'] == 0 && $rows['h_desde'] == 1 && $rows['equipo'] == 1 || $rows['fe_turno'] == 1 && $rows['h_desde'] == 1 && $rows['equipo'] == 0){
	
         
   echo '<div class="container">
        <div class="row">
        <div class="col-sm-8">
        
        <div class="alert alert-info">
	  <img src="../../icons/actions/help-about.png"  class="img-reponsive img-rounded"> Existe disponibilidad para Alquilar dicho equipo.
	</div><hr>
        
        <div class="panel panel-success">
        <div class="panel-heading"><img src="../../icons/actions/flag-blue.png"  class="img-reponsive img-rounded"> Solicitud Alquier Equipo</div>
        <div class="panel-body">';
        
        
        
                
 echo '<form action="main.php" method="POST">
 
  
  <div class="form-group">
    <label for="f_turno">Fecha Turno Seleccionada:</label>
    <input type="date" class="form-control" id="f_turno" name="f_turno" value="'.$f_turno.'" readonly required>
  </div><hr>
  
  <p><strong>Dirección que ha informado.</strong></p>
   <div class="radio">
    <label><input type="radio" name="direccion" value="'.$direccion.'" checked /> '.$direccion.'</label>
    </div><hr>
    
    <div class="form-group">
    <label for="f_turno">Localidad Seleccionada:</label>
    <input type="text" class="form-control" name="localidad" value="'.$loc.'" readonly required>
  </div><hr>
    
       
    <div class="form-group">
    <label for="usr">Hora de entrega seleccionada:</label>
    <input type="time" class="form-control" id="usr" name="hora_desde" value="'.$h_desde.'" readonly required>
    </div><hr>
    
    <div class="form-group">
    <label for="usr">Cantidad de Horas de Alquiler Seleccionadas:</label>
    <input type="text" class="form-control" id="usr" name="cantidad_horas" value="'.$c_horas.'" readonly required>
    </div><hr>
    
    <div class="form-group">
    <label for="usr">Equipo a Alquilar:</label>
    <input type="text" class="form-control" id="usr" name="equipo" value="'.$modelo.'" readonly required>
    </div><hr>
    
    <h2><strong>Información sobre Alquiler</strong></h2><hr>';
    
    if($km > 10.00){
        
        if($c_horas == "06:00"){
            $total = $monto + 5000;
            $total = number_format($total, 2, '.', '');
            echo '<div class="form-group">
            <label for="usr">Monto total:</label>
            <input type="text" class="form-control" name="monto" value="'.$total.'" readonly required>
            </div><hr>';
        }
        if($c_horas == "08:00"){
            $total = $monto + 5500;
            $total = number_format($total, 2, '.', '');
            echo '<div class="form-group">
            <label for="usr">Monto total:</label>
            <input type="text" class="form-control" name="monto" value="'.$total.'" readonly required>
            </div><hr>';
        }
        if($c_horas == "12:00"){
            $total = $monto + 7000;
            $total = number_format($total, 2, '.', '');
            echo '<div class="form-group">
            <label for="usr">Monto total:</label>
            <input type="text" class="form-control" name="monto" value="'.$total.'" readonly required>
            </div><hr>';
        }
    }else{
        
        if($c_horas == "06:00"){
            $total = 5000;
            $total = number_format($total, 2, '.', '');
            echo '<div class="form-group">
            <label for="usr">Monto total:</label>
            <input type="text" class="form-control" name="monto" value="'.$total.'" readonly required>
            </div><hr>';
        }
        if($c_horas == "08:00"){
            $total = 5500;
            $total = number_format($total, 2, '.', '');
            echo '<div class="form-group">
            <label for="usr">Monto total:</label>
            <input type="text" class="form-control" name="monto" value="'.$total.'" readonly required>
            </div><hr>';
        }
        if($c_horas == "12:00"){
            $total = 7000;
            $total = number_format($total, 2, '.', '');
            echo '<div class="form-group">
            <label for="usr">Monto total:</label>
            <input type="text" class="form-control" name="monto" value="'.$total.'" readonly required>
            </div><hr>';
        }
    }
    
     
    $hora_hasta = suma_horas($h_desde,$c_horas);
    
    echo '<div class="form-group">
            <label for="usr">Hora de Retiro del Equipo :</label>
            <input type="text" class="form-control" name="hora_hasta" value="'.$hora_hasta.'" readonly required>
            </div><hr>';
    
    echo '<h2><strong>Datos del Cliente</strong></h2><hr>
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
  
  <h2><strong>Modo de Pago</strong></h2><hr>
  
      <p>Si desea pagar en efectivo al momento de la entrega o retiro del equipo, tipee "Efectivo" en el campo de tipo de pago</p><hr>
      <p>Si desea realizar una tranferencia bancaria los datos de la cuenta son los siguientes:</p>
      <p>BBVA Banco Frances Caja de Ahorro</p>
      <p>CBU: 0170108740000003458507</p>
      <p>Ingrese el número de referencia de la transferencia en el campo tipo de pago</p><hr>
      <p>Si desea realizar el pago a traves de Mercado Pago, scanee el Código QR q está aquí abajo, Una vez que haya scaneado y pagado, ingrese el Nro. de Operación que lo encontrará en Actividad desde la app de Mercado Pago</p>
      <p align=center><img src="../../../img/sm_bienestar_qr.png"  class="img-reponsive img-rounded"></p><hr>
      
      <label for="usr">Tipo de Pago:</label>
      <div class="form-group">
      <input type="text" class="form-control" name="pago">
      </div><hr>
      
        
	<div class="alert alert-warning">
	  <img src="../../icons/status/task-attempt.png"  class="img-reponsive img-rounded"> Antes de presionar Aceptar, verifique que los datos son todos correctos.
	</div><hr>
  
  <button type="submit" class="btn btn-success btn-block" name="reserva_final"><img src="../../icons/actions/dialog-ok-apply.png"  class="img-reponsive img-rounded"> Aceptar</button><br>  
</form>
  
</div>';
break;
        } // fin if fecha, hora y equipos distintos
        if($rows['fe_turno'] == 1 && $rows['h_desde'] == 0 && $rows['equipo'] == 1){
            
            $hora_max = '21:00:00';
            $h_resto = restar_horas($hora_max,$rows[hora_hasta]);
                       
                       
            if($h_resto != '06:00:00'){
	      
	     echo '<div class="alert alert-warning">
		    <img src="../../icons/status/task-attempt.png"  class="img-reponsive img-rounded"> El mínimo de horas de alquiler es de 6, el día de hoy el equipo deseado ya no tiene disponibilidad. Seleccione otro día y horario
		  </div>';
	    }
            if($h_resto == '06:00:00'){
	      
	      echo '<div class="alert alert-warning"> 
		      <p align="center"><img src="../../icons/status/task-attempt.png"  class="img-reponsive img-rounded"> <strong>Atención</strong></p><hr>
		      <p align="center">El equipo <strong>'.$modelo.'</strong> en la fecha: <strong>'.$f_turno.'</strong> se liberará a partir de la/s <strong>'.$rows['hora_hasta'].'</strong> hora/s</p>
		      <p align="center">En esta fecha solo quedan 6 hrs disponible para alquilar dicho equipo</p>
		      <p align="center"><strong>Si desea continuar, verifique que los datos presentados a continuación sean los correctos, ingrese el modo de Pago y presione Aceptar, de lo contrario, seleccione un nuevo día y horario</strong></p>
		    </div>';
		    
		    echo '<div class="container">
        <div class="row">
        <div class="col-sm-8">
        
        <div class="panel panel-success">
        <div class="panel-heading"><img src="../../icons/actions/flag-blue.png"  class="img-reponsive img-rounded"> Solicitud Alquier Equipo</div>
        <div class="panel-body">';
        
        
        
                
 echo '<form action="main.php" method="POST">
 
  
  <div class="form-group">
    <label for="f_turno">Fecha Turno Seleccionada:</label>
    <input type="date" class="form-control" id="f_turno" name="f_turno" value="'.$f_turno.'" readonly required>
  </div><hr>
  
  <p><strong>Dirección que ha informado.</strong></p>
   <div class="radio">
    <label><input type="radio" name="direccion" value="'.$direccion.'" checked /> '.$direccion.'</label>
    </div><hr>
    
    <div class="form-group">
    <label for="f_turno">Localidad Seleccionada:</label>
    <input type="text" class="form-control" name="localidad" value="'.$loc.'" readonly required>
  </div><hr>
    
       
    <div class="form-group">
    <label for="usr">Hora de entrega seleccionada (única disponible):</label>
    <input type="time" class="form-control" id="usr" name="hora_desde" value="'.$rows['hora_hasta'].'" readonly required>
    </div><hr>
    
    <div class="form-group">
    <label for="usr">Cantidad de Horas de Alquiler Seleccionadas:</label>
    <input type="text" class="form-control" id="usr" name="cantidad_horas" value="'.$h_resto.'" readonly required>
    </div><hr>
    
    <div class="form-group">
    <label for="usr">Equipo a Alquilar:</label>
    <input type="text" class="form-control" id="usr" name="equipo" value="'.$modelo.'" readonly required>
    </div><hr>
    
    <h2><strong>Información sobre Alquiler</strong></h2><hr>';
    
    if($km > 10.00){
        
        if($h_resto == "06:00:00"){
            $total = $monto + 5000;
            $total = number_format($total, 2, '.', '');
            echo '<div class="form-group">
            <label for="usr">Monto total:</label>
            <input type="text" class="form-control" name="monto" value="'.$total.'" readonly required>
            </div><hr>';
        }
       
    }else{
        if($h_resto == "06:00:00"){
            $total = 5000;
            $total = number_format($total, 2, '.', '');
            echo '<div class="form-group">
            <label for="usr">Monto total:</label>
            <input type="text" class="form-control" name="monto" value="'.$total.'" readonly required>
            </div><hr>';
        }
       
    }
    
     
    $hora_hasta = suma_horas($rows['hora_hasta'],$c_horas);
    
    echo '<div class="form-group">
            <label for="usr">Hora de Retiro del Equipo :</label>
            <input type="text" class="form-control" name="hora_hasta" value="'.$hora_hasta.'" readonly required>
            </div><hr>';
    
    echo '<h2><strong>Datos del Cliente</strong></h2><hr>
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
  
  <h2><strong>Modo de Pago</strong></h2><hr>
  
      <p>Si desea pagar en efectivo al momento de la entrega o retiro del equipo, tipee "Efectivo" en el campo de tipo de pago</p><hr>
      <p>Si desea realizar una tranferencia bancaria los datos de la cuenta son los siguientes:</p>
      <p>BBVA Banco Frances Caja de Ahorro</p>
      <p>CBU: 0170108740000003458507</p>
      <p>Ingrese el número de referencia de la transferencia en el campo tipo de pago</p><hr>
      <p>Si desea realizar el pago a traves de Mercado Pago, scanee el Código QR q está aquí abajo, Una vez que haya scaneado y pagado, ingrese en el campo Tipo de Pago, el Nro. de Operación que lo encontrará en Actividad desde la app de Mercado Pago</p>
      <p align=center><img src="../../../img/sm_bienestar_qr.png"  class="img-reponsive img-rounded"></p><hr>
      
      <label for="usr">Tipo de Pago:</label>
      <div class="form-group">
      <input type="text" class="form-control" name="pago">
      </div><hr>
      
        
	<div class="alert alert-warning">
	  <img src="../../icons/status/task-attempt.png"  class="img-reponsive img-rounded"> Antes de presionar Aceptar, verifique que los datos son todos correctos.
	</div><hr>
  
  <button type="submit" class="btn btn-success btn-block" name="reserva_final"><img src="../../icons/actions/dialog-ok-apply.png"  class="img-reponsive img-rounded"> Aceptar</button><br>  
</form>
  
</div>';
break;

}
        
        }
        } // end of while
        }else{
	  
	echo '<div class="alert alert-warning">
	       <img src="../../icons/status/task-attempt.png"  class="img-reponsive img-rounded"> De acuerdo a la hora de entrega y cantidad de horas seleccionadas, está sobrepasando la hora limite que son las 21 hs, Por favor seleccione otro horario y cantidad de horas.
	      </div><hr>';
	   
        }
        
	    
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
function addTurnoEquipo($f_turno,$direccion,$localidad,$hora_desde,$hora_hasta,$equipo,$cliente,$dni,$movil,$m_pago,$monto,$conn){
    
    $estado = 'Ocupado';
    $solicitud = 'Stand-By';
           
    mysqli_select_db($conn,'smb_bienestar');	

	$sql = "INSERT INTO smb_turnos_equipos ".
		"(f_turno,direccion,localidad,equipo,hora_desde,hora_hasta,cliente,dni,movil,m_pago,monto,estado,solicitud)".
		"VALUES ".
      "('$f_turno','$direccion','$localidad','$equipo','$hora_desde','$hora_hasta','$cliente','$dni','$movil','$m_pago','$monto','$estado','$solicitud')";
    
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


/*<h2><strong>Datos del Cliente</strong></h2><hr>
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
  
  <h2><strong>Modo de Pago</strong></h2><hr>

   <div class="panel-group" id="accordion">
  
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
        Pago en Efectivo (retiro o entrega)</a>
      </h4>
    </div>
    <div id="collapse2" class="panel-collapse collapse">
      <div class="panel-body">
      <label class="checkbox-inline"><input type="checkbox" name="pago" value="Pago Efectivo">Pago en Efectivo</label>
      </div>
    </div>
  </div>
  
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
        Transferencia Bancaria</a>
      </h4>
    </div>
    
     <div id="collapse3" class="panel-collapse collapse">
      <div class="panel-body">
      <p>BBVA Banco Frances Caja de Ahorro
      <p>CBU: 0170108740000003458507</p><hr>
      <div class="form-group">
        <label for="usr">Nro de Referencia de la Tranferencia:</label>
        <input type="text" class="form-control" name="pago" value="NRT-">
      </div>
      </div>
    </div>
  </div>
  
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
       Mercado Pago</a>
      </h4>
    </div>
    <div id="collapse4" class="panel-collapse collapse">
      <div class="panel-body">
      <p align=center><img src="../../../img/sm_bienestar_qr.png"  class="img-reponsive img-rounded"></p><hr>
      <p>Una vez que haya scaneado y pagado, ingrese el Nro. de Operación que lo encontrará en Actividad desde la app de Mercado Pago</p>
      <div class="form-group">
        <label for="usr">Nro de Operación:</label>
        <input type="text" class="form-control" name="pago" value="NOMP-">
      </div>
      </div>
    </div>
  </div>
  
</div> */




////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////// FIN SECCION TURNOS EQUIPOS ////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////


////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////// SECCION MENSAJES Y ALERTAS ////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////

function modal_1(){

    echo '<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Desea cancelar Reserva de Equipo?</h4>
      </div>
      <div class="modal-body">
    
        
        <form action="main.php" method="POST">
        <input type="hidden" class="form-control" name="bookId" id="bookId" value="bookId">
               
         
  <button type="submit" class="btn btn-success btn-block" name="cancel"><img src="../../icons/actions/dialog-ok-apply.png"  class="img-reponsive img-rounded"> Aceptar</button><br>  
</form>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
</div>';

}


function modal_2(){

    echo '<div id="myModal2" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">
            <img class="img-reponsive img-rounded" src="../../icons/actions/help-contents.png" /> Ayuda en línea</h4>
      </div>
      <div class="modal-body">
        
        <div class="container-fluid">
            <ul class="nav nav-pills ">
    <li class="active"><a data-toggle="tab" href="#home">
        <img class="img-reponsive img-rounded" src="../../icons/actions/view-calendar-timeline.png" /> Solicitar Turno</a></li>
    <li><a data-toggle="tab" href="#menu1">
        <img class="img-reponsive img-rounded" src="../../icons/actions/documentation.png" /> Turnos Reservados</a></li>
    <li><a data-toggle="tab" href="#menu2">
        <img class="img-reponsive img-rounded" src="../../icons/actions/user-group-properties.png" /> Datos Personales</a></li>
    <li><a data-toggle="tab" href="#menu3">
        <img class="img-reponsive img-rounded" src="../../icons/actions/view-refresh.png" /> Cambiar Password</a></li>
    <li><a data-toggle="tab" href="#menu4">
        <img class="img-reponsive img-rounded" src="../../icons/apps/kcmdf.png" /> Agregar Módulo</a></li>
    
    </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <h2>Solicitar Turno</h2>
      <p align="justify">Desde aquí usted visualizará los equipos que ya han sido alquilados. Así mismo aquellos turnos ocupados se mostrarán en color rojo sobre la fecha y mostrará la información de cada equipo. Si usted desea realizar la reserva para el alquiler de algún equipo deberá hacer click en el botón <strong>Reservar</strong>, se le presentará un formulario el cual lo guiará a traves del proceso de alquiler. Cada paso está explicado, sólo debe prestar atención a los mensajes. </p>
    </div>
    
    <div id="menu1" class="tab-pane fade">
      <h2>Turnos Reservados</h2>
      <p align="justify">Aquí podrá visualizar el historial de turnos para alquiler de equipos que ha ido reservando, cuando realice la reserva de un nuevo turno, estará habilitado el botón de cancelación del mismo. <strong>Es importante que tenga en cuenta que en caso de no querer continuar manteniendo la reserva para el alquiler, deberá cancelar el turno con una antelación de 48 hs, de lo contrario en el próximo turno de alquiler que solicite le será cobrado una multa.</strong></p>
    </div>
    
    <div id="menu2" class="tab-pane fade">
      <h2>Datos Personales</h2>
      <p align="justify">En este apartado usted podrá modificar sus datos, tenga en cuenta que los mismos son vitales para el contacto que tenga el personal de SM-Bienestar con cada cliente. Por lo cual le solicitamos que sean datos reales y en lo posible que siempre estén completos. Para modificar algunos de sus datos, sólo deberá presionar el botón editar a la derecha de sus datos y se le presentará un formulario con sus datos, solo modifique el que desea y luego presione <strong>Aceptar</strong> y sus datos serán actualizados. También se encuentra el botón de <strong>Avatar</strong>. Este le posobilitará subir una imagen que identificará a su usuario. No es obligatorio subir una imagen, pero si lo desea, a SM-Bienestar le ayudará para conocer a sus clientes más estrechamente.</p>
    </div>
    
    <div id="menu3" class="tab-pane fade">
      <h2>Cambiar Password</h2>
      <p align="justify">Modificar su password (contraseña) es importante, siempre y cuando usted lo desee. Aquí le vamos a dar algunos consejos a la hora de cambiar su password. Siempre trate de utilizar Letras mayúsculas y minúsculas combinadas con números, esto hará que su contraseña sea más segura. Por otro lado, evite usar como password fechas de cumpleaños o datos que sean fácilmente descifrables. En este caso la contraseña deberá tener una longitud máxima de 15 caracteres, si se excede la aplicación le avisará que se ha excedido. Recuerde siempre que la contraseña es personal y no debe divulgarla.</p>
    </div>
    
    <div id="menu4" class="tab-pane fade">
      <h2>Agregar Módulo</h2>
      <p align="justify">Los módulos son los diferentes entornos con los que usted podrá operar en SM-Bienestar. Cada módulo es independiente de los demás. Usted podrá estar suscripto a todos los módulos y no es necesario volver a registrarse en la página. Al presionar sobre el botón <strong>Agregar Módulo</strong> se le informará en que módulo o módulos usted esta suscripto y si desea agregar algún otro, tendrá un desplegable para seleccionar al que desea sumarse. Una vez realizada esta acción usted ya estará suscripto al nuevo módulo y listo para operar. La forma en que deberá ingresar es desconectarse del módulo en el que esté conectado, y desde la página de inicio seleccionar el módulo al que desea ingresar e identificarse con su usuario y contraseña, así de simple.</p>

    </div>
    
       
  </div>
        </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">
            <img class="img-reponsive img-rounded" src="../../icons/actions/window-close.png" /> Cerrar</button>
      </div>
    </div>

  </div>
</div>';

}


?>
