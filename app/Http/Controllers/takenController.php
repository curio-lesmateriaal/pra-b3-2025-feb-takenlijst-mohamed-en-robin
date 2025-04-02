<?php
require_once __DIR__ . '/../../../backend/config.php';  // Correct pad naar config.php
require_once __DIR__ . '/../../../backend/conn.php';    // Correct pad naar conn.php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'create') {
    // Haal de gegevens uit het formulier
    if (isset($_POST['titel'], $_POST['beschrijving'], $_POST['afdeling'], $_POST['status'], $_POST['deadline'])) {
        $titel = $_POST['titel'];
        $beschrijving = $_POST['beschrijving'];
        $afdeling = $_POST['afdeling'];
        $status = $_POST['status'];
        $deadline = $_POST['deadline'];

        // Controleer of alle velden correct zijn ingevuld
        if (empty($titel) || empty($beschrijving) || empty($afdeling) || empty($status) || empty($deadline)) {
            echo "Alle velden moeten ingevuld zijn!";
            exit();
        }

        // Bereid de SQL-query voor het invoegen van de taak
        $sql = "INSERT INTO taken (titel, beschrijving, afdeling, status, deadline) VALUES (:titel, :beschrijving, :afdeling, :status, :deadline)";

        try {
            $stmt = $pdo->prepare($sql);

            // Bind de waarden aan de SQL-query
            $stmt->bindParam(':titel', $titel);
            $stmt->bindParam(':beschrijving', $beschrijving);
            $stmt->bindParam(':afdeling', $afdeling);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':deadline', $deadline);

            // Voer de query uit
            $stmt->execute();

            // Redirect naar het takenoverzicht na succesvolle toevoeging
            header('Location: ' . $base_url . '/takenlijst.php');
            exit(); // Zorg ervoor dat de uitvoering stopt na de redirect
        } catch (PDOException $e) {
            // Foutmelding bij mislukking
            echo "Fout bij het toevoegen van de taak: " . $e->getMessage();
        }
    } else {
        echo "Niet alle velden zijn ontvangen!";
    }
}
?>
