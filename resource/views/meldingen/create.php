<?php require_once __DIR__.'/../../../head.php'; ?>

<!doctype html>
<html lang="nl">

<head>
    <title>Takenlijst | Nieuwe Taak</title>
    <?php require_once __DIR__.'/../../../head.php'; ?>
    <link rel="stylesheet" href="<?php echo $base_url; ?>/css/main.css"> <!-- Voeg hier je CSS-bestand toe -->
</head>

<body>

    <header>
        <img src="<?php echo $base_url; ?>/logo-big-v4.png" alt="Pretpark Logo">
        <a href="<?php echo $base_url; ?>/inloggen" class="btn">Inloggen</a>
    </header>

    <div class="container">
        <h1>Nieuwe taak</h1>

        <form action="<?php echo $base_url; ?>/app/Http/Controllers/takencontroller.php" method="POST">


            <input type="hidden" name="action" value="create">

            <div class="form-group">
                <label for="titel">Naam titel:</label>
                <input type="text" name="titel" id="titel" class="form-input" required>
            </div>

            <div class="form-group">
                <label for="afdeling">Type</label>
                <select name="afdeling" required>
                    <option value="personeel">Personeel</option>
                    <option value="horeca">Horeca</option>
                    <option value="techniek">Techniek</option>
                    <option value="inkoop">Inkoop</option>
                    <option value="klantenservice">Klantenservice</option>
                    <option value="groen">Groen</option>
                    <option value="overig">Overig</option>
                </select>
            </div>

            <div class="form-group">
                <label for="prioriteit">Prioriteit:</label>
                <input type="checkbox" name="prioriteit" id="prioriteit">
                <label for="prioriteit">Is deze taak belangrijk?</label>
            </div>

            <div class="form-group">
                <label for="melder">Naam melder:</label>
                <input type="text" name="melder" id="melder" class="form-input" required>
            </div>

            <div class="form-group">
                <label for="overig">Informatie taak:</label>
                <textarea name="overig" id="overig" class="form-input" rows="4" required></textarea>
            </div>

            <div>
                <input type="submit" value="Maak taak aan" class="btn-submit">
            </div>

        </form>
    </div>

    <footer>
        <p>&copy; 2025 Pretpark Takenlijst</p>
        <p>Jowy, Mohamed, Robin</p>
    </footer>

</body>
</html>
