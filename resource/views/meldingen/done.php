<?php 
require_once __DIR__ . '/../../../backend/config.php';
require_once __DIR__ . '/../../../backend/conn.php';
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <title>Takenlijst | Voltooide Taken</title>
    <?php require_once '../../../head.php'; ?>
    <link rel="stylesheet" href="../../../css/main.css">
</head>
<body>
    <div class="container">
        <h1>Voltooide Taken</h1>

        <?php
        // SQL-query om alle taken met de status "done" op te halen
        $sql = "SELECT titel, afdeling FROM taken WHERE status = 'done'";

        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($tasks) > 0) {
                echo "<ul>";
                foreach ($tasks as $task) {
                    echo "<li><strong>" . htmlspecialchars($task['titel']) . "</strong> - " . htmlspecialchars($task['afdeling']) . "</li>";
                }
                echo "</ul>";
            } else {
                echo "<p>Er zijn geen voltooide taken.</p>";
            }
        } catch (PDOException $e) {
            echo "Fout bij het ophalen van de voltooide taken: " . $e->getMessage();
        }
        ?>

        <p><a href="index.php">Terug naar het overzicht</a></p>
    </div>
</body>
</html>
