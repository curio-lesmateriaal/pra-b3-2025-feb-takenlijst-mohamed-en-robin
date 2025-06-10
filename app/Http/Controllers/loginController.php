<?php
session_start();
require_once __DIR__.'/../../../backend/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = :username";
    $statement = $pdo->prepare($query);
    $statement->execute([
        ':username' => $username
    ]);

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if($statement->rowCount() < 1) {
        header("Location: ../../../resource/views/login/login.php?error=Account bestaat niet!");
        exit;
    }

    if(!password_verify($password, $user['password'])) {
        header("Location: ../../../resource/views/login/login.php?error=Wachtwoord niet juist!");
        exit;
    }

    $_SESSION['user_id'] = $user['id'];
    header("Location: http://pra-b3-2025-feb-takenlijst-mohamed-en-robin.test/takenlijst.php");
    exit;
}
