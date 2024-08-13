<!-- app/Views/productos/edit.php -->
<?php require __DIR__ . '/../layout/header.php'; ?>

<h1 class="mb-4">Editar Producto</h1>

<form action="index.php" method="post">
    <input type="hidden" name="action" value="update">
    <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">
    <div class="form-group">
        <label for="nombre">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $producto['nombre']; ?>" required>
    </div>
    <div class="form-group">
        <label for="precio">Precio</label>
        <input type="number" class="form-control" id="precio" name="precio" value="<?php echo $producto['precio']; ?>" required>
    </div>
    <div class="form-group">
        <label for="cantidad">Cantidad</label>
        <input type="number" class="form-control" id="cantidad" name="cantidad" value="<?php echo $producto['cantidad']; ?>" required>
    </div>
    <button type="submit" class="btn btn-warning">Actualizar</button>
    <a href="/crud_app/public" class="btn btn-secondary">Cancelar</a>
</form>

<?php require __DIR__ . '/../layout/footer.php'; ?>