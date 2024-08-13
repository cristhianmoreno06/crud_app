<?php

namespace Models;

require_once __DIR__ . '/../config/database.php';

use database;
use PDO;

class Producto
{
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function crear($nombre, $precio, $cantidad) {
        $sql = "INSERT INTO productos (nombre, precio, cantidad) VALUES (:nombre, :precio, :cantidad)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['nombre' => $nombre, 'precio' => $precio, 'cantidad' => $cantidad]);
    }

    public function leerTodos() {
        $sql = "SELECT * FROM productos";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function leerProducto($id)
    {
        $sql = "SELECT * FROM productos WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizar($id, $nombre, $precio, $cantidad) {
        $sql = "UPDATE productos SET nombre = :nombre, precio = :precio, cantidad = :cantidad WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['nombre' => $nombre, 'precio' => $precio, 'cantidad' => $cantidad, 'id' => $id]);
    }

    public function eliminar($id) {
        $sql = "DELETE FROM productos WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    public function valorTotalInventario() {
        $sql = "SELECT SUM(precio * cantidad) as total FROM productos";
        $stmt = $this->db->query($sql);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function productoConMayorValor() {
        $sql = "SELECT nombre, (precio * cantidad) as valor FROM productos ORDER BY valor DESC LIMIT 1";
        $stmt = $this->db->query($sql);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function obtenerCombinacionesProductos($valor) {
        $sql = "SELECT nombre, precio FROM productos";
        $stmt = $this->db->query($sql);
        $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $combinaciones = [];
        $totalCombinaciones = 5;

        foreach ($productos as $i => $producto1) {
            for ($j = $i + 1; $j < count($productos); $j++) {
                $producto2 = $productos[$j];
                $suma = $producto1['precio'] + $producto2['precio'];

                if ($suma <= $valor) {
                    $combinaciones[] = [$producto1['nombre'], $producto2['nombre'], $suma];
                }

                if ($j + 1 < count($productos)) {
                    $producto3 = $productos[$j + 1];
                    $sumaConTres = $suma + $producto3['precio'];

                    if ($sumaConTres <= $valor) {
                        $combinaciones[] = [$producto1['nombre'], $producto2['nombre'], $producto3['nombre'], $sumaConTres];
                    }
                }
            }
        }

        usort($combinaciones, function($a, $b) {
            return $b[count($b) - 1] - $a[count($a) - 1];
        });

        return array_slice($combinaciones, 0, $totalCombinaciones);
    }
}