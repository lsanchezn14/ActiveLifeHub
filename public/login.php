<?php
session_start();
require_once "../config/db_connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userInput = $_POST['email'];
    $passInput = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindParam(':email', $userInput);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($passInput, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role'];
        header("Location: home.php");
        exit;
    } else {
        $error = "Invalid email or password.";
    }
}
?>