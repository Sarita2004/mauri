<form method="POST" action="remove_stock.php">
    <input type="text" name="nombre" placeholder="Product Name" required>
    <input type="number" name="cantidad" placeholder="Quantity" required>
    <select name="sucursal" required>
        <?php
        $branches = $pdo->query('SELECT * FROM sucursales');
        while ($branch = $branches->fetch()) {
            echo "<option value='{$branch['id_sucursal']}'>{$branch['direccion']}</option>";
        }
        ?>
    </select>
    <input type="date" name="fecha" required>
    <button type="submit">Remove</button>
</form>
