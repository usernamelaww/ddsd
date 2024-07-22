<?php
// register.php

require 'db.php';

$data = json_decode(file_get_contents("php://input"));
$username = $data->username;
$password = password_hash($data->password, PASSWORD_BCRYPT);

try {
    $db = getDB();
    $stmt = $db->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->execute([$username, $password]);
    echo json_encode(['message' => 'User created successfully!']);
} catch (PDOException $e) {
    echo json_encode(['message' => 'Username already exists']);
}
?>
