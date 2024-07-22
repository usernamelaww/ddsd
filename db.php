<?php
// db.php

function getDB() {
    $db = new PDO('sqlite:keys.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $db;
}
?>
