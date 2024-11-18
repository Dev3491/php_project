<?php
include('config.php');
$cart = $_SESSION['cart'] ?? [];
$total = array_sum(array_column($cart, 'price'));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Checkout</title>
</head>
<body>
    <div class="container my-4">
        <h1>Checkout</h1>
        <p>Total: $<?= $total ?></p>
        <form action="payment.php" method="post">
            <input type="hidden" name="total" value="<?= $total ?>">
            <button type="submit" class="btn btn-success">Pay Now</button>
        </form>
    </div>
</body>
</html>
