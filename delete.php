<?php
require 'backend/conn.php';

if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
    $sql = "DELETE FROM taken WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_GET['id']]);
}

header("Location: takenlijst.php");
exit();
