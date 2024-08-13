<?php

use Controllers\ProductoController;

require_once /** @lang text */__DIR__ . '../../Controllers/ProductoController.php';

$controller = new ProductoController();
//var_dump($_SERVER['REQUEST_METHOD']);
//exit();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['nombre']) && isset($_POST['precio']) && isset($_POST['cantidad']) && $_POST['action'] === 'store') {
        $controller->store($_POST['nombre'], $_POST['precio'], $_POST['cantidad']);
    } elseif (isset($_POST['id']) && isset($_POST['nombre']) && isset($_POST['precio']) && isset($_POST['cantidad']) && $_POST['action'] === 'update') {
        $controller->update($_POST['id'], $_POST['nombre'], $_POST['precio'], $_POST['cantidad']);
    }
} elseif (isset($_GET['id']) || isset($_GET['action'])) {
    if ($_GET['action'] === 'create') {
        $controller->create();
    } elseif ($_GET['action'] === 'edit') {
        $controller->edit($_GET['id']);
    }elseif ($_GET['action'] === 'delete') {
        $controller->delete($_GET['id']);
    }elseif ($_GET['action'] === 'combinations') {
        $controller->obtenerCombinaciones($_GET['value']);
    }
} else {
    $controller->index();
}
