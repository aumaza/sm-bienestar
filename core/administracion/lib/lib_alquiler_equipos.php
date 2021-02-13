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









?>