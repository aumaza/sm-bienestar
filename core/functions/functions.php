<?php

/*
** Funcion que carga el skeleto del sistema
*/

function skeleton(){

  echo '<link rel="stylesheet" href="/sm-bienestar/skeleton/css/bootstrap.min.css" >
	<link rel="stylesheet" href="/sm-bienestar/skeleton/css/bootstrap-theme.css" >
	<link rel="stylesheet" href="/sm-bienestar/skeleton/css/bootstrap-theme.min.css" >
	<link rel="stylesheet" href="/sm-bienestar/skeleton/css/scrolling-nav.css" >
	<link rel="stylesheet" href="/sm-bienestar/skeleton/css/fontawesome.css">
	<link rel="stylesheet" href="/sm-bienestar/skeleton/css/fontawesome.min.css" >
	<link rel="stylesheet" href="/sm-bienestar/skeleton/css/jquery.dataTables.min.css" >
	<link rel="stylesheet" href="/sm-bienestar/skeleton/Chart.js/Chart.min.css" >
	<link rel="stylesheet" href="/sm-bienestar/skeleton/Chart.js/Chart.css" >
	
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="/sm-bienestar/skeleton/js/jquery-3.4.1.min.js"></script>
	<script src="/sm-bienestar/skeleton/js/bootstrap.min.js"></script>
	
	<script src="/sm-bienestar/skeleton/js/jquery.dataTables.min.js"></script>
	<script src="/sm-bienestar/skeleton/js/dataTables.editor.min.js"></script>
	<script src="/sm-bienestar/skeleton/js/dataTables.select.min.js"></script>
	<script src="/sm-bienestar/skeleton/js/dataTables.buttons.min.js"></script>
	
	<script src="/sm-bienestar/js/scrolling-nav.js"></script>
	<script src="/sm-bienestar/skeleton/Chart.js/Chart.min.js"></script>
	<script src="/sm-bienestar/skeleton/Chart.js/Chart.bundle.min.js"></script>
	<script src="/sm-bienestar/skeleton/Chart.js/Chart.bundle.js"></script>
	<script src="/sm-bienestar/skeleton/Chart.js/Chart.js"></script>';
}



/////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////// SECCION ADMINISTRACION DE USUARIOS ////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////

/*
** funcion para agregar usuarios
*/
function addUser($nombre,$password1,$email,$role,$entorno,$conn){

mysqli_select_db('smb_bienestar');	

	$sql = "INSERT INTO smb_usuarios ".
		"(nombre,user,email,password,role,entorno)".
		"VALUES ".
      "('$nombre','$email','$email','$password1','$role','$entorno')";
      $resp = mysqli_query($conn,$sql);
		
	 if($resp){
            echo "<br>";
		    echo '<div class="container">';
		    echo '<div class="alert alert-success" role="alert">';
		    echo '<img class="img-reponsive img-rounded" src="../icons/actions/dialog-ok-apply.png" /> Usuario Creado Satisfactoriamente.';
		    echo "</div>";
		    echo "</div>";
		    
		    switch($entorno){
		    
		    case "VP":  echo   '<br>
                                <div class="container">
                                <div class="alert alert-success" role="alert">
                                <a href="../productos/"><button type="button" class="btn btn-success">Ingresar</button></a>
                                </div></div>'; break;
		    
		    case "TG":  echo   '<br>
                                <div class="container">
                                <div class="alert alert-success" role="alert">
                                <a href="../gabinete/"><button type="button" class="btn btn-success">Ingresar</button></a>
                                </div></div>'; break;
		    
		    case "TE":  echo   '<br>
                                <div class="container">
                                <div class="alert alert-success" role="alert">
                                <a href="../equipos/"><button type="button" class="btn btn-success">Ingresar</button></a>
                                </div></div>'; break;
		    case "VE":  echo   '<br>
                                <div class="container">
                                <div class="alert alert-success" role="alert">
                                <a href="../venta_equipos/"><button type="button" class="btn btn-success">Ingresar</button></a>
                                </div></div>'; break;
		    
		    case "CA":  echo   '<br>
                                <div class="container">
                                <div class="alert alert-success" role="alert">
                                <a href="../capacitacion/"><button type="button" class="btn btn-success">Ingresar</button></a>
                                </div></div>'; break;
		      
		    }
		    
    }else{
			    echo "<br>";
			    echo '<div class="container">';
			    echo '<div class="alert alert-warning" role="alert">';
			    echo '<img class="img-reponsive img-rounded" src="../icons/status/task-attempt.png" /> Hubo un problema al intentar crear el Usuario.'  .mysqli_error($conn);
			    echo "</div>";
			    echo "</div>";
		    }

}

/*
** funcion para agregar clientes
*/
function addCliente($nombre,$dni,$direccion,$tel,$movil,$email,$conn){

    mysqli_select_db('smb_bienestar');	

	$sql = "INSERT INTO smb_clientes ".
		"(nombre,dni,direccion,tel,movil,email)".
		"VALUES ".
      "('$nombre','$dni','$direccion','$tel','$movil','$email')";
    
    $resp = mysqli_query($conn,$sql);
    
    if($resp){
            echo "<br>";
		    echo '<div class="container">';
		    echo '<div class="alert alert-success" role="alert">';
		    echo '<img class="img-reponsive img-rounded" src="../icons/actions/dialog-ok-apply.png" /> Cliente Creado Satisfactoriamente.';
		    echo "</div>";
		    echo "</div>";
    }else{
			    echo "<br>";
			    echo '<div class="container">';
			    echo '<div class="alert alert-warning" role="alert">';
			    echo '<img class="img-reponsive img-rounded" src="../icons/status/task-attempt.png" /> Hubo un problema al intentar crear el Cliente.'  .mysqli_error($conn);
			    echo "</div>";
			    echo "</div>";
		    }
    
}














?>
