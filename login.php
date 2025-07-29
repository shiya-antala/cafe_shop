<?php
session_start();

// Connect to database
$conn = new mysqli("localhost", "root", "", "cafedb");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form input
$username = $_POST['username'];
$password = $_POST['password'];

// Fetch user by username
$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    // Verify password
    if (password_verify($password, $user['password'])) {
        $_SESSION['username'] = $username;
        echo "<script>alert('Login successful! Redirecting to menu...'); window.location='menu1.php';</script>";
    } else {
        echo "<script>alert('Incorrect password!'); window.location='login.html';</script>";
    }
} else {
    echo "<script>alert('User not found!'); window.location='login.html';</script>";
}

$stmt->close();
$conn->close();
?>
