<?php
// Prevent direct access
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: menu1.php");
    exit;
}

$item_names   = $_POST['item_name']   ?? [];
$prices       = $_POST['price']       ?? [];
$quantities   = $_POST['quantity']    ?? [];
$subtotals    = $_POST['subtotal']    ?? [];
$total_amount = $_POST['total_amount'] ?? 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmed</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #fff8e1;">
    <div class="container mt-5 text-center">
        <h2>🎉 Order Confirmed!</h2>
        <p class="mb-4">You have successfully ordered the following items:</p>

        <table class="table table-bordered w-75 mx-auto">
            <thead class="table-success">
                <tr>
                    <th>Item</th>
                    <th>Price (₹)</th>
                    <th>Quantity</th>
                    <th>Subtotal (₹)</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($item_names as $i => $name): ?>
                    <tr>
                        <td><?= htmlspecialchars($name) ?></td>
                        <td><?= htmlspecialchars($prices[$i]) ?></td>
                        <td><?= htmlspecialchars($quantities[$i]) ?></td>
                        <td><?= htmlspecialchars($subtotals[$i]) ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr class="table-secondary">
                    <th colspan="3">Total Paid</th>
                    <th>₹<?= htmlspecialchars($total_amount) ?></th>
                </tr>
            </tbody>
        </table>

        <a href="menu1.php" class="btn btn-success mt-3">Back to Menu</a>
    </div>
</body>
</html>
