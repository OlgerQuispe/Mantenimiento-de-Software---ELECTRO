<?php

  session_start();

  if (isset($_SESSION['user_id'])) {
    header('Location: /php-login-copia');
  }
  require 'database.php';

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT id, email, password FROM usuarios WHERE email = :email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if ($results > 0 && password_verify($_POST['password'], $results['password'])) {
      $_SESSION['user_id'] = $results['id'];
      header("Location: /php-login-copia");
    } else {
      $message = 'Lo siento, las credenciales no coinciden';
    }
  }

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style2.css">
  </head>
  <body>
    <?php require 'partials/header.php' ?>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>Login</h1>
    <span>or <a href="signup.php">SignUp</a></span>

    <form action="login.php" method="POST">
      <input id="email" name="email" type="text" placeholder="Enter your email">
      <input name="password" type="password" placeholder="Enter your Password">
      <input style="background: #d10024;" type="submit" value="Submit">
    </form>


      <!-- pie de pagina -->
  <footer id="footer">
    <!-- pie de pagina supeior -->
    <div class="section">
      <!-- container -->
      <div class="container">
        <!-- fila -->
        <div class="row">
          <div class="col-md-6 col-xs-6">
            <div class="footer">
              <h3 class="footer-title">Sobre nosotros</h3>
              <p>
                Somos un microemprendimiento realizando sus primeros pasos en
                el rubro de la informatica, estamos ubicados en la localidad
                de San Miguel de Tucuman.
              </p>
              <ul class="footer-links">
                <li>
                  <a><i class="fa fa-map-marker"></i>Argentina, Tucuman</a>
                </li>
                <li>
                  <a><i class="fa fa-phone"></i>+5493814146349</a>
                </li>
                <li>
                  <a><i class="fa fa-envelope-o"></i>alvarez.cf98@gmail.com</a>
                </li>
              </ul>
            </div>
          </div>

          <div class="col-md-3 col-xs-6">
            <div class="footer">
              <h3 class="footer-title">Categorias</h3>
              <ul class="footer-links">
                <li><a href="index.php">Ofertas</a></li>
              </ul>
            </div>
          </div>

          <div class="clearfix visible-xs"></div>

          

          <div class="col-md-3 col-xs-6">
            <div class="footer">
              <h3 class="footer-title">Servicios</h3>
              <ul class="footer-links">
                <li><a href="usuario_info.php">Mi cuenta</a></li>
                <li><a href="index.php">Ver Carrito</a></li>
                <li><a href="index.php">Lista de deseos</a></li>
                <li><a href="index.php">Seguir mi pedido</a></li>

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
                <a <i class="fa fa-cc-visa"></i></a>
              </li>
              <li>
                <a <i class="fa fa-credit-card"></i></a>
              </li>
              <li>
                <a <i class="fa fa-cc-paypal"></i></a>
              </li>
              <li>
                <a <i class="fa fa-cc-mastercard"></i></a>
              </li>
              <li>
                <a <i class="fa fa-cc-discover"></i></a>
              </li>
              <li>
                <a <i class="fa fa-cc-amex"></i></a>
              </li>
            </ul>
            <span class="saludo">
              <p>
                Hecho con <i class="fa fa-heart-o" aria-hidden="true"></i> por
                <a href="https://github.com/OlgerQuispe/Mantenimiento-de-Software---ELECTRO" target="_blank">Olger</a>
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
    <script src="js/custom.js"></script>
    <script src="js/starrr.js"></script>
  </body>
  <script>
        document.addEventListener('DOMContentLoaded', () => {
            const emailInput = document.getElementById('email');
           
            emailInput.addEventListener('input', () => {
                const email = emailInput.value;
                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailPattern.test(email)) {
                    emailInput.setCustomValidity('Ingrese un correo electrónico válido');
                } else {
                    emailInput.setCustomValidity('');
                }
            });
        });
    </script>
</html>
