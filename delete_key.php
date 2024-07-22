<?php
// delete_key.php

require 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['message' => 'Unauthorized']);
    exit();
}

$key_id = $_GET['key_id'];

$db = getDB();
$stmt = $db->prepare("DELETE FROM keys WHERE id = ?");
$stmt->execute([$key_id]);

echo json_encode(['message' => 'Key deleted successfully!']);
?>
