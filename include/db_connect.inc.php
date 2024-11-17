<?php
// db_connect.inc.php
try {
    $conn = new PDO("mysql:host=localhost;dbname=chat_db;charset=utf8", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
