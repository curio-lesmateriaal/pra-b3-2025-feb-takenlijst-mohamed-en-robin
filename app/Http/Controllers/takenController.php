<?php
require_once __DIR__ . '/../../../backend/config.php';
require_once __DIR__ . '/../../../backend/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'create') {
    if (isset($_POST['titel'], $_POST['beschrijving'], $_POST['afdeling'], $_POST['status'], $_POST['deadline'])) {
        $titel = $_POST['titel'];
        $beschrijving = $_POST['beschrijving'];
        $afdeling = $_POST['afdeling'];
        $status = $_POST['status'];
        $deadline = $_POST['deadline'];

        if (empty($titel) || empty($beschrijving) || empty($afdeling) || empty($status) || empty($deadline)) {
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

            // Gebruik de basis-URL uit config.php voor de redirect
            header('Location: ' . $base_url . '/takenlijst.php?success=1');
            exit();
        } catch (PDOException $e) {
            echo "Fout bij het toevoegen van de taak: " . $e->getMessage();
        }
    } else {
        echo "Niet alle velden zijn ontvangen!";
    }
}
