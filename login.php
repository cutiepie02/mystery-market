<?php
$conn = new mysqli("localhost", "root", "", "mystery_market");

if ($conn->connect_error) {
    die("Connection failed");
}

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    if (password_verify($password, $row['password'])) {
        echo "success";
    } else {
        echo "invalid";
    }
} else {
    echo "invalid";
}

$stmt->close();
$conn->close();
?>