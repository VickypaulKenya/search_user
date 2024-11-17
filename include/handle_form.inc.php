<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once("db_connect.inc.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Debugging statements
    file_put_contents('debug.log', print_r($_POST, true), FILE_APPEND);

    $username = $_POST["username"];
    $email = $_POST["email"];
    $pwd = $_POST["password"];
    $hashed_password = password_hash($pwd, PASSWORD_DEFAULT);
    
    if (empty($username) || empty($email) || empty($pwd)) {
        header("Location: error.php?error=emptyfields&username=" . $username . "&email=" . $email);
        exit();
    }

    // Check if email already exists
    $stmt = $conn->prepare("SELECT COUNT(*) AS count FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $email_exists = $result['count'] > 0;

    if (!$email_exists) {
        try {
            $sql = "INSERT INTO users (username, email, pwd) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$username, $email, $hashed_password]);

            header("Location: ../login.php?signup=success");
            exit();
        } catch (PDOException $th) {
            header("Location: ../error.php?error=sqlerror");
            exit();
        }
    } else {
        echo "Email already exists: " . htmlspecialchars($email);
    }
} else {
    die("Invalid request method.");
}
