<?php
// get_keys.php

require 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['message' => 'Unauthorized']);
    exit();
}

$db = getDB();
$stmt = $db->query("SELECT * FROM keys");
$keys = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($keys);
?>
