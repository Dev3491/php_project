<?php
include('config.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate the ID
    if (isset($_POST['id']) && is_numeric($_POST['id'])) {
        $id = intval($_POST['id']);

        // Use a prepared statement to safely fetch the product
        $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $product = $result->fetch_assoc();

            // Add the product to the session cart
            $_SESSION['cart'][] = $product;
        }
    } else {
        echo "Invalid product ID.";
    }
}

// Retrieve the cart from the session
$cart = $_SESSION['cart'] ?? [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Cart</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">E-Commerce</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php">Cart</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-4">
        <h1>Shopping Cart</h1>
        <ul class="list-group">
            <?php if (!empty($cart)): ?>
                <?php foreach ($cart as $item): ?>
                    <li class="list-group-item">
                        <?= htmlspecialchars($item['name']) ?> - $<?= htmlspecialchars($item['price']) ?>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center">Your cart is empty.</p>
            <?php endif; ?>
        </ul>
        <a href="checkout.php" class="btn btn-primary mt-3">Proceed to Checkout</a>
    </div>
</body>
</html>
