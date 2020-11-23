<!DOCTYPE html>
<html lang="es">
<head>
  
  <title>SM Bien Estar</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="img/favicon.png" />
    <link rel="stylesheet" href="/sm-bienestar/skeleton/css/bootstrap.min.css" >
	<link rel="stylesheet" href="/sm-bienestar/skeleton/css/bootstrap-theme.css" >
	<link rel="stylesheet" href="/sm-bienestar/skeleton/css/bootstrap-theme.min.css" >
	<link rel="stylesheet" href="/sm-bienestar/skeleton/css/scrolling-nav.css" >
	<link rel="stylesheet" href="/sm-bienestar/skeleton/css/fontawesome.css">
	<link rel="stylesheet" href="/sm-bienestar/skeleton/css/fontawesome.min.css" >
	<link rel="stylesheet" href="/sm-bienestar/skeleton/css/jquery.dataTables.min.css" >
	<link rel="stylesheet" href="/sm-bienestar/skeleton/Chart.js/Chart.min.css" >
	<link rel="stylesheet" href="/sm-bienestar/skeleton/Chart.js/Chart.css" >
	
	
	
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="/sm-bienestar/skeleton/js/jquery-3.4.1.min.js"></script>
	<script src="/sm-bienestar/skeleton/js/bootstrap.min.js"></script>
	
	<script>
    $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
    });
</script>
	
  <style>
  body {
    font: 400 15px/1.8 Lato, sans-serif;
    color: #777;
  }
  h3, h4 {
    margin: 10px 0 30px 0;
    letter-spacing: 10px;      
    font-size: 20px;
    color: #111;
  }
  .container {
    padding: 80px 120px;
  }
  .person {
    border: 10px solid transparent;
    margin-bottom: 25px;
    width: 80%;
    height: 80%;
    opacity: 0.7;
  }
  .person:hover {
    border-color: #f1f1f1;
  }
  .carousel-inner img {
    -webkit-filter: grayscale(75%);
    filter: grayscale(40%); /* make all photos black and white */ 
    width: 65%; /* Set width to 100% */
    margin: auto;
  }
  .carousel-caption h3 {
    color: #fff !important;
  }
  @media (max-width: 600px) {
    .carousel-caption {
      display: none; /* Hide the carousel text when the screen is less than 600 pixels wide */
    }
  }
  .bg-1 {
    background: #2d2d30;
    color: #bdbdbd;
  }
  .bg-1 h3 {color: #fff;}
  .bg-1 p {font-style: italic;}
  .list-group-item:first-child {
    border-top-right-radius: 0;
    border-top-left-radius: 0;
  }
  .list-group-item:last-child {
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 0;
  }
  .thumbnail {
    padding: 0 0 15px 0;
    border: none;
    border-radius: 0;
  }
  .thumbnail p {
    margin-top: 15px;
    color: #555;
  }
  .btn {
    padding: 10px 20px;
    background-color: #333;
    color: #f1f1f1;
    border-radius: 0;
    transition: .2s;
  }
  .btn:hover, .btn:focus {
    border: 1px solid #333;
    background-color: #fff;
    color: #000;
  }
  .modal-header, h4, .close {
    background-color: #333;
    color: #fff !important;
    text-align: center;
    font-size: 30px;
  }
  .modal-header, .modal-body {
    padding: 40px 50px;
  }
  .nav-tabs li a {
    color: #777;
  }
  #googleMap {
    width: 100%;
    height: 400px;
    -webkit-filter: grayscale(100%);
    filter: grayscale(100%);
  }  
  .navbar {
    font-family: Montserrat, sans-serif;
    margin-bottom: 0;
    background-color: #2d2d30;
    border: 0;
    font-size: 11px !important;
    letter-spacing: 4px;
    opacity: 0.9;
  }
  .navbar li a, .navbar .navbar-brand { 
    color: #d5d5d5 !important;
  }
  .navbar-nav li a:hover {
    color: #fff !important;
  }
  .navbar-nav li.active a {
    color: #fff !important;
    background-color: #29292c !important;
  }
  .navbar-default .navbar-toggle {
    border-color: transparent;
  }
  .open .dropdown-toggle {
    color: #fff;
    background-color: #555 !important;
  }
  .dropdown-menu li a {
    color: #000 !important;
  }
  .dropdown-menu li a:hover {
    background-color: red !important;
  }
  footer {
    background-color: #2d2d30;
    color: #f5f5f5;
    padding: 32px;
  }
  footer a {
    color: #f5f5f5;
  }
  footer a:hover {
    color: #777;
    text-decoration: none;
  }  
  .form-control {
    border-radius: 0;
  }
  textarea {
    resize: none;
  }
  </style>
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">

<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#myPage"><img src="img/logo.png" class="img-rounded" alt="Random Name" width="180" height="50"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#sm">SM Bienestar</a></li>
        <li><a href="#promos">PROMOS</a></li>
        <li><a href="#contact">CONTACTO</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">ENTORNOS
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li class="active"><a href="core/administracion/" data-toggle="tooltip" title="Entorno Restringido a Admistradores">Administración</a></li>
            <li class="divider"></li>
            <li><a href="core/productos/" data-toggle="tooltip" title="Compra de Productos de Belleza">Venta de Productos</a></li>
            <li><a href="core/gabinete/" data-toggle="tooltip" title="Solicite Turnos para Atenderse en Gabinete">Turnos Gabinete</a></li>
            <li><a href="core/equipos/#" data-toggle="tooltip" title="Reserve su Equipo por medio de Turnos">Turnos Alquiler Equipos</a></li>
            <li><a href="core/venta/#" data-toggle="tooltip" title="Compra de Equipos">Venta de Equipos</a></li>
            <li><a href="core/capacitacion/" data-toggle="tooltip" title="Espacio de Capacitación On-line">Capacitación</a></li>
          </ul>
        </li>
       </ul>
    </div>
  </div>
</nav>

<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <img src="img/img-4.png" alt="New York" width="1200" height="700">
        <div class="carousel-caption">
          <h3>Tratamientos faciales</h3>
          <p>Limpieza de cutis, tratamientos anti-age, peeling, e hidratación.</p>
        </div>      
      </div>

      <div class="item">
        <img src="img/img-5.png" alt="Chicago" width="1200" height="700">
        <div class="carousel-caption">
          <h3>Tratamientos corporales</h3>
          <p>Electroestimulación, crio y termogel, tratamientos exfoliantes y revitalizantes con vitamina C.</p>
        </div>      
      </div>
    
      <div class="item">
        <img src="img/img-6.png" alt="Los Angeles" width="1200" height="700">
        <div class="carousel-caption">
          <h3>Limpiesa de Cutis</h3>
          <p>Exfoliación, Hidratación, Máscara Descongestiva</p>
        </div>      
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
</div>

<!-- Container (The Band Section) -->
<div id="sm" class="container text-center">
  <h3><img src="img/logo.png" class="img-rounded" alt="Random Name" width="180" height="50"></h3>
  <p><em>Veni por un día, y senti el Bien Estar por una semana</em></p>
  <p>Ofrecemos una gran variedad de tratamientos faciales y corporales con los mejores productos del mercado, diseñados para relajar, desintoxicar y devolver la armonía al cuerpo.</p>
  <br>
  <div class="row">
    <div class="col-sm-4">
      <p class="text-center"><strong>Tratamientos Faciales</strong></p><br>
      <p>Limpieza profunda de cutis, arrugas, manchas, acné, rosácea, exfoliacion, peeling y electroporacion.</p><br>
      <img src="img/img-1.png" class="img-circle person" alt="Random Name" width="255" height="255">
      </div>
    
    <div class="col-sm-4">
      <p class="text-center"><strong>Terapias corporales y esteticas</strong></p><br>
      <p>Piernas cansadas, adiposidad localizada, varicosidad, estrias, foliculitis, drenaje linfatico, exfoliación, hemolinfatico, termogel / Criogel y electroestimulacion.</p><br>
      <img src="img/img-2.png" class="img-circle person" alt="Random Name" width="255" height="255">
     
    </div>
    
    <div class="col-sm-4">
      <p class="text-center"><strong>Masajes</strong></p><br>
      <p>Relajante, descontracturante y hemolinfatico.</p><br>
      <img src="img/img-3.png" class="img-circle person" alt="Random Name" width="255" height="255">
      </div>
  </div>
</div>

<!-- Container (PROMOS Section) -->
<div id="promos" class="bg-1">
  <div class="container">
    <h3 class="text-center">NUESTRAS PROMOS</h3>
    <p class="text-center">Promos para tu bienestar.<br> Consultá!</p>
        
    <div class="row text-center">
      <div class="col-sm-4">
        <div class="thumbnail">
          <img src="img/img-8.png" alt="Paris" width="400" height="300">
          <p><strong>Promo 1</strong></p>
          <p>Friday 27 November 2015</p>
          </div>
      </div>
      <div class="col-sm-4">
        <div class="thumbnail">
          <img src="img/img-9.png" alt="New York" width="400" height="300">
          <p><strong>Promo 2</strong></p>
          <p>Saturday 28 November 2015</p>
          </div>
      </div>
      <div class="col-sm-4">
        <div class="thumbnail">
          <img src="img/img-10.png" alt="San Francisco" width="400" height="300">
          <p><strong>Promo 3</strong></p>
          <p>Sunday 29 November 2015</p>
          </div>
      </div>
    </div>
  </div>
  
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">×</button>
          <h4><span class="glyphicon glyphicon-lock"></span> Tickets</h4>
        </div>
        <div class="modal-body">
          <form role="form">
            <div class="form-group">
              <label for="psw"><span class="glyphicon glyphicon-shopping-cart"></span> Tickets, $23 per person</label>
              <input type="number" class="form-control" id="psw" placeholder="How many?">
            </div>
            <div class="form-group">
              <label for="usrname"><span class="glyphicon glyphicon-user"></span> Send To</label>
              <input type="text" class="form-control" id="usrname" placeholder="Enter email">
            </div>
              <button type="submit" class="btn btn-block">Pay 
                <span class="glyphicon glyphicon-ok"></span>
              </button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal">
            <span class="glyphicon glyphicon-remove"></span> Cancel
          </button>
          <p>Need <a href="#">help?</a></p>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Container (Contact Section) -->
<div id="contact" class="container">
  <h3 class="text-center">Contactanos</h3>
  <p class="text-center"><em>Dejanos tu inquietud!</em></p>

  <div class="row">
    <div class="col-md-4">
      <p><span class="glyphicon glyphicon-map-marker"></span>Remedios de Escalada, Zárate 64, Lanus, Buenos Aires</p>
      <p><span class="glyphicon glyphicon-phone"></span>Cel: +54 9 11 5646-9787</p>
      <p><span class="glyphicon glyphicon-envelope"></span>Email: mail@mail.com</p>
    </div>
    <div class="col-md-8">
      <div class="row">
        <div class="col-sm-6 form-group">
          <input class="form-control" id="name" name="name" placeholder="Nombre" type="text" required>
        </div>
        <div class="col-sm-6 form-group">
          <input class="form-control" id="email" name="email" placeholder="Email" type="email" required>
        </div>
      </div>
      <textarea class="form-control" id="comments" name="comments" placeholder="Comentario" rows="5"></textarea>
      <br>
      <div class="row">
        <div class="col-md-12 form-group">
          <button class="btn pull-right" type="submit">Enviar</button>
        </div>
      </div>
    </div>
  </div>
  <br>
  <h3 class="text-center">STAFF</h3>  
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Silvia</a></li>
    <li><a data-toggle="tab" href="#menu1">Andrea</a></li>
    </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <h2>Silvia Medina, Titular</h2>
      <p>Cosmeatra  • Estetisista • Masoterapeuta • Instrumentadora Quirúrgica</p>
    </div>
    <div id="menu1" class="tab-pane fade">
      <h2>Andrea Scorziello</h2>
      <p>Secretaria, Asistente</p>
    </div>
    
  </div>
</div>

<!-- Image of location/map -->
<img src="img/img-7.png" class="img-responsive" style="width:100%">

<!-- Footer -->
<footer class="text-center">
  <a class="up-arrow" href="#myPage" data-toggle="tooltip" title="TO TOP">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a><br><br>
  <p>Desarrollo DevelSlack</p>
  <p>Contacto: develslack@gmail.com</p>
</footer>

<script>
$(document).ready(function(){
  // Initialize Tooltip
  $('[data-toggle="tooltip"]').tooltip(); 
  
  // Add smooth scrolling to all links in navbar + footer link
  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {

    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {

      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 900, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
})
</script>

</body>
</html>
