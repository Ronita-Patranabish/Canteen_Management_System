<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "db.php";

header('Content-Type: application/json');

// Read JSON from frontend
$data = json_decode(file_get_contents("php://input"), true);

$items = $data['items'] ?? [];
$total = $data['total'] ?? 0;

// CHECK LOGIN
if (!isset($_SESSION['user'])) {
    echo json_encode([
        "success" => false,
        "message" => "User not logged in"
    ]);
    exit();
}

$username = $_SESSION['user'];

// VALIDATE CART
if (empty($items)) {
    echo json_encode([
        "success" => false,
        "message" => "Cart is empty"
    ]);
    exit();
}

// INSERT INTO ORDERS TABLE
$sql = "INSERT INTO orders (user_name, total, created_at)
        VALUES ('$username', '$total', NOW())";

if ($conn->query($sql) === TRUE) {

    $order_id = $conn->insert_id;

    // INSERT ITEMS INTO order_items
    foreach ($items as $item) {

        $name = $item['item'];
        $price = $item['price'];
        $qty = $item['qty'];

        $conn->query("INSERT INTO order_items (order_id, item_name, price, quantity)
                      VALUES ('$order_id', '$name', '$price', '$qty')");
    }

    echo json_encode([
        "success" => true,
        "order_id" => $order_id
    ]);

} else {

    echo json_encode([
        "success" => false,
        "message" => $conn->error
    ]);
}

$conn->close();
?>