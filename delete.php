<?php
require 'backend/conn.php'; // Verbind met de database

// Kijk of er een ID is en of het een nummer is
if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
    $sql = "DELETE FROM taken WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_GET['id']]); // Voer de verwijdering uit
}

// Stuur terug naar de hoofdpagina
header("Location: index.php");
exit();
