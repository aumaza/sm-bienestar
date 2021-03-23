<!DOCTYPE html>
<html lang="es">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SM Bien Estar - Venta de Productos</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/small-business.css" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="../registro/reset_password.php"><img class="img-reponsive img-rounded" src="../icons/status/task-attempt.png" /> Olvidé mi Password</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="../../#"><img class="img-reponsive img-rounded" src="../icons/actions/go-home.png" /> Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../registro/sign_up.php?entorno=VP"><img class="img-reponsive img-rounded" src="../icons/status/task-complete.png" /> Registrate</a>
          </li>
          </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container">

    <!-- Heading Row -->
    <div class="row align-items-center my-5">
      <div class="col-lg-7">
        <img class="img-fluid rounded mb-4 mb-lg-0" src="../../img/img-11.png" width="900" height="400" alt="">
      </div>
      <!-- /.col-lg-8 -->
      <div class="col-lg-5">
        <h1 class="font-weight-light"><h1><img class="img-reponsive img-rounded" src="../../img/logo.png" /></h1><hr></h1>
        <p>Ingresando a nuestro catálogo de productos de belleza, podrás comprar con un par de clicks.</p><hr>
       <!-- Trigger the modal with a button -->
        <button type="button" class="btn btn-primary btn-xl rounded-pill mt-5" data-toggle="modal" data-target="#myModal">Ingresar</button>
      </div>
      <!-- /.col-md-4 -->
    </div>
    <!-- /.row -->

    <!-- Call to Action Well -->
    <div class="card text-white bg-secondary my-5 py-4 text-center">
      <div class="card-body">
        <p class="text-white m-0">Los productos que se ven a continuación podrá adquirirlos ingresando. Si aún no se registró, diríjase al botón "Registrate" y comience.</p>
      </div>
    </div>

    <!-- Content Row -->
    <div class="row">
      <div class="col-md-4 mb-5">
        <div class="card h-100">
          <div class="card-body">
            <h2 class="card-title">Card One</h2>
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem magni quas ex numquam, maxime minus quam molestias corporis quod, ea minima accusamus.</p>
          </div>
          <div class="card-footer">
            <a href="#" class="btn btn-primary btn-sm">More Info</a>
          </div>
        </div>
      </div>
      <!-- /.col-md-4 -->
      <div class="col-md-4 mb-5">
        <div class="card h-100">
          <div class="card-body">
            <h2 class="card-title">Card Two</h2>
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod tenetur ex natus at dolorem enim! Nesciunt pariatur voluptatem sunt quam eaque, vel, non in id dolore voluptates quos eligendi labore.</p>
          </div>
          <div class="card-footer">
            <a href="#" class="btn btn-primary btn-sm">More Info</a>
          </div>
        </div>
      </div>
      <!-- /.col-md-4 -->
      <div class="col-md-4 mb-5">
        <div class="card h-100">
          <div class="card-body">
            <h2 class="card-title">Card Three</h2>
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem magni quas ex numquam, maxime minus quam molestias corporis quod, ea minima accusamus.</p>
          </div>
          <div class="card-footer">
            <a href="#" class="btn btn-primary btn-sm">More Info</a>
          </div>
        </div>
      </div>
      <!-- /.col-md-4 -->

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-left text-white small"><strong>Desarrollo:</strong> Slackzone Development</p><img src="../../img/devel-slack-logo2-64x64.png"  class="img-reponsive img-rounded">
      <p class="m-0 text-left text-white small">Contacto: <a href="mailto:develslack@gmail.com">develslack@gmail.com</a></p>
    </div>
    </div>
    <!-- /.container -->
  </footer>
  
  <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title">Ingrese sus Datos</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
    <!-- form  -->
    <form action="../form_login.php" method="POST">
    <input type="hidden" id="entorno" name="entorno" value="VP">
    <div class="form-group">
      <label for="usr">Usuario:</label>
      <input type="text" name="usuario" class="form-control" id="usr" placeholder="Tipee aquí el mail con el que se registró" required>
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" name="password" class="form-control" id="pwd" required>
    </div>
    
    <!-- checkbox que nos permite activar o desactivar la opcion -->
                <div style="margin-top:15px;">
                    <input style="margin-left:20px;" type="checkbox" id="mostrar_contrasena" title="Clic para mostrar contraseña"/>
                        &nbsp;&nbsp;Mostrar Contraseña</div>
                </div>
    
    <div class="modal-footer">
        <button type="submit" class="btn btn-success" >Aceptar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
  </form>
</div>
     <!-- end form -->
     
      </div>
    </div>

  </div>
</div>
<!-- end Modal -->

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  
  <script>
$(document).ready(function () {
  $('#mostrar_contrasena').click(function () {
    if ($('#mostrar_contrasena').is(':checked')) {
      $('#pwd').attr('type', 'text');
    } else {
      $('#pwd').attr('type', 'password');
    }
  });
});
</script>

</body>

</html>
