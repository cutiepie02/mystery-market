<?php
$conn = new mysqli("localhost", "root", "", "mystery_market");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

// ✅ Hash the password before saving
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// ✅ Prepared statement — no SQL injection possible
$stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $email, $hashedPassword);

if ($stmt->execute()) {
    echo "success";
} else {
    echo "ERROR: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>