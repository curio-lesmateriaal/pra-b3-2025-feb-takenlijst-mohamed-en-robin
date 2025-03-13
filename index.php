<?php
// Verbinding maken met de database
require 'backend/conn.php';  // Zorg ervoor dat de verbinding goed is ingesteld

// Controleer de verbinding
if ($pdo) {
    echo 'Verbonden met de database!<br>';
} else {
    echo 'Verbinding mislukt.<br>';
    exit;  // Stop de uitvoering als de verbinding niet werkt
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Takenlijst</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Takenlijst</h1>
    </header>
    <main>
        <h2>Mijn Taken</h2>
        <p>Hieronder staan de taken die momenteel in behandeling zijn of nog gedaan moeten worden:</p>
        
        <?php
        // De SQL-query om gegevens op te halen, inclusief afdeling
        $sql = "SELECT titel, status, afdeling, deadline FROM taken WHERE status <> 'done'";  // Alleen taken met status niet 'done'
        $stmt = $pdo->query($sql);
        
        // De tabel genereren
        echo "<table border='1'>";
        echo "<tr><th>Titel</th><th>Status</th><th>Afdeling</th><th>Deadline</th></tr>";  // Voeg afdeling toe als kolom
        
        // Controleer of er gegevens zijn en geef ze weer
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr><td>" . htmlspecialchars($row['titel']) . "</td>
                      <td>" . htmlspecialchars($row['status']) . "</td>
                      <td>" . htmlspecialchars($row['afdeling']) . "</td>
                      <td>" . htmlspecialchars($row['deadline']) . "</td></tr>";  // Toon de datum in de tabel
        }
        
        echo "</table>";
        ?>
    </main>
    <footer>
        <p>&copy; 2025 Takenlijst</p>
    </footer>
</body>
</html>
