<?php

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



?>
