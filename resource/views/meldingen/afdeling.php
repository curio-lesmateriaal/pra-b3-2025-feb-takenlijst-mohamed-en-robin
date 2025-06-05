<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    $msg = "Je moet eerst inloggen!";
    header("Location: ../../../resources/views/login/login.php?msg=" . urlencode($msg));
    exit;
}

require_once '../../../backend/config.php';
require_once '../../../backend/conn.php';

$afdeling = $_GET['afdeling'] ?? '';

if (!$afdeling) {
    die('Geen afdeling opgegeven.');
}

// Query: alleen taken van de opgegeven afdeling, gesorteerd op deadline
$query = "SELECT * FROM taken WHERE afdeling = :afdeling ORDER BY deadline ASC";
$stmt = $pdo->prepare($query);
$stmt->execute([':afdeling' => $afdeling]);
$taken = $stmt->fetchAll();
?>

<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Taken per Afdeling</title>
    <link rel="stylesheet" href="../../../css/main.css">
</head>
<body>

<header>
    <img src="../../../logo-big-v4.png" alt="Pretpark Logo">
    <a href="../../../takenlijst.php">Terug naar overzicht</a> 
</header>

<div class="container">
    <h1>Taken voor afdeling: <?= htmlspecialchars($afdeling) ?></h1>

    <?php if (count($taken) > 0): ?>
        <table class="task-table">
            <thead>
                <tr>
                    <th>Titel</th>
                    <th>Status</th>
                    <th>Deadline</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($taken as $taak): ?>
                    <tr>
                        <td><?= htmlspecialchars($taak['titel']) ?></td>
                        <td><?= htmlspecialchars($taak['status']) ?></td>
                        <td><?= htmlspecialchars($taak['deadline']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Geen taken gevonden voor deze afdeling.</p>
    <?php endif; ?>
</div>

<footer>
    <p>&copy; 2025 Pretpark Takenlijst</p>
</footer>

</body>
</html>
