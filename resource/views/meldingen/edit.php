<?php require_once __DIR__.'/../../../backend/config.php'; ?>
<!doctype html>
<html lang="nl">

<head>
    <title>Takenlijst | Bewerk Taak</title>
    <?php require_once __DIR__.'/../../../head.php'; ?>
</head>

<body>

    <div class="container">
        <h1>Bewerk taak</h1>

        <?php
        require __DIR__.'/../../../backend/conn.php';
        $id = $_GET['id'];
        $sql = "SELECT * FROM taken WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        $task = $stmt->fetch(PDO::FETCH_ASSOC);
        ?>

        <form action="<?php echo $base_url; ?>/app/Http/Controllers/meldingenController.php" method="POST">

            <input type="hidden" name="action" value="edit">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($task['id']); ?>">

            <div class="form-group">
                <label for="titel">Naam titel:</label>
                <input type="text" name="titel" id="titel" class="form-input" value="<?php echo htmlspecialchars($task['titel'] ?? ''); ?>">
            </div>

            <div class="form-group">
                <label for="afdeling">Type</label>
                <select name="afdeling">
                    <option value="personeel" <?php if (isset($task['afdeling']) && $task['afdeling'] == 'personeel') echo 'selected'; ?>>Personeel</option>
                    <option value="horeca" <?php if (isset($task['afdeling']) && $task['afdeling'] == 'horeca') echo 'selected'; ?>>Horeca</option>
                    <option value="techniek" <?php if (isset($task['afdeling']) && $task['afdeling'] == 'techniek') echo 'selected'; ?>>Techniek</option>
                    <option value="inkoop" <?php if (isset($task['afdeling']) && $task['afdeling'] == 'inkoop') echo 'selected'; ?>>Inkoop</option>
                    <option value="klantenservice" <?php if (isset($task['afdeling']) && $task['afdeling'] == 'klantenservice') echo 'selected'; ?>>Klantenservice</option>
                    <option value="groen" <?php if (isset($task['afdeling']) && $task['afdeling'] == 'groen') echo 'selected'; ?>>Groen</option>
                    <option value="overig" <?php if (isset($task['afdeling']) && $task['afdeling'] == 'overig') echo 'selected'; ?>>Overig</option>
                </select>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select name="status">
                    <option value="open" <?php if (isset($task['status']) && $task['status'] == 'open') echo 'selected'; ?>>Open</option>
                    <option value="in_progress" <?php if (isset($task['status']) && $task['status'] == 'in_progress') echo 'selected'; ?>>In Progress</option>
                    <option value="done" <?php if (isset($task['status']) && $task['status'] == 'done') echo 'selected'; ?>>Done</option>
                </select>
            </div>

            <div class="form-group">
                <label for="prioriteit">Prioriteit:</label>
                <input type="checkbox" name="prioriteit" id="prioriteit" <?php echo isset($task['prioriteit']) && $task['prioriteit'] ? 'checked' : ''; ?>>
                <label for="prioriteit">Is deze taak belangrijk?</label>
            </div>

            <div class="form-group">
                <label for="melder">Naam melder:</label>
                <input type="text" name="melder" id="melder" class="form-input" value="<?php echo htmlspecialchars($task['melder'] ?? ''); ?>">
            </div>

            <div class="form-group">
                <label for="overig">Informatie taak:</label>
                <textarea name="overig" id="overig" class="form-input" rows="4"><?php echo htmlspecialchars($task['overig'] ?? ''); ?></textarea>
            </div>

            <div>
                <input type="submit" value="Update taak">
            </div>
        </form>
    </div>

</body>
</html>
