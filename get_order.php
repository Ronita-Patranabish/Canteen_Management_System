<?php
session_start();
include "db.php";

if(!isset($_SESSION['user'])){
    echo json_encode([]);
    exit();
}

$user = $_SESSION['user'];

$sql = "SELECT * FROM orders WHERE user_name='$user' ORDER BY id DESC";
$result = $conn->query($sql);

$orders = [];

while($row = $result->fetch_assoc()){
    $orders[] = $row;
}

echo json_encode($orders);
?>