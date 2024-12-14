<?php
require 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Manage Entries</title>
</head>
<body>
    <div class="entries">
        <h2>Available Stock</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Last Update</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $pdo->query('SELECT b.nombre, sb.cantidad, sb.fecha FROM bebidas b JOIN sucursal_bebida sb ON b.id_bebidas = sb.id_bebida');
                while ($row = $stmt->fetch()) {
                    $class = $row['cantidad'] < 100 ? 'low-stock' : '';
                    echo "<tr class='$class'>
                        <td>{$row['nombre']}</td>
                        <td>{$row['cantidad']}</td>
                        <td>{$row['fecha']}</td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>

        <h2>Add Stock</h2>
        <form method="POST" action="add_stock.php">
            <input type="text" name="nombre" placeholder="Product Name" required>
            <select name="categoria" required>
                <?php
                $categories = $pdo->query('SELECT * FROM categoria');
                while ($cat = $categories->fetch()) {
                    echo "<option value='{$cat['id_categoria']}'>{$cat['nombre']}</option>";
                }
                ?>
            </select>
            <input type="text" name="presentacion" placeholder="Presentation" required>
            <input type="date" name="fecha_ingreso" required>
            <button type="submit">Add</button>
        </form>
    </div>
</body>
</html>
