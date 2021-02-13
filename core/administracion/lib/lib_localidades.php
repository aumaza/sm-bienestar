<?php

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