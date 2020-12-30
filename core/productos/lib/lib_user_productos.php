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
			 echo "<td align=center><img src='$fila[picture]' alt='Avatar' class='avatar' ></td>";
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
			  echo "<td align=center>".$fila['f_pedido']."</td>";
			 echo "<td align=center>".$fila['cod_producto']."</td>";
			 echo "<td align=center>".$fila['descripcion']."</td>";
			 echo "<td align=center>".$fila['marca']."</td>";
			 echo "<td align=center>".$fila['precio']."</td>";
			 echo "<td align=center>".$fila['cantidad']."</td>";
			 echo "<td align=center>".$fila['tipo_pago']."</td>";
			 echo "<td align=center>".$fila['importe']."</td>";
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




?>
