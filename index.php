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

  try {
    $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta para obtener los productos
    $query = "SELECT p.id, p.titulo, p.precio, p.stock, p.img_url, p.starr, cp.categoria_nombre AS categoria 
    FROM productos p
    JOIN categoria_productos cp ON p.categoria = cp.id_categoria";
    $stmt = $conn->query($query);
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
      die('Connection Failed: ' . $e->getMessage());
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
          <ul class="header-links pull-right">
            <li>
              <?php if(!empty($user)): ?>
                <i class="fa fa-user-o"></i>
                <a href="usuario_info.php"> <?= $user['email']; ?> </a>
                <a href="logout.php">
                  Logout
                </a>
              <?php else: ?>
                <i class="fa fa-user-o"></i>
                <a href="login.php">Iniciar Sesión</a> o
                <a href="signup.php">Registrarme</a>
              <?php endif; ?>
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
            <div class="col-md-3">
              <div class="header-logo">
                <a href="index.php" class="logo">
                  <img src="img/logo.png" alt="" />
                </a>
              </div>
            </div>
            <!-- /logo -->

            <!-- barra de busqueda -->
            <div class="col-md-6">
              <div class="header-search">
                <form>
                  <input id="search-input" class="input" placeholder="Buscar Aqui"  type="search"/>
                  <button id="search" class="search-btn">Buscar</button>
                </form>
              </div>
            </div>
            <!-- /barra de busqueda -->

            <!-- cuenta -->
            <div class="col-md-3 clearfix">
              <div class="header-ctn">
                <!-- lista de deseos -->
                <div class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                    <i class="fa fa-heart-o"></i>
                    <span>Lista de deseos</span>
                    <div class="wish-qty qty" >0</div>
                  </a>
                  <div class="cart-dropdown">
                    <div class="cart-list">
                      <div class="wish-widget producto-widget">
                        <div class="producto-img"></div>
                        <button class="delete">
                          <i class="fa fa-close"></i>
                        </button>
                      </div>

                      <div class="producto-widget">
                        <div class="producto-img"></div>
                      </div>
                    </div>
                  </div>
                </div>
                
                <!-- /lista de deseos -->

                <!-- carrito de compras -->
                <div class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true"               >
                    <i class="fa fa-shopping-cart"></i>
                    <span>Su Carrito</span>
                    <div class="qty-cart qty" >0</div>
                  </a>
                  <div class="cart-dropdown">
                    <div class="cart-list">
                      <div class="carrito-widget  product-widget">
                        <div class="product-img"></div>
                        <button class="delete">
                          <i class="fa fa-close"></i>
                        </button>
                      </div>

                      <div class="cart-widget product-widget">
                        <div class="product-img"></div>
                      </div>
                    </div>
                    <div class="cart-summary">
                      <small> Articulos seleccionados</small>
                      <h5>SUBTOTAL:  <strong class="price-total">0</strong>$</h5>
                    </div>
                    <div class="cart-btns">
                      <a href="checkout(Revisa).html" style="width: 100%;">Comprar <i class="fa fa-arrow-circle-right" ></i></a>
                    </div>
                  </div>
                </div>
                <!-- /carrito de compras -->

                <!-- alternar menu -->
                <div class="menu-toggle">
                  <a href="#">
                    <i class="fa fa-bars"></i>
                    <span>Menu</span>
                  </a>
                </div>
                <!-- /alternar menu -->
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

    <!-- navegacion -->
    <nav id="navigation">
      <!-- container -->
      <div class="container">
        <!-- responsive-nav -->
        <div id="responsive-nav">
          <!-- nav -->
          <ul class="main-nav nav navbar-nav">
              <li class="active"><a data-category="all">Inicio</a></li>              
          </ul>
          <!-- /nav -->
        </div>
        <!-- /responsive-nav -->
      </div>
      <!-- /container -->
    </nav>
    <!-- /navegacion -->

    <!-- Seccion -->
    <div class="section">
      <!-- container -->
      <div class="container">
        <!-- fila -->
        <div class="row">
          <!-- sección de título -->
          <div class="col-md-4">
            <div class="section-title">
              <h3 class="title">Nuevos Productos</h3>
              <div class="section-nav">
                <ul class="section-tab-nav tab-nav">
                  <li class="active"></li>
                </ul>
              </div>
            </div>
          </div>
          <!-- /seccion de titulo -->

          <!-- pestaña de productos y carruse -->
          <div class="pestaña col-md-12" >
            <div class="row">
              <div class="products-tabs">
                <!-- pestaña -->
                <div id="tab1" class="tab-pane active"><!--Si quito el tab-pane se arregla lo de las estrellitas-->
                  <?php foreach ($productos as $producto): ?>
                    <!-- producto -->
                    <div class="col-md-4 col-xs-12">
                      <div class="product" data-category=" <?php $producto['categoria'] ?>" >
                        <div class="product-img">
                          <img src="<?php echo $producto['img_url'] ?>" alt="" />
                          <div class="product-label">
                            <span class="sale">-30%</span>
                            <span class="new">Nuevo</span>
                          </div>
                        </div>
                        <div class="product-body">
                          <p class="product-category"><?php echo $producto['categoria'] ?></p>
                          <h3 class="product-name">
                            <a href="#"><?php echo $producto['titulo'] ?></a>
                          </h3>
                          <h4 class="product-price">$<?php echo $producto['precio'] ?></h4>
                          <div>
                            <h5 class="desription">DISCO: 64GB eMMC + 4GB DDR4 7th GENERACIÓN SUPER LIVIANA Y PRÁCTICA </h5>
                          </div>

                          <hr />
                          <span id="<?php echo $producto['starr']?>"></span>
                          <hr />
                          <span class="rating-text"></span>

                          <div class="product-btns">
                            <button class="add-to-wishlist">
                              <i class="fa fa-heart-o red-heart"></i>
                              <span class="tooltipp">añadir a lista de deseos</span>
                            </button>
                          </div>
                        </div>
                        <div class="add-to-cart">
                          <button class="add-to-cart-btn" data-id="<?php echo $producto['id'] ?>">
                            <i class="fa fa-shopping-cart"></i> añadir al carrito
                          </button>
                        </div>
                      </div>
                    </div>
                    <!-- /producto -->
                  <?php endforeach; ?>
                </div>
                <!-- /pestaña -->
              </div>

            </div>
            
          </div>
          <!-- /pestaña de productos y carrusel -->
        </div>
        <!-- /fila/row -->
      </div>
      <!-- /container -->
    </div>
    <!-- /seccion -->

    <!-- seccion -->
    
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
    <script src="js/custom3.js"></script>
    <script src="js/wishlist.js"></script>
    <script src="js/starrr.js"></script>
    <script src="js/search.js"></script>
    <script src="js/search-category.js"></script>

    
    <script>
      $('#Estrellas').starrr({
          rating: 3,
          change: function (e, valor) {
              $(e.target).siblings('.rating-text').text(valor);
          }
      });

      // Repite el mismo patrón para los otros grupos de estrellas
      $('#Estrellas2').starrr({
          rating: 3,
          change: function (e, valor) {
              $(e.target).siblings('.rating-text').text(valor);
          }
      });

      $('#Estrellas3').starrr({
          rating: 3,
          change: function (e, valor) {
              $(e.target).siblings('.rating-text').text(valor);
          }
      });

      $('#Estrellas4').starrr({
          rating: 3,
          change: function (e, valor) {
              $(e.target).siblings('.rating-text').text(valor);
          }
      });

      $('#Estrellas5').starrr({
          rating: 3,
          change: function (e, valor) {
              $(e.target).siblings('.rating-text').text(valor);
          }
      });
    </script>

  <script>
    $(document).ready(function() {
      $('.add-to-wishlist').on('click', function() {
        $(this).find('i').toggleClass('fa-heart-o fa-heart red-heart');
      });
    });
  </script>



  </body>
</html>
