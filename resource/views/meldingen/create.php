<?php require_once __DIR__.'/../../../config/config.php'; ?>
<!doctype html>
<html lang="nl">

<head>
    <title>Takenlijst | Nieuwe Taak</title>
    <?php require_once __DIR__.'/../components/head.php'; ?>
</head>

<body>

    <?php require_once __DIR__.'/../components/header.php'; ?>

    <div class="container">
        <h1>Nieuwe taak aanmaken</h1>

        <form action="<?php echo $base_url; ?>/app/Http/Controllers/takencontroller.php" method="POST">

            <!-- Zorg ervoor dat de actie naar 'create' wijst -->
            <input type="hidden" name="action" value="create">

            <div class="form-group">
                <label for="titel">Naam titel:</label>
                <input type="text" name="title" id="titel" class="form-input">
            </div>

            <div class="form-group">
                <label for="afdeling">Afdeling</label>
                <select name="department">
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
                <input type="text" name="melder" id="melder" class="form-input">
            </div>

            <div class="form-group">
                <label for="overig">Informatie taak:</label>
                <textarea name="overig" id="overig" class="form-input" rows="4"></textarea>
            </div>

            <div>
                <input type="submit" value="Maak taak aan">
            </div>

        </form>
    </div>

</body>
</html>
