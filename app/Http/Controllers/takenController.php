<?php
// Fouten tonen voor debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__.'/../../../backend/config.php';

// Check of de POST-aanvraag correct is
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'create') {

    // Je code voor het toevoegen van de taak (bijv. invoegen in de database)
    
    // Als alles goed is gegaan, redirect naar de takenlijstpagina
    header('Location: ' . $base_url . '/takenlijst.php');
    exit; // Zorg ervoor dat het script stopt na de redirect
}
?>
