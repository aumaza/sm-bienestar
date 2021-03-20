<?php

/////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////// SECCION TURNOS GABINETE ////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/*
** funcion ver turnos disponibles (entorno de usuario)
*/
function gabineteTurnos($conn){

if($conn){
	
	$sql = "SELECT * FROM smb_turnos_gabinete where f_turno BETWEEN CURDATE() and CURDATE() + INTERVAL 1 week";
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
            <p><strong>Nota: </strong> Todos los turnos que haya solicitado apareceran con estado <strong>Stand-By</strong> por defecto en color Amarillo, cuando el Centro de Estética confirme su solicitud aparecerá como <strong>Confirmado</strong> y en color verde, si lo cancelacen aparecerá con color Rojo, si fue <strong>Atendido</strong> aparecerá en color azul.</p>
            <p>En caso de cancelar un turno, por favor hágalo con 48 hs de antelación. Muchas Gracias.</p><hr>';

            echo "<table class='display compact' style='width:100%' id='myTable'>";
              echo "<thead>
		    <th class='text-nowrap text-center'>ID</th>
		    <th class='text-nowrap text-center'>Fecha</th>
            <th class='text-nowrap text-center'>Hora</th>
            <th class='text-nowrap text-center'>Especialidad</th>
            <th class='text-nowrap text-center'>Espacio</th>
            <th class='text-nowrap text-center'>Solicitud</th>
            <th class='text-nowrap text-center'>Estado de Pago</th>
            <th class='text-nowrap text-center'>Importe</th>
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
			 if($fila['solicitud'] == 'Atendido'){
			 echo '<td align=center style="background-color:blue"><font color="white">'.$fila['f_turno'].'</font></td>';
			 }
			 echo "<td align=center>".$fila['hora']."</td>";
			 echo "<td align=center>".$fila['especialidad']."</td>";
			 echo "<td align=center>".$fila['espacio']."</td>";
			 echo "<td align=center>".$fila['solicitud']."</td>";
			 echo "<td align=center>".$fila['pagos']."</td>";
			 echo "<td align=center>".$fila['importe']."</td>";
			 echo "<td class='text-nowrap'>";
			 if($fila['solicitud'] != 'Atendido'){
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
//////////////////////////////////////// SECCION ALERTAS Y MENSAJES//////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////

function modal_1(){

    echo '<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Desea cancelar Turno?</h4>
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
        <img class="img-reponsive img-rounded" src="../../icons/actions/view-calendar-timeline.png" /> Turnos Disponibles</a></li>
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
      <h2>Turnos Disponibles</h2>
      <p align="justify">Desde aquí usted podrá visualizar todos los turnos disponibles desde la fecha actual con un intervalo de una semana.
            Así mismo aquellos turnos ocupados se mostrarán en color rojo sobre la fecha y no estará habilitado el botón de reserva.
                Tenga en cuenta que las fechas y horarios que se muestran son los que están habilitados, <strong>no se otorgarán turnos de manera telefónica.</strong> Para proceder a reservar un turno, solo deberá hacer click sobre el botón <strong>Reservar</strong> y luego desde el formulario de reserva, seleccionar la especialidad a la cual desea acceder. </p>
    </div>
    
    <div id="menu1" class="tab-pane fade">
      <h2>Turnos Reservados</h2>
      <p align="justify">Aquí podrá visualizar el historial de turnos que ha ido reservando, cuando realice la reserva de un nuevo turno, estará habilitado el botón de cancelación del mismo. <strong>Es importante que tenga en cuenta que en caso de no poder concurrir, deberá cancelar el turno con una antelación de 48 hs, de lo contrario en el próximo turno que solicite le será cobrado el turno que no canceló debidamente.</strong></p>
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
