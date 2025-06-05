<?php
require_once '../../../backend/config.php';
require_once '../../../backend/conn.php';

$afdeling = $_GET['afdeling'] ?? '';
if (!$afdeling) {
    die('Geen afdeling opgegeven.');
}

// Lijst van toegestane afdelingen ter beveiliging
$bekendeAfdelingen = ['personeel', 'horeca', 'techniek', 'inkoop', 'klantenservice', 'groen', 'overig'];
if (!in_array($afdeling, $bekendeAfdelingen)) {
    die('Ongeldige afdeling.');
}

$sql = "SELECT * FROM taken WHERE afdeling = :afdeling AND status <> 'done' ORDER BY deadline ASC";
$stmt = $pdo->prepare($sql);
$stmt->execute([':afdeling' => $afdeling]);
$taken = $stmt->fetchAll();

?>

<!doctype html>
<html lang="nl">
<head>
    <title>Taken Afdeling <?= htmlspecialchars(ucfirst($afdeling)) ?></title>
    <link rel="stylesheet" href="../../../css/main.css">
</head>
<body>
<header>
    <img src="../../../logo-big-v4.png" alt="Pretpark Logo" style="height:50px; vertical-align: middle;">
    <a href="../../../takenlijst.php" style="margin-left: 20px;">Terug naar overzicht</a>
</header>
<div class="container">
    <h1>Taken van afdeling <?= htmlspecialchars(ucfirst($afdeling)) ?></h1>
    <?php if (count($taken) > 0): ?>
        <table border="1" width="100%">
            <thead>
                <tr>
                    <th>Titel</th>
                    <th>Beschrijving</th>
                    <th>Afdeling</th>
                    <th>Status</th>
                    <th>Deadline</th>
                    <th>Actie</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($taken as $taak): ?>
                <tr>
                    <td><?= htmlspecialchars($taak['titel']) ?></td>
                    <td><?= htmlspecialchars($taak['beschrijving']) ?></td>
                    <td><?= htmlspecialchars($taak['afdeling']) ?></td>
                    <td><?= htmlspecialchars($taak['status']) ?></td>
                    <td><?= htmlspecialchars($taak['deadline']) ?></td>
                    <td>
                        <a href="edit.php?id=<?= $taak['id'] ?>">Bewerken</a>
                        <a href="../../../delete.php?id=<?= $taak['id'] ?>" onclick="return confirm('Weet je zeker dat je deze taak wilt verwijderen?')">Verwijderen</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Geen taken gevonden voor deze afdeling.</p>
    <?php endif; ?>
</div>
</body>
</html>
