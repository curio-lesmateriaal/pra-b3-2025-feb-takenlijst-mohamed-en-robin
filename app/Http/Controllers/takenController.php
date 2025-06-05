<?php
require_once __DIR__ . '/../../../backend/config.php';
require_once __DIR__ . '/../../../backend/conn.php';

// === HULPFUNCTIE: Redirect met foutmelding ===
function redirectWithError($message) {
    echo $message;
    exit;
}

// === TAAK AANMAKEN ===
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'create') {
    $titel = $_POST['titel'] ?? '';
    $beschrijving = $_POST['beschrijving'] ?? '';
    $afdeling = $_POST['afdeling'] ?? '';
    $deadline = $_POST['deadline'] ?? '';
    $status = 'to do'; // standaardstatus

    if (empty($titel) || empty($beschrijving) || empty($afdeling) || empty($deadline)) {
        redirectWithError("Alle velden moeten ingevuld zijn!");
    }

    $sql = "INSERT INTO taken (titel, beschrijving, afdeling, status, deadline)
            VALUES (:titel, :beschrijving, :afdeling, :status, :deadline)";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':titel' => $titel,
            ':beschrijving' => $beschrijving,
            ':afdeling' => $afdeling,
            ':status' => $status,
            ':deadline' => $deadline
        ]);
        header("Location: {$base_url}/takenlijst.php?success=1");
        exit;
    } catch (PDOException $e) {
        redirectWithError("Fout bij het toevoegen van de taak: " . $e->getMessage());
    }
}

// === TAAK BEWERKEN ===
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'edit') {
    $id = $_POST['id'] ?? '';
    $titel = $_POST['titel'] ?? '';
    $beschrijving = $_POST['beschrijving'] ?? '';
    $afdeling = $_POST['afdeling'] ?? '';
    $status = $_POST['status'] ?? '';
    $deadline = $_POST['deadline'] ?? '';

    if (empty($id) || empty($titel) || empty($beschrijving) || empty($afdeling) || empty($status) || empty($deadline)) {
        redirectWithError("Alle velden moeten ingevuld zijn!");
    }

    $sql = "UPDATE taken 
            SET titel = :titel, beschrijving = :beschrijving, afdeling = :afdeling, status = :status, deadline = :deadline 
            WHERE id = :id";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':id' => $id,
            ':titel' => $titel,
            ':beschrijving' => $beschrijving,
            ':afdeling' => $afdeling,
            ':status' => $status,
            ':deadline' => $deadline
        ]);
        header("Location: {$base_url}/takenlijst.php?success=1");
        exit;
    } catch (PDOException $e) {
        redirectWithError("Fout bij het bijwerken van de taak: " . $e->getMessage());
    }
}
