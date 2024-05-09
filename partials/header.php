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
              <a href="#"><i class="fa fa-phone"></i> +543814146349</a>
            </li>
            <li>
              <a href="#"
                ><i class="fa fa-envelope-o"></i> alvarez.cf98@gmail.com</a
              >
            </li>
            <li>
              <a href="#"
                ><i class="fa fa-map-marker"></i> Argentina, Tucuman</a
              >
            </li>
          </ul>
          <ul class="header-links pull-right">
            <li>
              <?php if(!empty($user)): ?>
                  <br> <?= $user['email']; ?>
                  <br>
                  <a href="logout.php">
                    Logout
                  </a>
                <?php else: ?>
                  <i class="fa fa-user-o"></i>
                  <a href="login.php">Iniciar Sesión</a> o
                  <a href="signup.php">Registrarme</a>
                <?php endif; ?> 
              </a>
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
                  <select class="input-select">
                    <option value="0">Todas las Categorias</option>
                    <option value="1">Notebook</option>
                    <option value="2">Smartphones</option>
                    <option value="3">Camaras</option>
                    <option value="4">Accesorios</option>
                  </select>
                  <input class="input" placeholder="Buscar Aqui" />
                  <button class="search-btn">Buscar</button>
                </form>
              </div>
            </div>
            <!-- /barra de busqueda -->

            <!-- cuenta -->
            <div class="col-md-3 clearfix">
              <div class="header-ctn">
                <!-- lista de deseos -->
                <div>
                  <a href="#">
                    <i class="fa fa-heart-o"></i>
                    <span>Lista de deseos</span>
                    <div class="qty">0</div>
                  </a>
                </div>
                <!-- /lista de deseos -->

                <!-- carrito de compras -->
                <div class="dropdown">
                  <a
                    class="dropdown-toggle"
                    data-toggle="dropdown"
                    aria-expanded="true"
                  >
                    <i class="fa fa-shopping-cart"></i>
                    <span>Su Carrito</span>
                    <div class="qty-cart qty" >0</div>
                  </a>
                  <div class="cart-dropdown">
                    <div class="cart-list">
                      <div class="product-widget">
                        <div class="product-img"></div>
                        <button class="delete">
                          <i class="fa fa-close"></i>
                        </button>
                      </div>

                      <div class="product-widget">
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

    
  </body>
</html>
