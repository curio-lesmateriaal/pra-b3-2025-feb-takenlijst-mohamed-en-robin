<?php require_once __DIR__.'/../../../head.php'; ?>

<!doctype html>
<html lang="nl">

<head>
    <title>Takenlijst | Nieuwe Taak</title>
    <?php require_once __DIR__.'/../../../head.php'; ?>
    <!-- Verkeerde pad naar de CSS kan worden gecorrigeerd -->
    <link rel="stylesheet" href="<?php echo $base_url; ?>/css/main.css"> <!-- Zorg ervoor dat het pad naar je CSS goed is -->
</head>

<body>

    <header>
        <!-- Zorg ervoor dat het logo goed geladen wordt -->
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
                <label for="afdeling">Afdeling</label>
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
                <label for="beschrijving">Beschrijving taak:</label>
                <textarea name="beschrijving" id="beschrijving" class="form-input" rows="4" required></textarea>
            </div>

            <div class="form-group">
                <label for="status">Status:</label>
                <select name="status" id="status" required>
                    <option value="open">Open</option>
                    <option value="in_progress">In Progress</option>
                    <option value="closed">Closed</option>
                </select>
            </div>

            <div class="form-group">
                <label for="deadline">Deadline:</label>
                <input type="date" name="deadline" id="deadline" class="form-input" required>
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
