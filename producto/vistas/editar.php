<?php require_once '../../modelo/producto.php'; 
$id = $_GET['id'] ?? null;
$producto = $id ? Producto::obtenerPorId($id) : null;
$titulo = $producto ? 'Editar Producto' : 'Agregar Producto';
$accion = $producto ? 'editar' : 'agregar';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <h1><?php echo $titulo; ?></h1>

                <form method="POST" action="../acciones.php">
                    <input type="hidden" name="accion" value="<?php echo $accion; ?>">
                    <?php if ($producto): ?>
                    <input type="hidden" name="id" value="<?php echo $producto->Id; ?>">
                    <?php endif; ?>

                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="nombre" value="<?php echo $producto ? $producto->Nombre : ''; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Precio</label>
                        <input type="text" class="form-control" name="precio" value="<?php echo $producto ? $producto->Precio : ''; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Stock</label>
                        <input type="text" class="form-control" name="stock" value="<?php echo $producto ? $producto->Stock : ''; ?>" required>
                    </div>

                    <div class="d-grid gap-2 d-sm-flex">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="listar.php" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
