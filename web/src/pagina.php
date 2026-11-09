<?php

session_start();

if (!isset($_SESSION['val'])) {
    $_SESSION['val'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nombre'], $_POST['precio'], $_POST['imagen'])) {
    $producto = [
        'nombre' => htmlspecialchars($_POST['nombre']),
        'precio' => (float) $_POST['precio'],
        'imagen' => htmlspecialchars($_POST['imagen']),
    ];

    $_SESSION['val'][] = $producto;

    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}
  
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>JP licorera</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">  

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>

    <!-- Modal para Iniciar Sesión -->
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Iniciar Sesión</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="login.php" method="POST">
                        <div class="form-group">
                            <label for="loginEmail">Correo electrónico</label>
                            <input type="email" class="form-control" id="loginEmail" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="loginPassword">Contraseña</label>
                            <input type="password" class="form-control" id="loginPassword" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
                        <div class="text-center mt-3">
                            <a href="#" data-toggle="modal" data-target="#recoverModal" data-dismiss="modal">¿Olvidaste tu contraseña?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

   <!-- Modal para Crear Cuenta -->
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerModalLabel">Crear Cuenta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="register.php" method="POST" onsubmit="redirectToLogin()">
                    <div class="form-group">
                        <label for="registerName">Nombre completo</label>
                        <input type="text" class="form-control" id="registerName" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="registerEmail">Correo electrónico</label>
                        <input type="email" class="form-control" id="registerEmail" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="registerPassword">Contraseña</label>
                        <input type="password" class="form-control" id="registerPassword" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="registerDob">Fecha de nacimiento</label>
                        <input type="date" class="form-control" id="registerDob" name="dob" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Crear Cuenta</button>
                </form>
            </div>
        </div>
    </div>
</div>


</body>

    <!-- Topbar End -->
        <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
        <div class="col-lg-4">
            <a href="" class="text-decoration-none">
                <span class="h1 text-uppercase text-white bg-primary px-2 ml-n1">Licorera</span>
                <span class="h1 text-uppercase text-white bg-primary px-2 ml-n1">JP</span>
            </a>
        </div>
        <div class="col-lg-4 col-6 text-left">
            <!-- Espacio vacío en caso de agregar contenido en el futuro -->
        </div>
        <div class="col-lg-4 col-6 text-right">
            <div class="d-inline-flex align-items-center">
            <div style="margin-right: 40px;">
                <p class="m-0">Número de contacto</p>
                <h5 class="m-0">123456789</h5>
            </div>
                <?php if(isset($_SESSION['CorreoUsua'])){ ?>
                <div class="d-flex align-items-center">
                    <span class="mr-3 text-dark">Hola, <strong><?= htmlspecialchars($_SESSION['NombreUsuario'], ENT_QUOTES, 'UTF-8') ?></strong></span>
                    <a href="vista/carrito.php?DestruirSesion" class="btn btn-danger" title="Cerrar sesión">Cerrar sesión</a>
                </div>
                <?php } else { ?>
                <a href="ingresar.php" class="h4 text-uppercase text-white bg-primary px-2 ml-n1" 
                style="width: 200px; height: 40px; display: flex; justify-content: center; align-items: center;">Ingresar</a>
                <?php } ?>
            </div>
            </div>
        </div>


    <!-- Navbar Start -->
    <div class="container-fluid bg-dark mb-30">
        <div class="row px-xl-5">
            <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                    <?php if(isset($_SESSION['CorreoUsua'])){ ?>
                        <a href="vista/carrito.php" class="btn px-0 ml-3">
                    <?php }else { ?>
                        <a href="ingresar.php" class="btn px-0 ml-3">
                    <?php } ?>
                    <i class="fas fa-shopping-cart text-white"></i>
                    <span class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;">
                        <?= sizeof($_SESSION['val']) ?>
                    </span>
                </a>
            </div>
        </div>
    </div>

    <!-- Navbar End -->


    <!-- Carousel Start -->
    <div class="container-fluid mb-3">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <div id="header-carousel" class="carousel slide carousel-fade mb-30 mb-lg-0" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#header-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#header-carousel" data-slide-to="1"></li>
                        <li data-target="#header-carousel" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item position-relative active" style="height: 430px;">
                            <img class="position-absolute w-100 h-100" src="imgs/VinoCaru.jpg" style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Vinos</h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Disfruta de la elegancia en cada sorbo con nuestro vino Carmenere Reservado. Perfecto para acompañar momentos especiales, rodeado de frescura y naturaleza. ¡Haz que cada ocasión sea inolvidable!</p>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item position-relative" style="height: 430px;">
                            <img class="position-absolute w-100 h-100" src="imgs/CervezaCaru.jpg" style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Corona Extra</h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn">la compañera perfecta para los días soleados y los momentos al aire libre. Siente la frescura de una cerveza que captura la esencia de la relajación y la diversión bajo el sol. ¡Brinda por la buena vida!</p>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item position-relative" style="height: 430px;">
                            <img class="position-absolute w-100 h-100" src="imgs/VodkaCaru.jpg" style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Vodka</h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Explora los sabores vibrantes de Absolut. Desde la intensidad del Absolut Peppar hasta la frescura cítrica de Absolut Citron, crea cócteles únicos que despiertan los sentidos. ¡Dale un toque especial a tus celebraciones!</p>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="product-offer mb-30" style="height: 200px;">
                    <img class="img-fluid" src="imgs/1.jpg" alt="">
                    <div class="offer-text">
                        <h6 class="text-white text-uppercase">Hasta 20% de descuento</h6>
                        <h3 class="text-white mb-3">En oferctas especial</h3>
                    </div>
                </div>
                <div class="product-offer mb-30" style="height: 200px;">
                    <img class="img-fluid" src="imgs/2.jpg" alt="">
                    <div class="offer-text">
                        <h6 class="text-white text-uppercase">Llevate un 50% de descuento</h6>
                        <h3 class="text-white mb-3">Por compra con nosotroso</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->

    <div class="container-fluid pt-5 pb-3">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
        <span class="bg-secondary pr-3">Vino</span>
    </h2>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-4 px-xl-5">
        <?php 
        $productos = [$ob1, $ob3, $ob4, $ob5]; // Arreglo de productos de Vino
        foreach ($productos as $dat): ?>
            <div class="col">
                <div class="product-item bg-light mb-4">
                    <div class="product-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="<?= $dat->imagen; ?>" alt="">
                        <div class="product-action">
                            <form method="POST" action="#producto-<?= $dat->nombre ?>">
                                <input type="hidden" name="nombre" value="<?= $dat->nombre; ?>">
                                <input type="hidden" name="precio" value="<?= $dat->precio; ?>">
                                <input type="hidden" name="imagen" value="<?= $dat->imagen; ?>">
                                <button class="btn btn-outline-dark btn-square" type="submit">
                                    <i class="fa fa-shopping-cart"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <h6><?= $dat->nombre ?></h6>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <h5>$<?= $dat->precio ?></h5>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>


    <<!-- Ginebra -->
<div class="container-fluid pt-5 pb-3">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
        <span class="bg-secondary pr-3">Ginebra</span>
    </h2>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-4 px-xl-5">
        <?php 
        // Arreglo de productos para Ginebra
        $productos = [$ob6, $ob7, $ob8, $ob9, $ob10]; // Agrega los objetos de productos adicionales si es necesario
        foreach ($productos as $dat): ?>
            <div class="col">
                <div class="product-item bg-light mb-4">
                    <div class="product-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="<?= $dat->imagen; ?>" alt="">
                        <div class="product-action">
                            <form method="POST" action="#producto-<?= $dat->nombre ?>">
                                <input type="hidden" name="nombre" value="<?= $dat->nombre; ?>">
                                <input type="hidden" name="precio" value="<?= $dat->precio; ?>">
                                <input type="hidden" name="imagen" value="<?= $dat->imagen; ?>">
                                <button class="btn btn-outline-dark btn-square" type="submit">
                                    <i class="fa fa-shopping-cart"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <h6><?= $dat->nombre ?></h6>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <h5>$<?= $dat->precio ?></h5>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>


    <!-- Whisky -->
<div class="container-fluid pt-5 pb-3">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
        <span class="bg-secondary pr-3">Whisky</span>
    </h2>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-4 px-xl-5">
        <?php 
        // Arreglo de productos para Whisky
        $productos = [$ob11, $ob12, $ob13, $ob15]; // Añade más objetos de productos si es necesario
        foreach ($productos as $dat): ?>
            <div class="col">
                <div class="product-item bg-light mb-4">
                    <div class="product-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="<?= $dat->imagen; ?>" alt="">
                        <div class="product-action">
                            <form method="POST" action="#producto-<?= $dat->nombre ?>">
                                <input type="hidden" name="nombre" value="<?= $dat->nombre; ?>">
                                <input type="hidden" name="precio" value="<?= $dat->precio; ?>">
                                <input type="hidden" name="imagen" value="<?= $dat->imagen; ?>">
                                <button class="btn btn-outline-dark btn-square" type="submit">
                                    <i class="fa fa-shopping-cart"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <h6><?= $dat->nombre ?></h6>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <h5>$<?= $dat->precio ?></h5>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>


    <!-- Ron -->
<div class="container-fluid pt-5 pb-3">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
        <span class="bg-secondary pr-3">Ron</span>
    </h2>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-4 px-xl-5">
        <?php 
        // Arreglo de productos para Ron
        $productosRon = [$ob16, $ob17, $ob18, $ob19, $ob20]; // Añade más objetos según necesidad
        foreach ($productosRon as $dat): ?>
            <div class="col">
                <div class="product-item bg-light mb-4">
                    <div class="product-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="<?= $dat->imagen; ?>" alt="">
                        <div class="product-action">
                            <form method="POST" action="#producto-<?= $dat->nombre ?>">
                                <input type="hidden" name="nombre" value="<?= $dat->nombre; ?>">
                                <input type="hidden" name="precio" value="<?= $dat->precio; ?>">
                                <input type="hidden" name="imagen" value="<?= $dat->imagen; ?>">
                                <button class="btn btn-outline-dark btn-square" type="submit">
                                    <i class="fa fa-shopping-cart"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <h6><?= $dat->nombre ?></h6>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <h5>$<?= $dat->precio ?></h5>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>


    <!-- Tequila -->
<div class="container-fluid pt-5 pb-3">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
        <span class="bg-secondary pr-3">Tequila</span>
    </h2>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-4 px-xl-5">
        <?php 
        // Arreglo de productos para Tequila
        $productosTequila = [$ob21, $ob22, $ob23, $ob24, $ob25]; // Añade más objetos según necesidad
        foreach ($productosTequila as $dat): ?>
            <div class="col">
                <div class="product-item bg-light mb-4">
                    <div class="product-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="<?= $dat->imagen; ?>" alt="">
                        <div class="product-action">
                            <form method="POST" action="#producto-<?= $dat->nombre ?>">
                                <input type="hidden" name="nombre" value="<?= $dat->nombre; ?>">
                                <input type="hidden" name="precio" value="<?= $dat->precio; ?>">
                                <input type="hidden" name="imagen" value="<?= $dat->imagen; ?>">
                                <button class="btn btn-outline-dark btn-square" type="submit">
                                    <i class="fa fa-shopping-cart"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <h6><?= $dat->nombre ?></h6>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <h5>$<?= $dat->precio ?></h5>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="container-fluid pt-5 pb-3">
                <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
                    <span class="bg-secondary pr-3">Cervezas</span>
                </h2>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-4 px-xl-5">
                    <?php 
                    
                    $productosTequila = [$ob26, $ob27, $ob28, $ob29, $ob30,$ob31]; 
                    foreach ($productosTequila as $dat): ?>
                        <div class="col">
                            <div class="product-item bg-light mb-4">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100" src="<?= $dat->imagen; ?>" alt="">
                                    <div class="product-action">
                                        <form method="POST" action="#producto-<?= $dat->nombre ?>">
                                            <input type="hidden" name="nombre" value="<?= $dat->nombre; ?>">
                                            <input type="hidden" name="precio" value="<?= $dat->precio; ?>">
                                            <input type="hidden" name="imagen" value="<?= $dat->imagen; ?>">
                                            <button class="btn btn-outline-dark btn-square" type="submit">
                                                <i class="fa fa-shopping-cart"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <h6><?= $dat->nombre ?></h6>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>$<?= $dat->precio ?></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>



            <div class="container-fluid pt-5 pb-3">
                <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
                    <span class="bg-secondary pr-3">Vodka</span>
                </h2>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-4 px-xl-5">
                    <?php 
                    
                    $productosTequila = [$ob32,$ob33,$ob34,$ob35]; 
                    foreach ($productosTequila as $dat): ?>
                        <div class="col">
                            <div class="product-item bg-light mb-4">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100" src="<?= $dat->imagen; ?>" alt="">
                                    <div class="product-action">
                                        <form method="POST" action="#producto-<?= $dat->nombre ?>">
                                            <input type="hidden" name="nombre" value="<?= $dat->nombre; ?>">
                                            <input type="hidden" name="precio" value="<?= $dat->precio; ?>">
                                            <input type="hidden" name="imagen" value="<?= $dat->imagen; ?>">
                                            <button class="btn btn-outline-dark btn-square" type="submit">
                                                <i class="fa fa-shopping-cart"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <h6><?= $dat->nombre ?></h6>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>$<?= $dat->precio ?></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>



        <div class="container-fluid pt-5 pb-3">
                <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
                    <span class="bg-secondary pr-3">cigarrillos</span>
                </h2>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-4 px-xl-5">
                    <?php 
                    
                    $productosTequila = [$ob36,$ob37]; 
                    foreach ($productosTequila as $dat): ?>
                        <div class="col">
                            <div class="product-item bg-light mb-4">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100" src="<?= $dat->imagen; ?>" alt="">
                                    <div class="product-action">
                                        <form method="POST" action="#producto-<?= $dat->nombre ?>">
                                            <input type="hidden" name="nombre" value="<?= $dat->nombre; ?>">
                                            <input type="hidden" name="precio" value="<?= $dat->precio; ?>">
                                            <input type="hidden" name="imagen" value="<?= $dat->imagen; ?>">
                                            <button class="btn btn-outline-dark btn-square" type="submit">
                                                <i class="fa fa-shopping-cart"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <h6><?= $dat->nombre ?></h6>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>$<?= $dat->precio ?></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-secondary mt-5 pt-5">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
                <h5 class="text-secondary text-uppercase mb-4">Contactanos</h5>
                <p class="mb-4">¿Tienes alguna pregunta o necesitas más información sobre nuestros productos? ¡Estamos aquí para ayudarte! No dudes en ponerte en contacto con nosotros. 
                ¡Te esperamos en Licorera JP!"</p>
            </div>
                <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-4 mb-5">

                    </div>
                    <div class="col-md-4 mb-5">
                        
                    </div>
                    <div class="col-md-4 mb-5">

                        <p class="mb-2">Datos de Contacto</p>
                        <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>Ubicación del local</p>
                        <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>Correo@gmail.com</p>
                        <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>123456789</p>

                    </div>
                </div>
            </div>
        </div>
    <!-- Footer End -->

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>


</html>