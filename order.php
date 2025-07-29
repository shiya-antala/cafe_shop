<?php
$conn = mysqli_connect("localhost", "root", "", "cafedb");

$item_id = $_GET['item_id'];
$result = mysqli_query($conn, "SELECT * FROM menu WHERE item_id = $item_id");
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Place Order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #fff8e1;">
    <div class="container mt-5">
        <h2 class="text-center">Order: <?php echo $row['item_name']; ?></h2>
        <form action="billing.php" method="post" class="mt-4">
            <input type="hidden" name="item_id" value="<?php echo $row['item_id']; ?>">
            <input type="hidden" name="item_name" value="<?php echo $row['item_name']; ?>">
            <input type="hidden" name="price" value="<?php echo $row['price']; ?>">

            <div class="mb-3">
                <label class="form-label">Quantity:</label>
                <input type="number" name="quantity" class="form-control" required min="1">
            </div>
            <button type="submit" class="btn btn-success w-100">Proceed to Billing</button>
        </form>
    </div>
</body>
</html>
