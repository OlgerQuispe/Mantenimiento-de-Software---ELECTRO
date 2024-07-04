<?php

  require 'database.php';

  $message = '';

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $sql = "INSERT INTO usuarios (email, password) VALUES (:email, :password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password);

    if ($stmt->execute()) {
      $message = 'Successfully created new user';
    } else {
      $message = 'Sorry there must have been an issue creating your account';
    }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>SignUp</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style2.css">
  </head>
  <body>

    <?php require 'partials/header.php' ?>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>SignUp</h1>
    <span>or <a href="login.php">Login</a></span>

    <form action="signup.php" method="POST">
      <input name="email" type="text" placeholder="Enter your email">
      <input name="password" type="password" placeholder="Enter your Password">
      <input name="confirm_password" type="password" placeholder="Confirm Password">
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
