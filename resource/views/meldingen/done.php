<?php
require_once __DIR__ . '/../../../backend/config.php';
require_once __DIR__ . '/../../../backend/conn.php';

$sql = "SELECT * FROM taken WHERE status = 'done'";
$stmt = $pdo->query($sql);
$taken = $stmt->fetchAll();

?>

<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voltooide Taken</title>
    <link rel="stylesheet" href="../../../css/main.css"> 
</head>
<body>

    <header>
        <img src="../../../logo-big-v4.png" alt="Pretpark Logo">
        <a href="../../../takenlijst.php">Terug naar overzicht</a> 
    </header>

    <div class="container">
        <h1>Voltooide Taken</h1>

        <?php if (count($taken) > 0): ?>
            <table class="task-table">
                <thead>
                    <tr>
                        <th>Titel</th>
                        <th>Afdeling</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($taken as $taak): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($taak['titel']); ?></td>
                            <td><?php echo htmlspecialchars($taak['afdeling']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Er zijn geen voltooide taken.</p>
        <?php endif; ?>

    </div>

    <footer>
        <p>&copy; 2025 Pretpark Takenlijst</p>
    </footer>

</body>
</html>
