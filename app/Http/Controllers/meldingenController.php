<?php
require_once __DIR__.'/../../../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'create') {
    $titel = $_POST['titel'] ?? '';
    $afdeling = $_POST['afdeling'] ?? '';
    $prioriteit = isset($_POST['prioriteit']) ? 1 : 0;
    $melder = $_POST['melder'] ?? '';
    $overig = $_POST['overig'] ?? '';

    if (!empty($titel) && !empty($melder)) {
        $stmt = $pdo->prepare("INSERT INTO taken (titel, afdeling, prioriteit, melder, overig) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$titel, $afdeling, $prioriteit, $melder, $overig]);

        header("Location: ".$base_url."/takenlijst.php");
        exit;
    } else {
        echo "Vul alle verplichte velden in!";
    }
}
