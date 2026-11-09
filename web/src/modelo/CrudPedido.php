<?php
require_once(__DIR__ . '/Conexion.php');//incluir conexion
class CrudPedido{
    public function __construct(){

    }

    // Guarda el pedido y sus productos en una sola transacción.
    // Devuelve el id del pedido, o false si algo falló.
    public function RegistrarPedidoConProductos($pedido, $nombresProductos, $preciosProductos){
        $basedatos = Conexion::Conectar();

        try {
            $basedatos->beginTransaction();

            $sql = $basedatos->prepare('INSERT INTO pedidos(NombreDestinatario, ApellidoDestinatario, CorreoDestinatario, CelularDestinatario, DireccionDestinatario, OpcionPago, TotalCompra)
                                        VALUES(:NombreDestinatario, :ApellidoDestinatario, :CorreoDestinatario, :CelularDestinatario, :DireccionDestinatario, :OpcionPago, :TotalCompra)');
            $sql->bindValue('NombreDestinatario', $pedido->getNombreDestinatario());
            $sql->bindValue('ApellidoDestinatario', $pedido->getApellidoDestinatario());
            $sql->bindValue('CorreoDestinatario', $pedido->getCorreoDestinatario());
            $sql->bindValue('CelularDestinatario', $pedido->getCelularDestinatario());
            $sql->bindValue('DireccionDestinatario', $pedido->getDireccionDestinatario());
            $sql->bindValue('OpcionPago', $pedido->getOpcionPago());
            $sql->bindValue('TotalCompra', $pedido->getTotalCompra());
            $sql->execute();

            $idPedido = $basedatos->lastInsertId();

            $sql2 = $basedatos->prepare('INSERT INTO productos_pedidos (idPedido, nombreProducto, cantidad, PrecioProducto)
                                         VALUES (:idPedido, :nombreProducto, 1, :PrecioProducto)');
            foreach ($nombresProductos as $index => $nombreProducto) {
                $sql2->bindValue(':idPedido', $idPedido);
                $sql2->bindValue(':nombreProducto', $nombreProducto);
                $sql2->bindValue(':PrecioProducto', $preciosProductos[$index]);
                $sql2->execute();
            }

            $basedatos->commit();
            Conexion::Desconectar($basedatos);
            return $idPedido;

        } catch (Exception $e) {
            if ($basedatos->inTransaction()) {
                $basedatos->rollBack();
            }
            error_log('Error al registrar pedido: ' . $e->getMessage());
            Conexion::Desconectar($basedatos);
            return false;
        }
    }
}
?>
