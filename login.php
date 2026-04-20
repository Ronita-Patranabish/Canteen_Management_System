<?php
session_start(); // 🔥 REQUIRED
include "db.php";

// Get data
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// Validation
if ($email == '' || $password == '') {
    echo "All fields required";
    exit();
}

// Check user
$sql = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    $user = $result->fetch_assoc();

    if (password_verify($password, $user['password'])) {

        // ✅ SAVE SESSION
        $_SESSION['user'] = $user['username'];

        // ✅ REDIRECT TO HOMEPAGE
        header("Location: index.php");
        exit();

    } else {
        echo "Wrong password";
    }

} else {
    echo "User not found";
}

$conn->close();
?>