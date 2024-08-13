<?php

namespace Controllers;

require_once __DIR__ . '/../Models/Producto.php';

use Models\Producto;

class ProductoController
{
    private $productoModel;

    public function __construct() {
        $this->productoModel = new Producto();
    }

    public function index() {
        $productos = $this->productoModel->leerTodos();
        $valorInventario = $this->productoModel->valorTotalInventario();
        $productoMayorValor = $this->productoModel->productoConMayorValor();
        require __DIR__ . '/../Views/productos/index.php';
    }

    public function create() {
        require __DIR__ . '/../Views/productos/create.php';
    }

    public function store($nombre, $precio, $cantidad) {
        $this->productoModel->crear($nombre, $precio, $cantidad);
        header('Location: /crud_app/public');
    }

    public function edit($id) {
        $producto = $this->productoModel->leerProducto($id);
        require __DIR__ . '/../Views/productos/edit.php';
    }

    public function update($id, $nombre, $precio, $cantidad) {
        $this->productoModel->actualizar($id, $nombre, $precio, $cantidad);
        header('Location: /crud_app/public');
    }

    public function delete($id) {
        $this->productoModel->eliminar($id);
        header('Location: /crud_app/public');
    }

    public function obtenerCombinaciones($valor) {
        $combinaciones = $this->productoModel->obtenerCombinacionesProductos($valor);
        header('Content-Type: application/json');
        echo json_encode($combinaciones);
        exit;
    }
}