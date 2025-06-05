<?php 
require_once __DIR__ . '/../../../backend/config.php';  
?>

<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Takenlijst | Nieuwe Taak</title>
    <?php require_once '../../../head.php'; ?> 
    <link rel="stylesheet" href="../../../css/main.css"> 
</head>

<body>
    <header>
        <img src="../../../logo-big-v4.png" alt="Pretpark Logo"> 
        <a href="../../../resources/views/login/login.php">Inloggen</a> 
    </header>

    <div class="container">
        <h1>Nieuwe taak</h1>

        <?php 
        if (isset($_GET['success']) && $_GET['success'] == 1) {
            echo '<p class="success-message">Taak succesvol aangemaakt!</p>';
        }
        ?>

        <form action="<?php echo $base_url; ?>/app/Http/Controllers/takenController.php" method="POST">
            <input type="hidden" name="action" value="create">

            <div class="form-group">
                <label for="titel">Titel:</label>
                <input type="text" name="titel" id="titel" class="form-input" required>
            </div>

            <div class="form-group">
                <label for="afdeling">Afdeling:</label>
                <select name="afdeling" id="afdeling" class="form-input" required>
                    <option value="" disabled selected>Kies een afdeling</option>
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
                <label for="beschrijving">Beschrijving:</label>
                <textarea name="beschrijving" id="beschrijving" class="form-input" rows="4" required></textarea>
            </div>

            <div class="form-group">
                <label for="deadline">Deadline:</label>
                <input type="date" name="deadline" id="deadline" class="form-input" required>
            </div>

            <div class="form-group">
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
