<?php 
require_once __DIR__ . '/../../../backend/config.php';  
require_once __DIR__ . '/../../../backend/conn.php';

// Haal alle taken op met de status 'done'
$sql = "SELECT titel, afdeling FROM taken WHERE status = 'closed'";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$taken = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="nl">
<head>
    <title>Takenlijst | Voltooide Taken</title>
    <?php require_once '../../../head.php'; ?> 
    <link rel="stylesheet" href="../../../css/main.css"> 
</head>
<body>

    <header>
        <img src="../../../logo-big-v4.png" alt="Pretpark Logo"> 
        <a href="../../../resources/views/login/login.php">Inloggen</a> 
    </header>

    <div class="container">
        <h1>Voltooide Taken</h1>

        <p><a href="../../../resources/views/tasks/index.php">Terug naar alle taken</a></p>

        <table class="task-table">
            <thead>
                <tr>
                    <th>Titel</th>
                    <th>Afdeling</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($taken as $task): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($task['titel']); ?></td>
                        <td><?php echo htmlspecialchars($task['afdeling']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <footer>
        <p>&copy; 2025 Pretpark Takenlijst</p>
        <p>Jowy, Mohamed, Robin</p>
    </footer>

</body>
</html>
