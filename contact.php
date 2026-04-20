<?php
include "db.php";

// Get form data safely
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';
$message = $_POST['message'] ?? '';

// Validation
if ($name == '' || $email == '' || $phone == '' || $message == '') {
    echo "<script>
        alert('All fields are required!');
        window.location.href='index.php#contact';
    </script>";
    exit();
}

// Insert into database
$sql = "INSERT INTO contact_messages (name, email, phone, message)
        VALUES ('$name', '$email', '$phone', '$message')";

if ($conn->query($sql)) {

    echo "<script>
        alert('Message sent successfully!');
        window.location.href='index.php#contact';
    </script>";

} else {

    echo "<script>
        alert('Error sending message!');
        window.location.href='index.php#contact';
    </script>";

}

$conn->close();
?>