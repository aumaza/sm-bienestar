<?php

/*
** funcion listar productos
*/
function list_productos($conn){

if($conn){
	
	$sql = "SELECT * FROM smb_productos";
    	mysqli_select_db($conn,'smb_bienestar');
    	$resultado = mysqli_query($conn,$sql);
	//mostramos fila x fila
	$count = 0;
	echo '<div class="panel panel-success" >
		<div class="panel-heading"><span class="pull-center ">
		  <img src="../../icons/actions/feed-subscribe.png"  class="img-reponsive img-rounded"> Productos de Cosmética';
	echo '</div><br>
	      <p><strong>Nota:</strong> Aquí se encuentran todos los turnos disponibles, aquellos que aparecen en color Rojo sobre la fecha, significa que ya fueron tomados, si desea tomar un turno, presione el botón <strong>Reservar</strong> y podrá tramitar dicho turno</p><hr>';

      echo "<table class='display compact' style='width:100%' id='myTable'>";
      echo "<thead>
		    <th class='text-nowrap text-center'>ID</th>
		    <th class='text-nowrap text-center'>Imagen</th>
		    <th class='text-nowrap text-center'>Código Producto</th>
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
				  <button type="submit" class="btn btn-primary btn-sm" name="edit_producto">
				    <img src="../../icons/actions/document-edit.png"  class="img-reponsive img-rounded"> Editar</button>
				  <button type="submit" class="btn btn-danger btn-sm" name="eliminar_producto">
				    <img src="../../icons/actions/trash-empty.png"  class="img-reponsive img-rounded"> Borrar</button>
				  <button type="submit" class="btn btn-success btn-sm" name="add_picture">
				    <img src="../../icons/actions/fileview-preview.png"  class="img-reponsive img-rounded"> Imagen</button>
				  <button type="submit" class="btn btn-warning btn-sm" name="sail_producto">
				    <img src="../../icons/actions/help-donate.png"  class="img-reponsive img-rounded"> Venta</button>
                  </form>';
			 echo "</td>";
			 $count++;
		}

		echo "</table>";
		echo '<button type="button" class="btn btn-warning btn-sm" >Cantidad de Registros: '.$count.'</button>';
		echo "<hr>";
		echo '<form <action="main.php" method="POST">
			<button type="submit" class="btn btn-default btn-sm" name="add_prod">
			  <img src="../../icons/actions/list-add.png"  class="img-reponsive img-rounded"> Agregar Producto</button>
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
function formAddProducto(){

         
       echo '<div class="container">
	      <div class="row">
		<div class="col-sm-8">
            
            <div class="panel panel-success">
	      <div class="panel-heading">
		<img class="img-reponsive img-rounded" src="../../icons/actions/list-add.png" /> Agregar Producto</div>
		  <div class="panel-body">
	
	    <form action="main.php" method="POST">
            
            <div class="form-group">
              <label for="email">Código Producto:</label>
		<input type="text" class="form-control" name="cod_prod" maxlenght="6" placeholder="Ingrese el Código Identificatorio que le dará a dicho producto " required>
            </div><hr>
            
            <div class="form-group">
	      <label for="email">Descripción:</label>
		<input type="text" class="form-control" name="descripcion" placeholder="Ingrese descripcion del producto" required>
            </div><hr>
            
            <div class="form-group">
	      <label for="email">Marca:</label>
		<input type="text" class="form-control" name="marca" placeholder="Ingrese la Marca del producto" required>
            </div><hr>
            
            <div class="form-group">
	      <label for="email">Precio:</label>
		<input type="text" class="form-control" name="precio" placeholder="Ingrese el monto utilizando un punto para separar los decimales" required>
            </div><hr>
            
                 
            <button type="submit" class="btn btn-success btn-block" name="addProd">Aceptar</button>
            </form>
            </div>
            </div>
            
            </div>
            </div>
            </div>';
}

/*
** funcion que agrega Producto
*/
function addProducto($cod_prod,$descripcion,$marca,$precio,$conn){

    $sql = "select cod_producto, descripcion from smb_productos where cod_producto = '$cod_prod' or descripcion = '$descripcion'";
    mysqli_select_db($conn,'smb_bienestar');
    $query = mysqli_query($conn,$sql);
    $rows = mysqli_num_rows($query);
          
    if($rows == 0){
            
            $consulta = "INSERT INTO smb_productos".
            "(cod_producto,descripcion,marca,precio)".
            "VALUES ".
        "('$cod_prod','$descripcion','$marca','$precio')";
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
			    echo '<img class="img-reponsive img-rounded" src="../../icons/status/task-attempt.png" /> Ya existe registro de ese Producto. Verifique el Código de Producto o la Descripción del mismo. No puede haber dos productos con la misma Descripción o Código';
			    echo "</div>";
			    echo "</div>";
			    exit;
		    
		    }

}


/*
** funcion editar localidad
*/
function formEditProducto($id,$conn){

  $sql = "select * from smb_productos where id = '$id'";
  mysqli_select_db($conn,'smb_bienestar');
  $query = mysqli_query($conn,$sql);
  while($fila = mysqli_fetch_array($query)){
        $cod_prod = $fila['cod_producto'];
        $descripcion = $fila['descripcion'];
        $marca = $fila['marca'];
        $precio = $fila['precio'];
       }
       
       echo '<div class="container">
	      <div class="row">
		<div class="col-sm-8">
            
            <div class="panel panel-success">
	      <div class="panel-heading">
		<img class="img-reponsive img-rounded" src="../../icons/actions/feed-subscribe.png" /> Editar Producto</div>
            <div class="panel-body">
            
            <form action="main.php" method="POST">
	      <input type="hidden" class="form-control" name="id" value="'.$id.'">
            
            <div class="form-group">
                <label for="email">Código Producto:</label>
                <input type="text" class="form-control" name="cod_prod" value="'.$cod_prod.'" readonly>
            </div><hr>
            
            <div class="form-group">
                <label for="email">Descripción:</label>
                <input type="text" class="form-control" name="descripcion" value="'.$descripcion.'">
            </div><hr>
            
            <div class="form-group">
                <label for="email">Marca:</label>
                <input type="text" class="form-control" name="marca" value="'.$marca.'">
            </div><hr>
            
            <div class="form-group">
                <label for="email">Precio:</label>
                <input type="text" class="form-control" name="precio" value="'.$precio.'">
            </div><hr>
            
                 
            <button type="submit" class="btn btn-success btn-block" name="updateProd">Aceptar</button>
            </form>
            </div>
            </div>
            
            </div>
            </div>
            </div>';
}

/*
** funcion actualizar registro de productos
*/
function updateProducto($id,$descripcion,$marca,$precio,$conn){

        $sql = "update smb_productos set descripcion = '$descripcion', marca = '$marca', precio = '$precio' where id = '$id'";
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
** funcion para eliminar un registro de productos
*/
function formEliminarProducto($id,$conn){

        $sql = "select * from smb_productos where id = '$id'";
        mysqli_select_db($conn,'smb_bienestar');
        $query = mysqli_query($conn,$sql);
        while($fila = mysqli_fetch_array($query)){
                $producto = $fila['descripcion'];
            }
            
            echo '<div class="container">
		    <div class="row">
		      <div class="col-sm-8">
            
            <div class="panel panel-danger">
	      <div class="panel-heading">
		<img class="img-reponsive img-rounded" src="../../icons/status/security-low.png" /> Productos - Eliminar Registro</div>
            <div class="panel-body">
            
            <form action="main.php" method="POST">
	      <input type="hidden" class="form-control" name="id" value="'.$id.'">
            
                <div class="alert alert-danger">
		  <img class="img-reponsive img-rounded" src="../../icons/status/task-attempt.png" /> <strong>Atención!</strong><hr>
		    <p>Está por eliminar el registro: <strong>'.$producto.'</strong></p>
		    <p>Si está seguro, presione Aceptar, de lo contrario presione Cancelar.</p>
                </div><hr>
            
            <button type="submit" class="btn btn-success btn-block" name="delete_prod">Aceptar</button><br>
            
            </form>
	      <a href="main.php"><button type="button" class="btn btn-danger btn-block">Cancelar</button></a>
            </div>
            </div>
            
            </div>
            </div>
            </div>';
}

/*
** funcion que elimina registro de productos
*/
function deleteProducto($id,$conn){

    $sql = "delete from smb_productos where id = '$id'";
    mysqli_select_db($conn,'smb_bienestar');
    $query = mysqli_query($conn,$sql);
    
    if($query){
		    echo "<br>";
		    echo '<div class="container">';
		    echo '<div class="alert alert-success" alert-dismissible">
			    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
		    echo '<img class="img-reponsive img-rounded" src="../../icons/actions/dialog-ok-apply.png" /> Registro Eliminado Satisfactoriamente.';
		    echo "</div>";
		    echo "</div>";
    }else{
			    echo "<br>";
			    echo '<div class="container">';
			    echo '<div class="alert alert-warning" alert-dismissible">
				    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
			    echo '<img class="img-reponsive img-rounded" src="../../icons/status/task-attempt.png" /> Hubo un problema al Eliminar el Registro.'  .mysqli_error($conn);
			    echo "</div>";
			    echo "</div>";
		    }

}

/*
* Funcion para cambiar avatar de usuario
*/
function uploadPicture($id){

    echo '<div class="panel panel-success" >
	      <div class="panel-heading"><span class="pull-center ">
		<img src="../../icons/actions/fileview-preview.png"  class="img-reponsive img-rounded"> Archivo de Imágen';
    echo '</div><br>';
	                         
	echo '<div class="container">
		<div class="row">
		  <div class="col-sm-8">
            
            <div class="panel panel-default">
	      <div class="panel-heading">
                <strong>Seleccione el Archivo a Subir:</strong><br>
            
            <form action="main.php" method="POST" enctype="multipart/form-data">
	      <input type="hidden" name="id" value="'.$id.'">
                
              <input type="file" name="file"><br>
		<button type="submit" name="upload_pic"><span class="glyphicon glyphicon-cloud-upload"></span> Subir</button>
            </form>
            <hr>
            <a href="main.php"><button type="button" class="btn btn-danger btn-block"><img src="../../icons/actions/dialog-cancel.png"  class="img-reponsive img-rounded"> Cancelar</button></a>
	      </div>
            </div>
	      </div>  
	    </div>
	  </div>';
}

/*
** funcion que guarda en directorio y actualiza la base de datos con imagen de producto
*/

function uploadFilePicture($id,$file,$conn){

// File upload path
$targetDir = '../../products_pictures/';
$fileName = $file;
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
//$destinationPath = '../../avatar/';

if(!empty($_FILES["file"]["name"])){
    // Allow certain file formats
    $allowTypes = array('jpg','png','jpeg','gif');
    
    if(in_array($fileType, $allowTypes)){
    
        // Upload file to server
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
           
            
            // Insert image file name into database
           
           $sqlInsert = "UPDATE smb_productos set picture = '$targetFilePath' where id = '$id'";
			   mysqli_select_db($conn,'smb_bienestar');
			  $insert = mysqli_query($conn,$sqlInsert);
           
           
            if($insert){
            
			  echo '<div class="alert alert-success" role="alert">';
			  echo '<h1 class="panel-title text-left" contenteditable="true"><img class="img-reponsive img-rounded" src="../../icons/actions/dialog-ok-apply.png" /><strong> Base de Datos Actualizada. El Archivo '.$fileName. ' se ha subido correctamente..</strong>';
                          echo "</div><hr>";
                          //copy($fileName, "$destinationPath/$fileName");
                          //unlink($fileName);
                          //echo '<meta http-equiv="refresh" content="5;URL=../main/main.php "/>';
                          
                                           
            }else{
		  
			  echo '<div class="alert alert-success" role="alert">';
			  echo '<h1 class="panel-title text-left" contenteditable="true"><img class="img-reponsive img-rounded" src="../../icons/actions/dialog-ok-apply.png" /><strong> El Archivo '.$fileName. ' se ha subido correctamente.</strong>';
                          echo "</div><hr>";
                          //echo '<meta http-equiv="refresh" content="5;URL=../main/main.php "/>';
                         
                
            } 
        }else{
			  echo '<div class="alert alert-warning" role="alert">';
			  echo '<h1 class="panel-title text-left" contenteditable="true"><img class="img-reponsive img-rounded" src="../../icons/actions/dialog-cancel.png" /><strong> Ups. Hubo un error subiendo el Archivo.</strong>';
                          echo "</div><hr>";
                          //echo '<meta http-equiv="refresh" content="5;URL=../main/main.php "/>';
                          
        }
    }else{
			  echo '<div class="alert alert-danger" role="alert">';
			  echo '<h1 class="panel-title text-left" contenteditable="true"><img class="img-reponsive img-rounded" src="../../icons/actions/dialog-cancel.png" /><strong> Ups, solo archivos con extensión: JPG, PNG, BMP, GIF son soportados.</strong>';
			  echo "</div><hr>";
                          //cho '<meta http-equiv="refresh" content="5;URL=../main/main.php "/>';
                        
    }
}else{
			  echo '<div class="alert alert-info" role="alert">';
                          echo '<h1 class="panel-title text-left" contenteditable="true"><img class="img-reponsive img-rounded" src="../../icons/actions/system-reboot.png" /><strong> Por favor, seleccione al archivo a subir.</strong>';
                          echo "</div><hr>";
                         // echo '<meta http-equiv="refresh" content="5;URL=../main/main.php "/>';
                          
}
}

/*
** funcion productos pedidos
*/
function pedidos($conn){

if($conn)
{
	$sql = "SELECT * FROM smb_pedidos_productos";
    	mysqli_select_db($conn,'smb_bienestar');
    	$resultado = mysqli_query($conn,$sql);
	//mostramos fila x fila
	$count = 0;
	
	echo '<div class="panel panel-default" >
		<div class="panel-heading">
		  <span class="pull-center "><img src="../../icons/actions/view-pim-notes.png"  class="img-reponsive img-rounded"> Pedidos';
	echo '</div><br>';

            echo "<table class='display compact' style='width:100%' id='myTable'>";
            echo "<thead>
		    <th class='text-nowrap text-center'>ID</th>
		    <th class='text-nowrap text-center'>Estado</th>
		    <th class='text-nowrap text-center'>Fecha Pedido</th>
		    <th class='text-nowrap text-center'>Cliente</th>
		    <th class='text-nowrap text-center'>Móvil</th>
		    <th class='text-nowrap text-center'>Dirección</th>
		    <th class='text-nowrap text-center'>Email</th>
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
			 echo "<td align=center>".$fila['cliente']."</td>";
			 echo "<td align=center>".$fila['movil']."</td>";
			 echo "<td align=center>".$fila['direccion']."</td>";
			 echo "<td align=center>".$fila['email']."</td>";
			 echo "<td align=center>".$fila['cod_producto']."</td>";
			 echo "<td align=center>".$fila['descripcion']."</td>";
			 echo "<td align=center>".$fila['marca']."</td>";
			 echo "<td align=center>".$fila['precio']."</td>";
			 echo "<td align=center>".$fila['cantidad']."</td>";
			 echo "<td align=center>".$fila['tipo_pago']."</td>";
			 echo "<td align=center>".$fila['importe']."</td>";
			 echo "<td class='text-nowrap'>";
			 if($fila['estado'] == '' || $fila['estado'] == 'Debe'){
			 echo '<form <action="main.php" method="POST">
                    <input type="hidden" name="id" value="'.$fila['id'].'">
                    <button type="submit" class="btn btn-default btn-sm" name="mod_estado">
                        <img src="../../icons/actions/edit-redo.png"  class="img-reponsive img-rounded"> Cambiar Estado</button>
				  </form>';
            }
			 echo "</td>";
			 $count++;
		}

		echo "</table>";
		echo "<br>";
		echo '<button type="button" class="btn btn-primary">Cantidad de Pedidos:  ' .$count; echo '</button>';
		echo '</div><br>';
		}else{
		  echo 'Connection Failure...';
		}

    mysqli_close($conn);
}

/*
** funcion para cambiar estado de debe a pagó
*/
function cambiarEstado($id,$conn){
    
    echo '<form action="main.php" method="POST">
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
                    <button type="submit" class="btn btn-success btn-block" name="update_estado_prod">
                        <img src="../../icons/actions/edit-redo.png"  class="img-reponsive img-rounded"> Cambiar</button>
            </form>';

}

/*
** persistencia del cambio de estado
*/
function actualizarState($id,$estado,$conn){

    $sql = "update smb_pedidos_productos set estado = '$estado' where id = '$id'";
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
** funcion que solicita el cliente para venta de productos en gabinete
*/
function formPedido($id,$conn){
    
    echo '<form action="main.php" method="POST">
            <input type="hidden" class="form-control" id="id" name="id" value="'.$id.'">
            <div class="form-group">
                <div class="form-group">
                    <label for="sel1">Seleccione Cliente</label>
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
                    <button type="submit" class="btn btn-success btn-block" name="venta">Aceptar</button>
            </form>';

}

/*
** funcion para realizar pedido de producto
*/
function newPedidoProducto($id,$nombre,$conn){
    
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
function endPedido($cod_prod,$marca,$descripcion,$precio,$cliente,$cel,$direccion,$email,$cantidad,$pago){
        
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
                
                 <div class="form-group">
                    <label for="sel1">Estado:</label>
                    <select class="form-control" name="estado">
                        <option value="" disabled selected>Seleccionar</option>
                        <option value="Pago">Pagó</option>
                        <option value="Debe">Debe</option>
                    </select>
                    </div> 
                
                <button type="submit" class="btn btn-success btn-block" name="end_pedido"><img src="../../icons/actions/games-solve.png"  class="img-reponsive img-rounded"> Terminar</button>
                
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
function cerrarPedido($cod_prod,$marca,$descripcion,$precio,$cliente,$cel,$direccion,$email,$cantidad,$pago,$importe,$estado,$conn){

        $sql = "INSERT INTO smb_pedidos_productos".
            "(f_pedido,cod_producto,marca,descripcion,precio,cliente,movil,direccion,email,cantidad,tipo_pago,importe,estado)".
            "VALUES ".
        "(NOW(),'$cod_prod','$marca','$descripcion','$precio','$cliente','$cel','$direccion','$email','$cantidad','$pago','$importe','$estado')";
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


/*
** funcion para análisis de montos cobrados en productos por intervalos de tiempo
*/
function filtrosProductos(){
  
   echo '<div class="alert alert-info" align="center">
	  <h3>Venta de Productos</h3>
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

?>
