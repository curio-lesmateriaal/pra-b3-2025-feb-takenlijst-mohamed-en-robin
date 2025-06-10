<?php
session_start();
require 'backend/conn.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: resource/views/login/login.php");
    exit;
}

if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
    $sql = "DELETE FROM taken WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_GET['id']]);
}

header("Location: takenlijst.php");
exit();
