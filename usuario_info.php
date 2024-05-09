<?php
  session_start();

  require 'database.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, email, password FROM usuarios WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
  }

?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Las 3 metaetiquetas anteriores * deben * estar primero en la cabeza; cualquier otro contenido principal debe venir * después * de estas etiquetas -->

    <title>Bienvenidos a Electro Compras</title>

    <!-- fuente de Google -->
    <link
      href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700"
      rel="stylesheet"
    />

    <!-- bootstrap -->
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />

    <!-- carrusel -->
    <link type="text/css" rel="stylesheet" href="css/slick.css" />
    <link type="text/css" rel="stylesheet" href="css/slick-theme.css" />

    <!-- nouislider -->
    <link type="text/css" rel="stylesheet" href="css/nouislider.min.css" />

    <!--icono de fuente impresionante -->
    <link rel="stylesheet" href="css/font-awesome.min.css" />

    <!-- CSS -->
    <link type="text/css" rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="assets/css/info.css">
  </head>
  <body>
    
    <!-- encabezamiento -->
    <header>
      <!-- encabezado superior -->
      <div id="top-header">
        <div class="container">
            <ul class="header-links pull-left">
                <li>
                <a href="#"><i class="fa fa-phone"></i> +543814146349</a>
                </li>
                <li>
                <a href="#"
                    ><i class="fa fa-envelope-o"></i> alvarez.cf98@gmail.com</a
                >
                </li>
                <li>
                <a href="#"
                    ><i class="fa fa-map-marker"></i> Argentina, Tucuman</a>
                </li>
            </ul>
            
        </div>
      </div>
      <!--  /encabezado superior-->

      <!-- encabezado principal -->
      <div id="header">
        <!-- container -->
        <div class="container">
          <!-- fila -->
          <div class="row">
            <!-- logo -->
            <div class="col-md-11">
              <div class="header-logo">
                <a href="index.php" class="logo">
                  <img src="img/logo.png" alt="" />
                </a>
              </div>
            </div>
            <!-- /logo -->

            <!-- cuenta -->
            <div class="col-md-1 pull-left">
                             
                <!-- Correo header -->
                <?php if(!empty($user)): ?>
                <i class="fa fa-user-o" style="color: red;"></i>
                <p href="usuario_info.php" style="color: white;"> <?= $user['email']; ?> </p>
                <a href="logout.php" style="color: white;">
                  Logout
                </a>
                <?php else: ?>
                    <i class="fa fa-user-o"></i>
                    <a href="login.php">Iniciar Sesión</a> o
                    <a href="signup.php">Registrarme</a>
                <?php endif; ?>
                <!-- /Fin Correo header-->

                
              </div>
            </div>
            <!-- /cuenta -->
          </div>
          <!-- row -->
        </div>
        <!-- container -->
      </div>
      <!-- /encabezado pricipal -->
    </header>
    <!-- /encabezamiento -->


    <!-- seccion -->
    <div class="container row" id="userInfo">
        
            <div class="userHeader">
                <img src="img/lofi.png" alt="User Avatar">
                <h2 id="titulo-info">Tu Información</h2>
            </div>
            <div class="userDetails">
                <p><strong>Name:</strong> John Doe</p>
                <p><strong>Email:</strong> <?php echo $results['email']; ?></p>
                <p><strong>Location:</strong> Lima, Peru</p>
                <p><strong>Occupation:</strong> Web Developer</p>
                <p><strong>Interests:</strong> Programming, Traveling, Photography</p>
            </div>
            <div class="userActions">
                <button>Edit Information</button>
                <button ><a href="cambiar_contraseña.php">Change Password</a></button>
            </div>
       
    </div>
    <!-- /SECTION -->

    <!-- SECTION -->
    <div class="section">
      <!-- container -->
      <div class="container">
        <!-- row -->
        <div class="row"></div>
        <!-- /row -->
      </div>
      <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- carta noticias -->
    <div id="newsletter" class="section">
      <!-- container -->
      <div class="container">
        <!-- fila -->
        <div class="row">
          <div class="col-md-12">
            <div class="newsletter">
              <p>Suscríbase a la <strong>Carta de Noticias</strong></p>
              <form>
                <input
                  class="input"
                  type="email"
                  placeholder="Introduce tu correo electrónico"
                />
                <button class="newsletter-btn">
                  <i class="fa fa-envelope"></i> Suscribetete
                </button>
              </form>
              <ul class="newsletter-follow">
                <li>
                  <a href="#"><i class="fa fa-facebook"></i></a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-twitter"></i></a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-instagram"></i></a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-pinterest"></i></a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <!-- /fila -->
      </div>
      <!-- /container -->
    </div>
    <!-- /carta noticias -->

    <!-- pie de pagina -->
    <footer id="footer">
      <!-- pie de pagina supeior -->
      <div class="section">
        <!-- container -->
        <div class="container">
          <!-- fila -->
          <div class="row">
            <div class="col-md-3 col-xs-6">
              <div class="footer">
                <h3 class="footer-title">Sobre nosotros</h3>
                <p>
                  Somos un microemprendimiento realizando sus primeros pasos en
                  el rubro de la informatica, estamos ubicados en la localidad
                  de San Miguel de Tucuman.
                </p>
                <ul class="footer-links">
                  <li>
                    <a href="#"
                      ><i class="fa fa-map-marker"></i>Argentina, Tucuman</a
                    >
                  </li>
                  <li>
                    <a href="#"><i class="fa fa-phone"></i>+5493814146349</a>
                  </li>
                  <li>
                    <a href="#"
                      ><i class="fa fa-envelope-o"></i>alvarez.cf98@gmail.com</a
                    >
                  </li>
                </ul>
              </div>
            </div>

            <div class="col-md-3 col-xs-6">
              <div class="footer">
                <h3 class="footer-title">Categorias</h3>
                <ul class="footer-links">
                  <li><a href="#">Ofertas</a></li>
                  <li><a href="#">Notebook</a></li>
                  <li><a href="#">Smartphones</a></li>
                  <li><a href="#">Camaras</a></li>
                  <li><a href="#">Accesorios</a></li>
                </ul>
              </div>
            </div>

            <div class="clearfix visible-xs"></div>

            <div class="col-md-3 col-xs-6">
              <div class="footer">
                <h3 class="footer-title">Informacion</h3>
                <ul class="footer-links">
                  <li><a href="#">Sobre Nosotros</a></li>
                  <li><a href="#">Contactenos</a></li>
                  <li><a href="#">Política de privacidad</a></li>
                  <li><a href="#">Pedidos y Devoluciones</a></li>
                  <li><a href="#">Términos y condiciones</a></li>
                </ul>
              </div>
            </div>

            <div class="col-md-3 col-xs-6">
              <div class="footer">
                <h3 class="footer-title">Servicios</h3>
                <ul class="footer-links">
                  <li><a href="#">Mi cuenta</a></li>
                  <li><a href="#">Ver Carrito</a></li>
                  <li><a href="#">Lista de deseos</a></li>
                  <li><a href="#">Seguir mi pedido</a></li>
                  <li><a href="#">Ayuda</a></li>
                </ul>
              </div>
            </div>
          </div>
          <!-- /fila -->
        </div>
        <!-- /container -->
      </div>
      <!-- /pie de pagina supeior -->

      <!-- pie de pagina inferior -->
      <div id="bottom-footer" class="section">
        <div class="container">
          <!-- fila -->
          <div class="row">
            <div class="col-md-12 text-center">
              <ul class="footer-payments">
                <li>
                  <a href="#"><i class="fa fa-cc-visa"></i></a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-credit-card"></i></a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-cc-paypal"></i></a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-cc-mastercard"></i></a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-cc-discover"></i></a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-cc-amex"></i></a>
                </li>
              </ul>
              <span class="saludo">
                <p>
                  Hecho con <i class="fa fa-heart-o" aria-hidden="true"></i> por
                  <a href="https://github.com/C-Alvarez98" target="_blank"
                    >Cristian</a
                  >
                </p>
              </span>
            </div>
          </div>
          <!-- /fila -->
        </div>
        <!-- /container -->
      </div>
      <!-- /pie de pagina inferior -->
    </footer>
    <!-- /pie de pagina -->

    <!-- jQuery plugins -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/nouislider.min.js"></script>
    <script src="js/jquery.zoom.min.js"></script>
    <script src="js/main.js"></script>

    
  </body>
</html>