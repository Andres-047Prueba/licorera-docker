<?php
//incluir un archivo
require_once(__DIR__ . '/../modelo/Pedido.php');
require_once(__DIR__ . '/../modelo/CrudPedido.php');


class ControladorPedido{
    
    public function __construct(){}


    public function RegistrarPedido(){
        // Obtener los datos del formulario
        $nombresProductos = $_REQUEST['NombreProducto']; // Array de nombres de productos
        $preciosProductos = $_REQUEST['PrecioProducto']; // Array de precios de productos

        

        
        // Crear un objeto Pedido
        $pedido = new Pedido();
        $pedido->setNombreDestinatario($_REQUEST['NombreDestinatario']);
        $pedido->setApellidoDestinatario($_REQUEST['ApellidoDestinatario']);
        $pedido->setCorreoDestinatario($_REQUEST['CorreoDestinatario']);
        $pedido->setCelularDestinatario($_REQUEST['CelularDestinatario']);
        $pedido->setDireccionDestinatario($_REQUEST['DireccionDestinatario']);
        $pedido->setOpcionPago($_REQUEST['OpcionPago']);
        $pedido->setTotalCompra($_REQUEST['TotalCompra']); // Asignar el total de la compra al objeto pedido
    
        // Registrar el pedido en la base de datos
        $CrudPedido = new CrudPedido();
        $pedidoId = $CrudPedido->RegistrarPedidoConProductos($pedido, $nombresProductos, $preciosProductos); // Llamar al método del CRUD para registrar el pedido y los productos
    
        // Verificar si el registro fue exitoso
        if ($pedidoId) {
            $_SESSION['val'] = []; // el pedido ya quedó guardado: se vacía el carrito
            // Mostrar un mensaje de éxito
            echo '<script language="javascript">
                    alert("Su pedido ha sido registrado con éxito");
                    window.location.href = "../index.php"; // Redirigir a la página principal u otra página
                  </script>';
        } else {
            // Mostrar un mensaje de error
            echo '<script language="javascript">
                    alert("Error al registrar el pedido");
                  </script>';
        }
    }
    
    
    
}