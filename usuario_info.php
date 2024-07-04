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
$message = '';

if (!empty($_POST['new_password']) && !empty($_POST['confirm_password'])) {
  if ($_POST['new_password'] === $_POST['confirm_password']) {
    // Hash the new password
    $hashed_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

    // Update the password in the database
    $update_stmt = $conn->prepare('UPDATE usuarios SET password = :password WHERE id = :id');
    $update_stmt->bindParam(':password', $hashed_password);
    $update_stmt->bindParam(':id', $_SESSION['user_id']);
    if ($update_stmt->execute()) {
      $message = 'Contraseña actualizada correctamente';
    } else {
      $message = 'Hubo un problema al actualizar la contraseña';
    }
  } else {
    $message = 'Las contraseñas no coinciden';
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
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet" />

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
  <style>
    .password-change-section {
      background-color: #f9f9f9;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      max-width: 400px;
      margin: 20px auto;
    }

    .password-change-section h2 {
      margin-bottom: 20px;
      color: #333;
    }

    .password-change-section label {
      display: block;
      margin-bottom: 8px;
      color: #555;
    }

    .password-change-section input[type="password"] {
      width: calc(100% - 22px);
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ddd;
      border-radius: 4px;
    }

    .password-change-section button {
      width: 100%;
      padding: 10px;
      background-color: red;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .password-change-section button:hover {
      background-color: #c75a5a;
    }

    .password-change-section p {
      color: #d9534f;
    }
  </style>
</head>

<body>

  <!-- encabezamiento -->
  <header>
    <!-- encabezado superior -->
    <div id="top-header">
      <div class="container">
        <ul class="header-links pull-left">
          <li>
            <a><i class="fa fa-phone"></i> +543814146349</a>
          </li>
          <li>
            <a><i class="fa fa-envelope-o"></i> alvarez.cf98@gmail.com</a>
          </li>
          <li>
            <a><i class="fa fa-map-marker"></i> Argentina, Tucuman</a>
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
            <?php if (!empty($user)) : ?>
              <i class="fa fa-user-o" style="color: red;"></i>
              <p href="usuario_info.php" style="color: white;"> <?= $user['email']; ?> </p>
              <a href="logout.php" style="color: white;">
                Logout
              </a>
            <?php else : ?>
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
  <div id="userInfo">

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
  </div>

  <div class="password-change-section">
    <h2>Cambio de contraseña</h2>
    <?php if (!empty($message)) : ?>
      <p><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>
    <form action="" method="post">
      <label for="new_password">Ingrese nueva contraseña:</label>
      <input type="password" id="new_password" name="new_password" required>
      <label for="confirm_password">Confirmar contraseña:</label>
      <input type="password" id="confirm_password" name="confirm_password" required>
      <button type="submit">Cambiar contraseña</button>
    </form>
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
            <ul class="newsletter-follow">
              <li>
                <a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a>
              </li>
              <li>
                <a href="https://x.com/?lang=es"><i class="fa fa-twitter"></i></a>
              </li>
              <li>
                <a href="https://www.instagram.com/"><i class="fa fa-instagram"></i></a>
              </li>
              <li>
                <a href="https://www.pinterest.es/"><i class="fa fa-pinterest"></i></a>
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


</body>

</html>