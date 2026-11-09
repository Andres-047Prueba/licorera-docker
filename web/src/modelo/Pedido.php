<?php

class Pedido {
    private $NombreDestinatario;
    private $ApellidoDestinatario;
    private $CorreoDestinatario;
    private $CelularDestinatario;
    private $DireccionDestinatario;
    private $OpcionPago;
    private $TotalCompra;
    private $NombreProducto = []; // Array para almacenar los nombres de productos
    private $PrecioProducto = []; // Array para almacenar los precios de los productos
    private $cantidad = []; // Array para almacenar las cantidades de productos

    public function __construct() {

    }

    // SETTERS

    public function setNombreDestinatario($NombreDestinatario) {
        $this->NombreDestinatario = $NombreDestinatario;
    }

    public function setApellidoDestinatario($ApellidoDestinatario) {
        $this->ApellidoDestinatario = $ApellidoDestinatario;
    }

    public function setCorreoDestinatario($CorreoDestinatario) {
        $this->CorreoDestinatario = $CorreoDestinatario;
    }

    public function setCelularDestinatario($CelularDestinatario) {
        $this->CelularDestinatario = $CelularDestinatario;
    }

    public function setDireccionDestinatario($DireccionDestinatario) {
        $this->DireccionDestinatario = $DireccionDestinatario;
    }

    public function setOpcionPago($OpcionPago) {
        $this->OpcionPago = $OpcionPago;
    }

    public function setTotalCompra($TotalCompra) {
        $this->TotalCompra = $TotalCompra;
    }

    // Cambiado para manejar varios productos
    public function setNombreProducto($NombreProducto) {
        if (is_array($NombreProducto)) {
            $this->NombreProducto = $NombreProducto; // Si es un array, asignarlo directamente
        } else {
            $this->NombreProducto[] = $NombreProducto; // Si no, agregar al array
        }
    }
    
    public function setPrecioProducto($PrecioProducto) {
        if (is_array($PrecioProducto)) {
            $this->PrecioProducto = $PrecioProducto; // Si es un array, asignarlo directamente
        } else {
            $this->PrecioProducto[] = $PrecioProducto; // Si no, agregar al array
        }
    }
    
    public function setCantidad($cantidad) {
        if (is_array($cantidad)) {
            $this->cantidad = $cantidad; // Si es un array, asignarlo directamente
        } else {
            $this->cantidad[] = $cantidad; // Si no, agregar al array
        }
    }

    // GETTERS

    public function getNombreDestinatario() {
        return $this->NombreDestinatario;
    }

    public function getApellidoDestinatario() {
        return $this->ApellidoDestinatario;
    }

    public function getCorreoDestinatario() {
        return $this->CorreoDestinatario;
    }

    public function getCelularDestinatario() {
        return $this->CelularDestinatario;
    }

    public function getDireccionDestinatario() {
        return $this->DireccionDestinatario;
    }

    public function getOpcionPago() {
        return $this->OpcionPago;
    }

    public function getTotalCompra() {
        return $this->TotalCompra;
    }

    // Getters para productos
    public function getNombreProducto() {
        return $this->NombreProducto;
    }
    
    public function getPrecioProducto() {
        return $this->PrecioProducto;
    }

    public function getCantidad() {
        return $this->cantidad;
    }
}

?>
