<!-- app/Views/productos/index.php -->
<?php require __DIR__ . '/../layout/header.php'; ?>

<h1 class="mb-4">Crud App</h1>

<!-- Formulario para ingresar valor -->
<div class="mb-4">
    <h2>Buscar Combinaciones de Productos</h2>
    <form id="combinacionesForm">
        <div class="form-group">
            <label for="valor">Ingresa un valor:</label>
            <input type="number" class="form-control" id="valor" name="valor" required>
        </div>
        <button type="submit" class="btn btn-primary">Obtener Combinaciones</button>
    </form>
    <!-- Modal -->
    <div class="modal fade" id="combinacionesModal" tabindex="-1" role="dialog" aria-labelledby="combinacionesModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="combinacionesModalLabel">Combinaciones de Productos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="resultadoCombinaciones">
                    <!-- Aquí se insertarán las combinaciones -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-6">
        <h2>Valor total del inventario: <span class="badge badge-primary"><?php echo $valorInventario; ?></span></h2>
        <h3>Producto con mayor valor: <span class="badge badge-success"><?php echo $productoMayorValor['nombre'] . " ($" . $productoMayorValor['valor'] . ")"; ?></span></h3>
    </div>
    <div class="col-md-6 text-right">
        <a href="/crud_app/public/index.php?action=create" class="btn btn-primary">Agregar Producto</a>
    </div>
</div>

<table class="table table-bordered table-striped">
    <thead class="thead-dark">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Cantidad</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($productos as $producto): ?>
        <tr>
            <td><?php echo $producto['id']; ?></td>
            <td><?php echo $producto['nombre']; ?></td>
            <td><?php echo $producto['precio']; ?></td>
            <td><?php echo $producto['cantidad']; ?></td>
            <td>
                <a href="/crud_app/public/index.php?action=edit&id=<?php echo $producto['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                <a href="/crud_app/public/index.php?action=delete&id=<?php echo $producto['id']; ?>" class="btn btn-danger btn-sm">Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php require __DIR__ . '/../layout/footer.php'; ?>