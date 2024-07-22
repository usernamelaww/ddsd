<?php
// create_key.php

require 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['message' => 'Unauthorized']);
    exit();
}

$data = json_decode(file_get_contents("php://input"));
$key = $data->key;
$expires_at = $data->expires_at ? date('Y-m-d H:i:s', strtotime($data->expires_at)) : null;

$db = getDB();
$stmt = $db->prepare("INSERT INTO keys (key, expires_at) VALUES (?, ?)");
$stmt->execute([$key, $expires_at]);

echo json_encode(['message' => 'Key created successfully!']);
?>
