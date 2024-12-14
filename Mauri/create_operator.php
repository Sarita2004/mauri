<?php
require 'db.php';

function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_operator'])) {
    $username = $_POST['username'];
    $password = hashPassword($_POST['password']);

    $stmt = $pdo->prepare('INSERT INTO operators (username, password) VALUES (?, ?)');
    $stmt->execute([$username, $password]);

    $success = "Operator created successfully.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Create Operator</title>
</head>
<body>
    <div class="operator-container">
        <h1>Create Operator</h1>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="create_operator">Create</button>
        </form>
        <?php if (isset($success)) echo "<p class='success'>$success</p>"; ?>
    </div>
</body>
</html>
