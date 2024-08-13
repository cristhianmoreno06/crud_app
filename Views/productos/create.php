<!-- app/Views/productos/create.php -->
<?php require __DIR__ . '/../layout/header.php'; ?>

<h1 class="mb-4">Agregar Producto</h1>

<form action="index.php" method="post">
    <input type="hidden" name="action" value="store">
    <div class="form-group">
        <label for="nombre">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required>
    </div>
    <div class="form-group">
        <label for="precio">Precio</label>
        <input type="number" class="form-control" id="precio" name="precio" placeholder="Precio" required>
    </div>
    <div class="form-group">
        <label for="cantidad">Cantidad</label>
        <input type="number" class="form-control" id="cantidad" name="cantidad" placeholder="Cantidad" required>
    </div>
    <button type="submit" class="btn btn-success">Agregar</button>
    <a href="/crud_app/public" class="btn btn-secondary">Cancelar</a>
</form>

<?php require __DIR__ . '/../layout/footer.php'; ?>