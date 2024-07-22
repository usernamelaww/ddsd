<?php
// login.php

require 'db.php';

$data = json_decode(file_get_contents("php://input"));
$username = $data->username;
$password = $data->password;

$db = getDB();
$stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
stmt->execute([$username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['password'])) {
    session_start();
    $_SESSION['user_id'] = $user['id'];
    echo json_encode(['message' => 'Login successful']);
} else {
    echo json_encode(['message' => 'Invalid credentials']);
}
?>
