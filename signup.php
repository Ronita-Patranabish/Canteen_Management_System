<?php
include "db.php";
session_start();

// Get form data
$username = trim($_POST['username'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

// Validation
if ($username == '' || $email == '' || $password == '') {
    echo "<script>
        alert('All fields are required!');
        window.location.href = 'signup.html';
    </script>";
    exit();
}

// Check if user already exists
$check = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($check);

if ($result->num_rows > 0) {
    echo "<script>
        alert('User already exists!');
        window.location.href = 'login.html';
    </script>";
    exit();
}

// Hash password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Insert user into database
$sql = "INSERT INTO users (username, email, password)
        VALUES ('$username', '$email', '$hashedPassword')";

if ($conn->query($sql) === TRUE) {

    // Optional: auto login after signup
    $_SESSION['user'] = $username;

    echo "<script>
        alert('Signup successful!');
        window.location.href = 'index.php';
    </script>";

} else {
    echo "<script>
        alert('Error during signup!');
        window.location.href = 'signup.html';
    </script>";
}

$conn->close();
?>