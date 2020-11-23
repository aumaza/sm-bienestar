<!DOCTYPE html>
<html lang="es">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SM Bienestar - Turnos Gabinete</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/one-page-wonder.min.css" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
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
            <a class="nav-link" href="../registro/sign_up.php?entorno=TG"><img class="img-reponsive img-rounded" src="../icons/status/task-complete.png" /> Registrate</a>
          </li>
          </ul>
      </div>
    </div>
  </nav>

  <header class="masthead text-center text-white">
    <div class="masthead-content">
      <div class="container">
        <h1 class="masthead-heading mb-0">SM - Bien Estar</h1>
        <h2 class="masthead-subheading mb-0">Gabinete</h2>
        <!-- Trigger the modal with a button -->
        <button type="button" class="btn btn-primary btn-xl rounded-pill mt-5" data-toggle="modal" data-target="#myModal">Ingresar</button>
      </div>
    </div>
    <div class="bg-circle-1 bg-circle"></div>
    <div class="bg-circle-2 bg-circle"></div>
    <div class="bg-circle-3 bg-circle"></div>
    <div class="bg-circle-4 bg-circle"></div>
  </header>

  <section>
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 order-lg-2">
          <div class="p-5">
            <img class="img-fluid rounded-circle" src="../../img/img-4.png" alt="">
          </div>
        </div>
        <div class="col-lg-6 order-lg-1">
          <div class="p-5">
            <h2 class="display-4">Tratamientos...</h2>
            <p>Tenemos los tratamientos que necesitas para estar todo lo bonita que te mereces.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section>
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6">
          <div class="p-5">
            <img class="img-fluid rounded-circle" src="../../img/img-5.png" alt="">
          </div>
        </div>
        <div class="col-lg-6">
          <div class="p-5">
            <h2 class="display-4">Hambiente de paz y tranquilidad...</h2>
            <p>En nuestro centro tendrás un momento de relax y paz.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section>
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 order-lg-2">
          <div class="p-5">
            <img class="img-fluid rounded-circle" src="../../img/img-6.png" alt="">
          </div>
        </div>
        <div class="col-lg-6 order-lg-1">
          <div class="p-5">
            <h2 class="display-4">Te Cuidamos...</h2>
            <p>Nuestra principal meta es cuidarte y hacerte sentir confortable.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="py-5 bg-black">
    <div class="container">
      <p class="m-0 text-center text-white small">Desarrollo: DevelSlack</p>
      <p class="m-0 text-center text-white small">Contacto: <a href="mailto:develslack@gmail.com">develslack@gmail.com</a></p>
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
    <input type="hidden" id="entorno" name="entorno" value="TG">
    
    <div class="form-group">
      <label for="usr">Usuario:</label>
      <input type="text" name="usuario" class="form-control" id="usr" placeholder="Tipee aquí el mail con el que se registró">
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" name="password" class="form-control" id="pwd">
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

</body>

</html>
