<?php
require_once '../modelo/producto.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? '';
    $nombre = $_POST['nombre'] ?? '';
    $precio = $_POST['precio'] ?? '';
    $stock = $_POST['stock'] ?? '';
    $id = $_POST['id'] ?? '';

    if ($accion === 'agregar') {
        Producto::agregar($nombre, $precio, $stock);
        header('Location: vistas/listar.php');
        exit;
    }

    if ($accion === 'editar') {
        Producto::editar($id, $nombre, $precio, $stock);
        header('Location: vistas/listar.php');
        exit;
    }

    if ($accion === 'eliminar') {
        Producto::eliminar($id);
        header('Location: vistas/listar.php');
        exit;
    }
}
?>
