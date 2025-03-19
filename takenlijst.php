<!doctype html>
<html lang="nl">
 
<head>
    <title>takenlijst</title>
    <?php require_once 'head.php'; ?>
    <link rel="stylesheet" href="css/main.css">
    
</head>
 
<body>
    <header>
        <img src="logo-big-v4.png" alt="">
        <a href="inloggen">inloggen</a>
    </header>
    <main>
        <div class="container">
            <h1>Takenlijst</h1>
            <p>Hieronder staan de taken die momenteel in behandeling zijn of nog gedaan moeten worden:</p>
            
            <?php
            // Verbinding maken met de database
            require 'backend/conn.php';  // Zorg ervoor dat de verbinding goed is ingesteld

            // Controleer de verbinding
            if ($pdo) {
                //echo 'Verbonden met de database!<br>';  // Je kunt deze regel weghalen
            } else {
                echo 'Verbinding mislukt.<br>';
                exit;  // Stop de uitvoering als de verbinding niet werkt
            }

            // De SQL-query om gegevens op te halen, inclusief afdeling
            $sql = "SELECT id, titel, status, afdeling, deadline FROM taken WHERE status <> 'done'";  // Alleen taken met status niet 'done'
            $stmt = $pdo->query($sql);

            // De tabel genereren
            echo "<table border='1' style='width: 100%; border-collapse: collapse;'>";
            echo "<tr><th>Titel</th><th>Status</th><th>Afdeling</th><th>Deadline</th><th>Actie</th></tr>";  // Voeg een kolom voor acties toe

            // Controleer of er gegevens zijn en geef ze weer
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>
                          <td>" . htmlspecialchars($row['titel']) . "</td>
                          <td>" . htmlspecialchars($row['status']) . "</td>
                          <td>" . htmlspecialchars($row['afdeling']) . "</td>
                          <td>" . htmlspecialchars($row['deadline']) . "</td>
                          <td><a href='delete.php?id=" . $row['id'] . "' onclick='return confirm(\"Weet je zeker dat je deze taak wilt verwijderen?\")'>Verwijderen</a></td>
                      </tr>";  // Voeg de verwijderknop toe
            }

            echo "</table>";
            ?>
        </div>
    </main>
    <footer>
        <p>&copy; 2025 Pretpark Takenlijst</p>
        <p>Jowy, Mohamed, Robin</p>
    </footer>
</body>
</html>
