<?php
$conn = new mysqli("localhost", "root", "", "cafedb");

$result = $conn->query("SELECT * FROM orders");

$orders = [];
while ($row = $result->fetch_assoc()) {
    $orders[] = $row;
}

file_put_contents("orders.json", json_encode($orders, JSON_PRETTY_PRINT));
echo "orders.json file created successfully!";
?>
