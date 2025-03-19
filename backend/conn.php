<?php
$host = 'localhost'; // Gebruik hier de juiste host
$dbname = 'takenlijst mohamed en robin'; // De naam van je database. naam van jowy zit er niet bij doordat hij gemaakt was toen hij er niet was
$username = 'root'; // Je database gebruikersnaam
$password = ''; // Je database wachtwoord

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Verbinding mislukt: " . $e->getMessage());
}
?>
