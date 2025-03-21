<!doctype html>
<html lang="nl">
<head>
    <title>Takenlijst</title>
    <?php require 'head.php'; ?>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <header>
        <img src="logo-big-v4.png" alt="Pretpark Logo">
        <a href="inloggen">Inloggen</a>
    </header>
    <main>
        <div class="container">
            <h1>Takenlijst</h1>
            <p>Hieronder staan alle taken die gemaakt worden, nog gemaakt moeten worden en gemaakt zijn:</p>
            <a href="resource/views/meldingen/create.php" class="btn">Nieuwe Taak Aanmaken</a> <!-- Knop voor nieuwe taak -->

            <?php
            require 'backend/conn.php';

            $stmt = $pdo->query("SELECT id, titel, status, afdeling, deadline FROM taken");
            
            echo "<table border='1' width='100%'>";
            echo "<tr><th>Titel</th><th>Status</th><th>Afdeling</th><th>Deadline</th><th>Actie</th></tr>";

            while ($row = $stmt->fetch()) {
                echo "<tr>
                        <td>{$row['titel']}</td>
                        <td>{$row['status']}</td>
                        <td>{$row['afdeling']}</td>
                        <td>{$row['deadline']}</td>
                        <td>
                            <a href='delete.php?id={$row['id']}' onclick='return confirm(\"Weet je zeker dat je deze taak wilt verwijderen?\")'>Verwijderen</a>
                            <a href='resource/views/meldingen/edit.php?id={$row['id']}'>Bewerken</a> <!-- Knop voor bewerken -->
                        </td>
                      </tr>";
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
