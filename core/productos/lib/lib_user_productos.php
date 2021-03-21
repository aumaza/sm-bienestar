<?php

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
			 if($fila['picture'] != ''){
			 echo "<td align=center><img src='$fila[picture]' alt='Avatar' class='avatar' ></td>";
			 }else{
			 echo "<td align=center><img src='../../icons/categories/system-help.png' alt='Avatar' class='avatar' ></td>";
			 }
			 echo "<td align=center>".$fila['cod_producto']."</td>";
			 echo "<td align=center>".$fila['marca']."</td>";
			 echo "<td align=center>".$fila['descripcion']."</td>";
			 echo "<td align=center>".$fila['precio']."</td>";
			 echo "<td class='text-nowrap'>";
			 echo '<form <action="main.php" method="POST">
                    <input type="hidden" name="id" value="'.$fila['id'].'">
                    <button type="submit" class="btn btn-success btn-sm" name="buy_producto"><img src="../../icons/status/wallet-open.png"  class="img-reponsive img-rounded"> Comprar</button>
                   </form>';
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


/*
** funciion de carga de cartelera
*/
function misPedidos($nombre,$conn){

if($conn)
{
	$sql = "SELECT * FROM smb_pedidos_productos where cliente = '$nombre'";
    	mysqli_select_db($conn,'smb_bienestar');
    	$resultado = mysqli_query($conn,$sql);
	//mostramos fila x fila
	$count = 0;
	echo '<div class="panel panel-default" >
	      <div class="panel-heading"><span class="pull-center "><img src="../../icons/actions/view-pim-notes.png"  class="img-reponsive img-rounded"> Mis Pedidos';
	echo '</div><br>';

            echo "<table class='display compact' style='width:100%' id='myTable'>";
              echo "<thead>
		    <th class='text-nowrap text-center'>ID</th>
		    <th class='text-nowrap text-center'>Estado</th>
		    <th class='text-nowrap text-center'>Fecha Pedido</th>
		    <th class='text-nowrap text-center'>Código Producto</th>
		    <th class='text-nowrap text-center'>Descripción</th>
		    <th class='text-nowrap text-center'>Marca</th>
		    <th class='text-nowrap text-center'>Precio</th>
            <th class='text-nowrap text-center'>Cantidad</th>
            <th class='text-nowrap text-center'>Tipo Pago</th>
            <th class='text-nowrap text-center'>Importe Total</th>
            <th>&nbsp;</th>
            </thead>";


	while($fila = mysqli_fetch_array($resultado)){
			  // Listado normal
			 echo "<tr>";
			 echo "<td align=center>".$fila['id']."</td>";
			 if($fila['estado'] == ''){
			 echo "<td align=center>".$fila['estado']."</td>";
			 }
			 if($fila['estado'] == 'Debe'){
			 echo '<td align=center style="background-color:red"><font color="white">'.$fila['estado'].'</font></td>';
			 }
			 if($fila['estado'] == 'Pago'){
			 echo '<td align=center style="background-color:green"><font color="black">'.$fila['estado'].'</font></td>';
			 }
             echo "<td align=center>".$fila['f_pedido']."</td>";
			 echo "<td align=center>".$fila['cod_producto']."</td>";
			 echo "<td align=center>".$fila['descripcion']."</td>";
			 echo "<td align=center>".$fila['marca']."</td>";
			 echo "<td align=center>".$fila['precio']."</td>";
			 echo "<td align=center>".$fila['cantidad']."</td>";
			 echo "<td align=center>".$fila['tipo_pago']."</td>";
			 echo "<td align=center>".$fila['importe']."</td>";
			 echo "<td class='text-nowrap'>";
			 echo "</td>";
			 $count++;
		}

		echo "</table>";
		echo "<br>";
		echo '<button type="button" class="btn btn-primary">Cantidad de Pedidos:  ' .$count; echo '</button>';
		echo '</div>';
		}else{
		  echo 'Connection Failure...';
		}

    mysqli_close($conn);
}

/*
** funcion para realizar pedido de producto
*/
function newPedido($id,$nombre,$conn){

    $sql = "select * from smb_productos where id = '$id'";
    mysqli_select_db($conn,'smb_bienestar');
    $query = mysqli_query($conn,$sql);
    while($fila = mysqli_fetch_array($query)){
        $cod = $fila['cod_producto'];
        $imagen = $fila['picture'];
        $marca = $fila['marca'];
        $descripcion = $fila['descripcion'];
        $precio = $fila['precio'];    
    }
    
    $consulta = "select * from smb_clientes where nombre = '$nombre'";
    mysqli_select_db($conn,'smb_bienestar');
    $resp = mysqli_query($conn,$consulta);
    while($row = mysqli_fetch_array($resp)){
        $cel = $row['movil'];
        $mail = $row['email'];
        $direccion = $row['direccion'];
    }
    
        echo '<div class="container">
                <div class="row">
                <div class="col-sm-10">
            
                <div class="panel panel-primary">
                <div class="panel-heading"><img src="../../icons/status/wallet-open.png"  class="img-reponsive img-rounded"> Compra de Producto</div>
                <div class="panel-body">
                <div class="alert alert-warning">
                <p align="center"><img src="../../icons/status/security-medium.png"  class="img-reponsive img-rounded"> Usted está por iniciar el proceso de compra del siguiente producto: </p>
                </div><hr>
                
                <div class="alert alert-info">
                <p align="center"><img src="../../icons/status/dialog-information.png"  class="img-reponsive img-rounded"> Datos del Producto </p>
                </div><hr>
                
                <form action="main.php" method="POST">
                
                <p><strong>Código Producto</strong>:</p>
                <div class="form-group">
                <input type="text" class="form-control" name="cod_prod" value="'.$cod.'" readonly>
                </div><hr>
                
                <p><strong>Marca</strong>:</p>
                <div class="form-group">
                <input type="text" class="form-control" name="marca" value="'.$marca.'" readonly>
                </div><hr>
                
                <p><strong>Descripción</strong>:</p>
                <div class="form-group">
                <input type="text" class="form-control" name="descripcion" value="'.$descripcion.'" readonly>
                </div><hr>
                
                <p><strong>Precio</strong>:</p>
                <div class="form-group">
                <input type="text" class="form-control" id="precio" name="precio" value="'.$precio.'" readonly>
                </div><hr>                
                
                <div class="alert alert-info">
                <p align="center"><img src="../../icons/status/dialog-information.png"  class="img-reponsive img-rounded"> Datos del Cliente </p>
                </div><hr>
                
                <p><strong>Cliente</strong>:</p>
                <div class="form-group">
                <input type="text" class="form-control" name="cliente" value="'.$nombre.'" readonly>
                </div><hr>
                
                <p><strong>Celular</strong>:</p>
                <div class="form-group">
                <input type="text" class="form-control" name="cel" value="'.$cel.'" readonly>
                </div><hr>
                
                <p><strong>Dirección</strong>:</p>
                <div class="form-group">
                <input type="text" class="form-control" name="direccion" value="'.$direccion.'" readonly>
                </div><hr>
                
                <p><strong>Email</strong>:</p>
                <div class="form-group">
                <input type="email" class="form-control" name="email" value="'.$mail.'" readonly>
                </div><hr>                
                
                <div class="alert alert-info">
                <p align="center"><img src="../../icons/status/dialog-information.png"  class="img-reponsive img-rounded"> Datos de la Compra </p>
                </div><hr>
                
                <div class="form-group">
                <label for="cantidad">Cantidad:</label>
                <input type="number" class="form-control" id="cantidad"  name="cantidad" min="1"  required>
                </div><hr>
                  
                                
                <h2><strong>Tipo de Pago</strong>:</h2>
                <p>Tenga en cuenta que si elige el modo de pago Efectivo, deberá acercarse a nuestro gabinete a abonar el/los productos solicitados</p><hr>
                <div class="radio">
                <label><input type="radio" name="pago" value="Efectivo">Efectivo</label>
                </div>
                <div class="radio">
                <label><input type="radio" name="pago" value="MP">Mercado Pago</label>
                </div><hr>
               
               <button type="submit" class="btn btn-success btn-block" name="request_producto"><img src="../../icons/actions/tools-wizard.png"  class="img-reponsive img-rounded"> Continuar</button>
                
                </form>
                </div>
                </div>
                                               
                </div>
                </div>
                </div>';



}

/*
** funcion para finalizar pedido de producto
*/
function formEndPedido($cod_prod,$marca,$descripcion,$precio,$cliente,$cel,$direccion,$email,$cantidad,$pago){
        
        if($cantidad == 1){
            $resultado =  $precio;
        }else{
            $resultado = $cantidad * $precio;
        }
        
        $resultado = number_format((float)$resultado, 2, '.', '');
        
        echo '<div class="container">
                <div class="row">
                <div class="col-sm-10">
            
                <div class="panel panel-primary">
                <div class="panel-heading"><img src="../../icons/status/wallet-open.png"  class="img-reponsive img-rounded"> Detalle de la Compra</div>
                <div class="panel-body">
                <div class="alert alert-warning">
                <p align="center"><img src="../../icons/status/security-medium.png"  class="img-reponsive img-rounded"> Verifique bien los datos antes de presionar Terminar </p>
                </div><hr>
                
                                
                <form action="main.php" method="POST">
                
                <p><strong>Código Producto</strong>:</p>
                <div class="form-group">
                <input type="text" class="form-control" name="cod_prod" value="'.$cod_prod.'" readonly>
                </div><hr>
                
                <p><strong>Marca</strong>:</p>
                <div class="form-group">
                <input type="text" class="form-control" name="marca" value="'.$marca.'" readonly>
                </div><hr>
                
                <p><strong>Descripción</strong>:</p>
                <div class="form-group">
                <input type="text" class="form-control" name="descripcion" value="'.$descripcion.'" readonly>
                </div><hr>
                
                <p><strong>Precio Unidad</strong>:</p>
                <div class="form-group">
                <input type="text" class="form-control" name="precio" value="'.$precio.'" readonly>
                </div><hr>                
                
                 <p><strong>Cliente</strong>:</p>
                <div class="form-group">
                <input type="text" class="form-control" name="cliente" value="'.$cliente.'" readonly>
                </div><hr>
                
                <p><strong>Celular</strong>:</p>
                <div class="form-group">
                <input type="text" class="form-control" name="cel" value="'.$cel.'" readonly>
                </div><hr>
                
                <p><strong>Dirección</strong>:</p>
                <div class="form-group">
                <input type="text" class="form-control" name="direccion" value="'.$direccion.'" readonly>
                </div><hr>
                
                <p><strong>Email</strong>:</p>
                <div class="form-group">
                <input type="email" class="form-control" name="email" value="'.$email.'" readonly>
                </div><hr>                
                
                <div class="form-group">
                <label for="cantidad">Cantidad:</label>
                <input type="text" class="form-control" id="cantidad" name="cantidad" value="'.$cantidad.'" readonly required>
                </div><hr>';
                
                if($pago == 'Efectivo'){
                
                echo '<div class="form-group">
                <label for="cantidad">Modo de Pago:</label>
                <input type="text" class="form-control" id="pago" name="pago" value="'.$pago.'" readonly required>
                </div><hr>';
                }
                if($pago == 'MP'){
                
                echo '<h2 align="center"><strong>Mercardo Pago</strong></h2>
                <p align=center><img src="../../../img/sm_bienestar_qr.png"  class="img-reponsive img-rounded"></p><hr>
                <p>Una vez que haya scaneado y pagado, ingrese el Nro. de Operación que lo encontrará en Actividad desde la app de Mercado Pago</p>
                
                <div class="form-group">
                <input type="text" class="form-control" name="pago">
                </div><hr>';
                }
                
                
                echo '<div class="form-group">
                <label for="cantidad">Importe Total:</label>
                <input type="text" class="form-control" name="importe" value="'.$resultado.'" readonly required>
                </div><hr>
                
                <button type="submit" class="btn btn-success btn-block" name="end_producto"><img src="../../icons/actions/games-solve.png"  class="img-reponsive img-rounded"> Terminar</button>
                
                </form>
                </div>
                </div>
                                               
                </div>
                </div>
                </div>';

}

/*
** funcion de cierre de pedido (volcado a base de datos)
*/
function closePedido($cod_prod,$marca,$descripcion,$precio,$cliente,$cel,$direccion,$email,$cantidad,$pago,$importe,$conn){

        $sql = "INSERT INTO smb_pedidos_productos".
            "(f_pedido,cod_producto,marca,descripcion,precio,cliente,movil,direccion,email,cantidad,tipo_pago,importe)".
            "VALUES ".
        "(NOW(),'$cod_prod','$marca','$descripcion','$precio','$cliente','$cel','$direccion','$email','$cantidad','$pago','$importe')";
        mysqli_select_db($conn,'smb_bienestar');
        $resp = mysqli_query($conn,$sql);
        
        
        if($resp){
            echo "<br>";
		    echo '<div class="container">';
		    echo '<div class="alert alert-success" alert-dismissible">
		    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
		    echo '<img class="img-reponsive img-rounded" src="../../icons/actions/dialog-ok-apply.png" /> Pedido Realizado Satisfactoriamente.';
		    echo "</div>";
		    echo "</div>";
    }else{
			    echo "<br>";
			    echo '<div class="container">';
                echo '<div class="alert alert-warning" alert-dismissible">
			    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
			    echo '<img class="img-reponsive img-rounded" src="../../icons/status/task-attempt.png" /> Hubo un problema al Realizar el Pedido. '  .mysqli_error($conn);
			    echo "</div>";
			    echo "</div>";
		    }

}

////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////// SECCION MENSAJES Y ALERTAS ////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////

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
        <img class="img-reponsive img-rounded" src="../../icons/actions/feed-subscribe.png" /> Productos</a></li>
    <li><a data-toggle="tab" href="#menu1">
        <img class="img-reponsive img-rounded" src="../../icons/actions/view-pim-notes.png" /> Mis Pedidos</a></li>
    <li><a data-toggle="tab" href="#menu2">
        <img class="img-reponsive img-rounded" src="../../icons/actions/user-group-properties.png" /> Datos Personales</a></li>
    <li><a data-toggle="tab" href="#menu3">
        <img class="img-reponsive img-rounded" src="../../icons/actions/view-refresh.png" /> Cambiar Password</a></li>
    <li><a data-toggle="tab" href="#menu4">
        <img class="img-reponsive img-rounded" src="../../icons/apps/kcmdf.png" /> Agregar Módulo</a></li>
    
    </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <h2>Productos</h2>
      <p align="justify">Desde aquí usted visualizará los equipos que ya han sido alquilados. Así mismo aquellos turnos ocupados se mostrarán en color rojo sobre la fecha y mostrará la información de cada equipo. Si usted desea realizar la reserva para el alquiler de algún equipo deberá hacer click en el botón <strong>Reservar</strong>, se le presentará un formulario el cual lo guiará a traves del proceso de alquiler. Cada paso está explicado, sólo debe prestar atención a los mensajes. </p>
    </div>
    
    <div id="menu1" class="tab-pane fade">
      <h2>Mis Pedidos</h2>
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
