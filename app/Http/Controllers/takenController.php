<?php
require_once __DIR__ . '/../../../backend/config.php';
require_once __DIR__ . '/../../../backend/conn.php';

// TAAL: NIEUWE TAAK AANMAKEN
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'create') {
    if (isset($_POST['titel'], $_POST['beschrijving'], $_POST['afdeling'], $_POST['deadline'])) {
        $titel = $_POST['titel'];
        $beschrijving = $_POST['beschrijving'];
        $afdeling = $_POST['afdeling'];
        $deadline = $_POST['deadline'];
        $status = 'todo'; // Automatisch op 'todo'

        // Validatie
        if (empty($titel) || empty($beschrijving) || empty($afdeling) || empty($deadline)) {
            echo "Alle velden moeten ingevuld zijn!";
            exit();
        }

        $sql = "INSERT INTO taken (titel, beschrijving, afdeling, status, deadline)
                VALUES (:titel, :beschrijving, :afdeling, :status, :deadline)";

        try {
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':titel', $titel);
            $stmt->bindParam(':beschrijving', $beschrijving);
            $stmt->bindParam(':afdeling', $afdeling);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':deadline', $deadline);
            $stmt->execute();

            header('Location: http://pra-b3-2025-feb-takenlijst-mohamed-en-robin.test/takenlijst.php?success=1');
            exit();
        } catch (PDOException $e) {
            echo "Fout bij het toevoegen van de taak: " . $e->getMessage();
        }
    } else {
        echo "Niet alle velden zijn ontvangen!";
    }
}

// TAAK BEWERKEN
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'edit') {
    if (isset($_POST['id'], $_POST['titel'], $_POST['beschrijving'], $_POST['afdeling'], $_POST['status'], $_POST['deadline'])) {
        $id = $_POST['id'];
        $titel = $_POST['titel'];
        $beschrijving = $_POST['beschrijving'];
        $afdeling = $_POST['afdeling'];
        $status = $_POST['status'];
        $deadline = $_POST['deadline'];

        try {
            $sql = "UPDATE taken SET titel = :titel, beschrijving = :beschrijving, 
                    afdeling = :afdeling, status = :status, deadline = :deadline 
                    WHERE id = :id";
            
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':id' => $id,
                ':titel' => $titel,
                ':beschrijving' => $beschrijving,
                ':afdeling' => $afdeling,
                ':status' => $status,
                ':deadline' => $deadline
            ]);

            header('Location: http://pra-b3-2025-feb-takenlijst-mohamed-en-robin.test/takenlijst.php?success=1');
            exit();
        } catch (PDOException $e) {
            echo "Fout bij het bijwerken van de taak: " . $e->getMessage();
        }
    }
}
