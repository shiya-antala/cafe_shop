<?php
// Get arrays from POST
$item_names = $_POST['item_name'];
$prices = $_POST['price'];
$quantities = $_POST['quantity'];

$total_amount = 0;
$bill_items = [];

// Loop through the submitted items
foreach ($item_names as $index => $name) {
    $qty = (int)$quantities[$index];
    $price = (float)$prices[$index];

    if ($qty > 0) {
        $subtotal = $price * $qty;
        $total_amount += $subtotal;

        $bill_items[] = [
            'name' => $name,
            'price' => $price,
            'quantity' => $qty,
            'subtotal' => $subtotal
        ];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Billing - Cafe Delight</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #fff8e1;">
    <div class="container mt-5">
        <h2 class="text-center">Billing Summary</h2>
        <table class="table table-bordered mt-4">
            <thead class="table-warning">
                <tr>
                    <th>Item</th>
                    <th>Price (₹)</th>
                    <th>Quantity</th>
                    <th>Subtotal (₹)</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bill_items as $item): ?>
                    <tr>
                        <td><?php echo $item['name']; ?></td>
                        <td><?php echo $item['price']; ?></td>
                        <td><?php echo $item['quantity']; ?></td>
                        <td><?php echo $item['subtotal']; ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr class="table-secondary">
                    <th colspan="3">Total</th>
                    <th>₹<?php echo $total_amount; ?></th>
                </tr>
            </tbody>
        </table>

        <form action="confirm.php" method="post">
            <?php foreach ($bill_items as $item): ?>
                <input type="hidden" name="item_name[]" value="<?php echo $item['name']; ?>">
                <input type="hidden" name="price[]" value="<?php echo $item['price']; ?>">
                <input type="hidden" name="quantity[]" value="<?php echo $item['quantity']; ?>">
                <input type="hidden" name="subtotal[]" value="<?php echo $item['subtotal']; ?>">
            <?php endforeach; ?>
            <input type="hidden" name="total_amount" value="<?php echo $total_amount; ?>">

            <div class="text-center">
                <button class="btn btn-success mt-4">Confirm Order</button>
            </div>
        </form>
    </div>
</body>
</html>
