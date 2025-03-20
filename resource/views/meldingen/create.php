<?php require_once __DIR__.'/../../../config/config.php'; ?>
<!doctype html>
<html lang="nl">

<head>
    <title>takenlijst/ taak /Nieuwe< taken/title>
    <?php require_once __DIR__.'/../components/head.php'; ?>
</head>

<body>

    <?php require_once __DIR__.'/../components/header.php'; ?>

    <div class="container">
        <h1>Nieuwe taak</h1>

        <form action="<?php echo $base_url; ?>/app/Http/Controllers/meldingenController.php" method="POST">

            <input type="hidden" name="action" value="create">

            <div class="form-group">
                <label for="titel">Naam titel:</label>
                <input type="text" name="titel" id="titel" class="form-input">
            </div>
            <div class="form-group">
                <label for="afdeling">Type</label>
                <!-- hier komt een dropdown -->
             <select name="afdeling" >
            <option value="personeel">personeel</option>
            <option value="horeca">Horeca</option>
            <option value="techniek">techniek</option>
            <option value="inkoop">inkoop</option>
            <option value="Klantenservice ">Klantenservice </option>
            <option value="groen">groen</option>
            <option value="overig">Overig</option>
             </select>
             <div>
             <data class=" prioriteit"></data>
             <label for= " prioriteit">prioriteit</label>
             <input type="checkbox" name=" prioriteit">
             <label for=" prioriteit">is deze taak belangrijk</label>
             </div>

            </div>
            
            <div class="form-group">
                <label for="melder">Naam melder:</label>
                <input type="text" name="melder" id="melder" class="form-input">
            </div>
            <div class= "form-group">
            <label for="overig">informatie taak:</label>
        <textarea name="overig" id="overig" class="form-input" rows="4"></textarea>
        </div>

           <div>
            <input type="submit" value="maak taak aan">
            </div>
</body>
</html>
