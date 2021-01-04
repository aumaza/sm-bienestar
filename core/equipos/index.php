<!DOCTYPE html>
<html lang="es">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image/png" href="../icons/devices/printer-laser.png" />
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SM Bien Estar - Alquiler de Equipos</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/full-width-pics.css" rel="stylesheet">

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
            <a class="nav-link" href="../registro/sign_up.php?entorno=TE"><img class="img-reponsive img-rounded" src="../icons/status/task-complete.png" /> Registrate</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Header - set the background image for the header in the line below -->
  <header class="py-5 bg-image-full" style="background-image: url('../../img/1076-1900x1080.jpg');">
    
  </header>

  <!-- Content section -->
  <section class="py-5">
    <div class="container">
      <h1><img class="img-reponsive img-rounded" src="../../img/logo.png" /></h1><hr>
      <h2>Alquiler de Equipos</h2><hr>
      <p class="lead">Desde aquí podrá solicitar turnos para el alquiler de equipos.</p>
      <p>Si aún no tiene un usuario, regístrese y comience a trabajar junto a nosotros.</p><hr>
      <!-- Trigger the modal with a button -->
        <button type="button" class="btn btn-primary btn-xl rounded-pill mt-5" data-toggle="modal" data-target="#myModal">Ingresar</button>
    </div>
  </section>

  <!-- Image element - set the background image for the header in the line below -->
  <div class="py-5 bg-image-full" style="background-image: url('../../img/1081-1900x1080.jpg');">
    <!-- Put anything you want here! There is just a spacer below for demo purposes! -->
    <div style="height: 200px;"></div>
  </div>

  <!-- Content section -->
  <section class="py-5">
    <div class="container">
      <h1>Seriedad</h1>
      <p class="lead">Sabemos y conocemos como hacer nuestro trabajo.</p>
      <p>Nuestros años de experiencia en el rubro, nos dan la seguridad de brindar un buen servicio.</p>
    </div>
  </section>

  <!-- Footer -->
  <footer class="py-5 bg-dark">
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
    <input type="hidden" id="entorno" name="entorno" value="TE">
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
