<?php

/*
** funcion listar equipos
*/
function equipos($conn){

if($conn){
	
	$sql = "SELECT * FROM smb_equipos";
    	mysqli_select_db($conn,'smb_bienestar');
    	$resultado = mysqli_query($conn,$sql);
	//mostramos fila x fila
	$count = 0;
	echo '<div class="panel panel-success" >
	      <div class="panel-heading"><span class="pull-center "><img src="../../icons/devices/printer-laser.png"  class="img-reponsive img-rounded"> Equipos';
	echo '</div><br>';

            echo "<table class='display compact' style='width:100%' id='myTable'>";
              echo "<thead>
		    <th class='text-nowrap text-center'>Cod. Equipo</th>
            <th class='text-nowrap text-center'>Tipo Equipo</th>
            <th class='text-nowrap text-center'>Marca</th>
            <th class='text-nowrap text-center'>Modelo</th>
            <th class='text-nowrap text-center'>Nro de Serie</th>
            <th>&nbsp;</th>
            </thead>";


	while($fila = mysqli_fetch_array($resultado)){
			  // Listado normal
			 echo "<tr>";
			 echo "<td align=center>".$fila['cod_equipo']."</td>";
			 echo "<td align=center>".$fila['tipo']."</td>";
			 echo "<td align=center>".$fila['marca']."</td>";
			 echo "<td align=center>".$fila['modelo']."</td>";
			 echo "<td align=center>".$fila['nro_serie']."</td>";
			 echo "<td class='text-nowrap'>";
			 echo '<form <action="main.php" method="POST">
                    <input type="hidden" name="id" value="'.$fila['id'].'">
                    <button type="submit" class="btn btn-success btn-sm" name="edit_equipo"><img src="../../icons/actions/document-edit.png"  class="img-reponsive img-rounded"> Editar</button>
                    <button type="submit" class="btn btn-danger btn-sm" name="del_equipo"><img src="../../icons/actions/edit-delete.png"  class="img-reponsive img-rounded"> Eliminar</button>
                    </form>';
			 echo "</td>";
			 $count++;
		}

		echo "</table>";
		echo "<br>";
		echo '<form <action="main.php" method="POST">
                    <button type="submit" class="btn btn-default btn-sm" name="add_equipo"><img src="../../icons/actions/list-add.png"  class="img-reponsive img-rounded"> Agregar Equipo</button>
              </form>';
		echo '</div><br>';
		}else{
		  echo 'Connection Failure...';
		}

    mysqli_close($conn);

}



// ==================================================================================== //
// ================================== FORMULARIOS ===================================== //
// carga de formulario de alta de equipos
/*
** funcion para dar el alta a nueva localidad
*/
function formAltaEquipos(){

        echo '<div class="container">
            <div class="row">
            <div class="col-sm-8">
            
            <div class="panel panel-success">
            <div class="panel-heading"><img class="img-reponsive img-rounded" src="../../icons/actions/list-add.png" /> Agregar Equipo</div>
            <div class="panel-body">
            <form action="main.php" method="POST">
            
            <div class="form-group">
                <label for="email">Código Equipo:</label>
                <input type="text" class="form-control" name="cod_equipo" maxlength="3" placeholder="Ingrese Código de Equipo, este debe tener como máximo 3 caracteres numéricos" required>
            </div><hr>
            
             <div class="form-group">
                <label for="sel1">Tipo de Equipo:</label>
                <select class="form-control" id="sel1" name="tipo_equipo" required>
                    <option value="" selected disabled>Seleccionar</option>
                    <option value="Depiladora">Depiladora</option>
                    <option value="Electromagntismo">Electromagnetismo</option>
                    <option value="Radiofrecuencia">Radiofrecuencia</option>
                </select>
                </div><hr>
            
            <div class="form-group">
                <label for="email">Marca del Equipo:</label>
                <input type="text" class="form-control" name="marca_equipo" placeholder="Ingrese la Marca del Equipo" required>
            </div><hr>
            
             <div class="form-group">
                <label for="email">Modelo del Equipo:</label>
                <input type="text" class="form-control" name="modelo_equipo" placeholder="Ingrese el modelo del Equipo" required>
            </div><hr>
            
            <div class="form-group">
                <label for="email">Nro. de Serie del Equipo:</label>
                <input type="text" class="form-control" name="nro_serie" placeholder="Ingrese el número de serie del Equipo" required>
            </div><hr>
            
                 
            <button type="submit" class="btn btn-success btn-block" name="agregarEquipo">Aceptar</button>
            </form>
            </div>
            </div>
            
            </div>
            </div>
            </div>';
}


/*
** formulario de edicion de equipo
*/
function formEditarEquipos($id,$conn){
        
        $sql = "select * from smb_equipos where id = '$id'";
        mysqli_select_db($conn,'smb_bienestar');
        $query = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_array($query)){
            $cod_equipo = $row['cod_equipo'];
            $tipo_equipo = $row['tipo'];
            $marca_equipo = $row['marca'];
            $modelo_equipo = $row['modelo'];
            $nro_serie = $row['nro_serie'];        
        }
        
        
        echo '<div class="container">
            <div class="row">
            <div class="col-sm-8">
            
            <div class="panel panel-success">
            <div class="panel-heading"><img class="img-reponsive img-rounded" src="../../icons/actions/list-add.png" /> Agregar Equipo</div>
            <div class="panel-body">
            <form action="#" method="POST">
            <input type="hidden" class="form-control" name="id" value="'.$id.'">
            
            <div class="form-group">
                <label for="email">Código Equipo:</label>
                <input type="text" class="form-control" name="cod_equipo" value="'.$cod_equipo.'" required readonly>
            </div><hr>
            
            <div class="form-group">
                <label for="email">Tipo Equipo:</label>
                <input type="text" class="form-control" name="tipo_equipo" value="'.$tipo_equipo.'" required readonly>
            </div><hr>
            
            <div class="form-group">
                <label for="email">Marca del Equipo:</label>
                <input type="text" class="form-control" name="marca_equipo" value="'.$marca_equipo.'" required>
            </div><hr>
            
             <div class="form-group">
                <label for="email">Modelo del Equipo:</label>
                <input type="text" class="form-control" name="modelo_equipo" value="'.$modelo_equipo.'" required>
            </div><hr>
            
            <div class="form-group">
                <label for="email">Nro. de Serie del Equipo:</label>
                <input type="text" class="form-control" name="nro_serie" value="'.$nro_serie.'" required>
            </div><hr>
            
                 
            <button type="submit" class="btn btn-success btn-block" name="updateEquipo">Actualizar</button>
            </form>
            </div>
            </div>
            
            </div>
            </div>
            </div>';
}


/*
** funcion para eliminar un registro de equipo
*/
function eliminarEquipo($id,$conn){

        $sql = "select * from smb_equipos where id = '$id'";
        mysqli_select_db($conn,'smb_bienestar');
        $query = mysqli_query($conn,$sql);
        while($fila = mysqli_fetch_array($query)){
                $modelo = $fila['modelo'];
            }
            
            echo '<div class="container">
            <div class="row">
            <div class="col-sm-8">
            
            <div class="panel panel-danger">
            <div class="panel-heading"><img class="img-reponsive img-rounded" src="../../icons/status/security-low.png" /> Equipos - Eliminar Registro</div>
            <div class="panel-body">
            <form action="main.php" method="POST">
            <input type="hidden" class="form-control" name="id" value="'.$id.'">
            
                <div class="alert alert-danger">
                <img class="img-reponsive img-rounded" src="../../icons/status/task-attempt.png" /> <strong>Atención!</strong><hr>
                <p>Está por eliminar el registro del Equipo: <strong>'.$modelo.'</strong></p>
                <p>Si está seguro, presione Aceptar, de lo contrario presione Cancelar.</p>
                </div><hr>
            
            <button type="submit" class="btn btn-success btn-block" name="delete_equipo">Aceptar</button><br>
            </form>
            <a href="main.php"><button type="button" class="btn btn-danger btn-block">Cancelar</button></a>
            </div>
            </div>
            
            </div>
            </div>
            </div>';
}




// ==================================================================================== //
// ================================== PERSISTENCIA ===================================== //
// 
/*
** funcion que agrega equipo a la base de datos
*/
function addNuevoEquipo($cod_equipo,$tipo_equipo,$marca_equipo,$modelo_equipo,$nro_serie,$conn){

    if(is_numeric($cod_equipo)){
    
    if($tipo_equipo == 'Depiladora'){
                
                $prefijo = 'DEP';
                $cod_equipo = $prefijo.$cod_equipo;
           }
           if($tipo_equipo == 'Radiofrecuencia'){
                
                $prefijo = 'RAD';
                $cod_equipo = $prefijo.$cod_equipo;
           }
           if($tipo_equipo == 'Electromagnetismo'){
                
                $prefijo = 'ELE';
                $cod_equipo = $prefijo.$cod_equipo;
           }
    
    $sql = "select cod_equipo, modelo from smb_equipos where cod_equipo = '$cod_equipo' OR modelo = '$modelo_equipo'";
    mysqli_select_db($conn,'smb_bienestar');
    $query = mysqli_query($conn,$sql);
    $rows = mysqli_num_rows($query);
    
             
                      
    if($rows == 0){
            
            $consulta = "INSERT INTO smb_equipos ".
            "(cod_equipo,tipo,marca,modelo,nro_serie)".
            "VALUES ".
        "('$cod_equipo','$tipo_equipo','$marca_equipo','$modelo_equipo','$nro_serie')";
        mysqli_select_db($conn,'smb_bienestar');
        $resp = mysqli_query($conn,$consulta);
            
            if($resp){
            echo "<br>";
		    echo '<div class="container">';
		    echo '<div class="alert alert-success" alert-dismissible">
		    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
		    echo '<img class="img-reponsive img-rounded" src="../../icons/actions/dialog-ok-apply.png" /> Equipo Agregado Satisfactoriamente.';
		    echo "</div>";
		    echo "</div>";
    }else{
			    echo "<br>";
			    echo '<div class="container">';
			     echo '<div class="alert alert-warning" alert-dismissible">
			    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
			    echo '<img class="img-reponsive img-rounded" src="../../icons/status/task-attempt.png" /> Hubo un problema al intentar Agregar el Equipo. '  .mysqli_error($conn);
			    echo "</div>";
			    echo "</div>";
		    }
		    }else{
		    
                echo "<br>";
			    echo '<div class="container">';
			     echo '<div class="alert alert-warning" alert-dismissible">
			    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
			    echo '<img class="img-reponsive img-rounded" src="../../icons/status/task-attempt.png" /> Ya existe registro de ese Equipo.';
			    echo "</div>";
			    echo "</div>";
			    exit;
		    
		    }
		    }else{
		    
                echo "<br>";
			    echo '<div class="container">';
			     echo '<div class="alert alert-warning" alert-dismissible">
			    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
			    echo '<img class="img-reponsive img-rounded" src="../../icons/status/task-attempt.png" /> El Código del Equipo debe ser Numérico.';
			    echo "</div>";
			    echo "</div>";
			    exit;
            }

}




/*
** funcion que elimina registro de localidades
*/
function deleteEquipo($id,$conn){

    $sql = "delete from smb_equipos where id = '$id'";
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


/*
** funcion actualizar localidad en base de datos
*/
function updateEquipo($id,$cod_equipo,$tipo_equipo,$marca_equipo,$modelo_equipo,$nro_serie,$conn){

               
        $sql = "update smb_equipos set cod_equipo = '$cod_equipo', tipo = '$tipo_equipo', marca = '$marca_equipo', modelo = '$modelo_equipo', nro_serie = '$nro_serie' where id = '$id'";
        mysqli_select_db($conn,'smb_bienestar');
        $query = mysqli_query($conn,$sql);
        
        if($query){
            echo "<br>";
		    echo '<div class="container">';
		    echo '<div class="alert alert-success" alert-dismissible">
		    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
		    echo '<img class="img-reponsive img-rounded" src="../../icons/actions/dialog-ok-apply.png" /> Equipo Actualizado Satisfactoriamente.';
		    echo "</div>";
		    echo "</div>";
        }else{
                    echo "<br>";
                    echo '<div class="container">';
                    echo '<div class="alert alert-warning" alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                    echo '<img class="img-reponsive img-rounded" src="../../icons/status/task-attempt.png" /> Hubo un problema al Actualizar el Equipo. '  .mysqli_error($conn);
                    echo "</div>";
                    echo "</div>";
                }


}

?>
