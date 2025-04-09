<?php require_once __DIR__.'/../../../backend/config.php'; ?>
<!doctype html>
<html lang="nl">

<head>
    <title>Takenlijst | Bewerk Taak</title>
    <?php require_once '../../../head.php'; ?>
    <link rel="stylesheet" href="../../../css/main.css">
</head>

<body>
    <header>
        <img src="../../../logo-big-v4.png" alt="Pretpark Logo">
        <a href="../../../resources/views/login/login.php">Inloggen</a>
    </header>

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

        <form action="../../../app/Http/Controllers/takenController.php" method="POST">
            <input type="hidden" name="action" value="edit">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($task['id']); ?>">

            <div class="form-group">
                <label for="titel">Naam titel:</label>
                <input type="text" name="titel" id="titel" class="form-input" value="<?php echo htmlspecialchars($task['titel']); ?>" required>
            </div>

            <div class="form-group">
                <label for="afdeling">Afdeling:</label>
                <select name="afdeling" required>
                    <option value="personeel" <?php if ($task['afdeling'] == 'personeel') echo 'selected'; ?>>Personeel</option>
                    <option value="horeca" <?php if ($task['afdeling'] == 'horeca') echo 'selected'; ?>>Horeca</option>
                    <option value="techniek" <?php if ($task['afdeling'] == 'techniek') echo 'selected'; ?>>Techniek</option>
                    <option value="inkoop" <?php if ($task['afdeling'] == 'inkoop') echo 'selected'; ?>>Inkoop</option>
                    <option value="klantenservice" <?php if ($task['afdeling'] == 'klantenservice') echo 'selected'; ?>>Klantenservice</option>
                    <option value="groen" <?php if ($task['afdeling'] == 'groen') echo 'selected'; ?>>Groen</option>
                    <option value="overig" <?php if ($task['afdeling'] == 'overig') echo 'selected'; ?>>Overig</option>
                </select>
            </div>

            <div class="form-group">
                <label for="beschrijving">Beschrijving taak:</label>
                <textarea name="beschrijving" id="beschrijving" class="form-input" rows="4" required><?php echo htmlspecialchars($task['beschrijving']); ?></textarea>
            </div>

            <div class="form-group">
                <label for="status">Status:</label>
                <select name="status" id="status" required>
                    <option value="open" <?php if ($task['status'] == 'open') echo 'selected'; ?>>Open</option>
                    <option value="in_progress" <?php if ($task['status'] == 'in_progress') echo 'selected'; ?>>In Progress</option>
                    <option value="closed" <?php if ($task['status'] == 'closed') echo 'selected'; ?>>Closed</option>
                </select>
            </div>

            <div class="form-group">
                <label for="deadline">Deadline:</label>
                <input type="date" name="deadline" id="deadline" class="form-input" value="<?php echo htmlspecialchars($task['deadline']); ?>" required>
            </div>

            <div>
                <input type="submit" value="Update taak" class="btn-submit">
            </div>
        </form>
    </div>

    <footer>
        <p>&copy; 2025 Pretpark Takenlijst</p>
        <p>Jowy, Mohamed, Robin</p>
    </footer>
</body>
</html>
