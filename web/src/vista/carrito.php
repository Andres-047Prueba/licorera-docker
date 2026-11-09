<?php
require_once(__DIR__ . '/../controlador/ControladorPedido.php');
$ControladorPedido = new ControladorPedido();

session_start() ;

if(!isset($_SESSION['CorreoUsua'])){
    header("Location:../index.php");
    exit;
}
else if(isset($_REQUEST['DestruirSesion'])){
    session_destroy();//destruir la session
    header("Location:../index.php");
    exit;
}

$Correo = $_SESSION['CorreoUsua'];
$Nombre = $_SESSION['NombreUsuario'];
$Rol = $_SESSION['Rol'];
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['remove_index'])) {
    $removeIndex = (int)$_GET['remove_index'];  
    
    if (isset($_SESSION['val'][$removeIndex])) {
        unset($_SESSION['val'][$removeIndex]); 
        $_SESSION['val'] = array_values($_SESSION['val']);  // Reorganiza los índices
    }
    
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}


$datos = $_SESSION['val'] ?? []; 

if(isset($_REQUEST['botonPedido'])){
    $ControladorPedido->RegistrarPedido();
}
//var_dump($_SESSION['val']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Carrito LicoreraJP</title>
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
    <link href="../css/style.css" rel="stylesheet">
</head>

<body>


    <!-- Topbar Start -->
    

   <!-- Topbar End -->
        <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
        <div class="col-lg-4">
            <a href="../index.php" class="text-decoration-none">
                <span class="h1 text-uppercase text-white bg-primary px-2 ml-n1">Licorera</span>
                <span class="h1 text-uppercase text-white bg-primary px-2 ml-n1">JP</span>
            </a>
        </div>
        <div class="col-lg-4 col-6 text-left">

        </div>
            <div class="col-lg-4 col-6 text-right">

                <div class="d-inline-flex align-items-center">

                    <div style="margin-right: 60px;">

                      <p class="m-0">Número de contacto</p><h5 class="m-0">123456789</h5>

                    </div>

                    <div class="logout-section">
                        <a href="carrito.php?DestruirSesion" class="btn btn-danger" title="Botón para cerrar sesión">Cerrar Sesion</a>
                    </div>

                </div>

             </div>

        </div>

    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid bg-dark mb-30">
        <div class="row px-xl-5">
            <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                <a href="" class="btn px-0 ml-3">
                    
                </a>
            </div>
        </div>
    </div>
    <!-- Navbar End -->

    <!-- Checkout Start -->
   <?php $datos = isset($_SESSION['val']) ? $_SESSION['val'] : [];$valortot = 0;?>

   <form action="carrito.php" method="POST">
        <div class="container-fluid">
            <div class="row px-xl-5">
                <!-- Resumen del carrito -->
                <div class="col-lg-8 table-responsive mb-5">
                    <h5 class="section-title position-relative text-uppercase mb-3">
                        <span class="bg-secondary pr-3">Resumen del Carrito</span>
                    </h5>

                    <!-- Resumen de los productos -->
                    <table class="table table-light table-borderless table-hover text-center mb-0">
                        <thead class="thead-dark">
                            <tr>
                                <th>Productos</th>
                                <th>Precio</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle">
                            <?php if (!empty($datos)): ?>
                                <?php foreach ($datos as $index => $item): ?>
                                    <tr>
                                        <td class="align-middle">
                                            <img src="../<?= $item['imagen'] ?>" alt="" style="width: 50px;">
                                            <?= htmlspecialchars($item['nombre']) ?>
                                        </td>
                                        <td class="align-middle">$<?= htmlspecialchars($item['precio']); ?></td>
                                            <?php $valortot+=$item['precio']; ?>
                                            <td class="align-middle">
                                                <a href="carrito.php?remove_index=<?= $index ?>" title="Eliminar producto">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                            </td>

                                        </td>
                                    </tr>
                                    <!-- Campos ocultos para enviar nombre de cada producto -->
                                    <input type="hidden" name="NombreProducto[]" value="<?= htmlspecialchars($item['nombre']) ?>">
                                    <input type="hidden" name="PrecioProducto[]" value="<?= htmlspecialchars($item['precio']) ?>">
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Información de envío -->
                <div class="col-lg-8">
                    <h5 class="section-title position-relative text-uppercase mb-3">
                        <span class="bg-secondary pr-3">Dirección de Envío</span>
                    </h5>
                    <div class="bg-light p-30 mb-5">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Nombre</label>
                                <input class="form-control" type="text" placeholder="Ingrese un Nombre" id="NombreDestinatario" name="NombreDestinatario" >
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Apellido</label>
                                <input class="form-control" type="text" placeholder="Ingrese un Apellido" id="ApellidoDestinatario" name="ApellidoDestinatario">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Correo</label>
                                <input class="form-control" type="email" placeholder="example@email.com" id="CorreoDestinatario" name="CorreoDestinatario">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Teléfono</label>
                                <input class="form-control" type="text" placeholder="Ingrese un celular" id="CelularDestinatario" name="CelularDestinatario">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Dirección</label>
                                <input class="form-control" type="text" placeholder="Ingrese una Direccion" id="DireccionDestinatario" name="DireccionDestinatario">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Forma de pago</label>
                                <select class="custom-select" id="OpcionPago" name="OpcionPago">
                                    <option value="Efectivo">Efectivo</option>
                                    <option value="Transferencia">Transferencia</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total del pedido -->
                <div class="col-lg-4">
                    <h5 class="section-title position-relative text-uppercase mb-3">
                        <span class="bg-secondary pr-3">Total del pedido</span>
                    </h5>
                    <div class="bg-light p-30 mb-5">
                        <div class="border-bottom">
                            <div class="pt-2">
                                <div class="d-flex justify-content-between mt-2">
                                    <h5>Total</h5>
                                    <h5><?= $valortot ?>$</h5>
                                    <input type="hidden" name="TotalCompra" value="<?= $valortot ?>">
                                </div>
                            </div>
                        </div>
                        <div class="mb-5">
                            <div class="bg-light p-30">
                                <button class="btn btn-block btn-primary font-weight-bold py-3" name="botonPedido">Realizar pedido</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>











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
                        <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>Ubicacion del local</p>
                        <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>Correo@gmail.com</p>
                        <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>123456789</p>

                    </div>
                </div>
            </div>
        </div>
    <!-- Footer End -->


</body>

</html>