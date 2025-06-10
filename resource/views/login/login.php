<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: ../../../takenlijst.php?msg=Je bent al ingelogd!");
    exit;
}
require_once __DIR__.'/../../../backend/config.php'; 
?>
<!doctype html>
<html lang="nl">

<head>
    <title>Takenlijst / Login</title>
    <?php require_once '../../../head.php'; ?>
    <link rel="stylesheet" href="../../../css/main.css">
</head>

<body>
    <header>
        <img src="../../../logo-big-v4.png" alt="Pretpark Logo">
    </header>

    <div class="container">
        <h1>Login</h1>

        <?php if (isset($_GET['error'])) : ?>
            <div class="alert"><?php echo htmlspecialchars($_GET['error']); ?></div>
        <?php endif; ?>

        <form action="../../../app/Http/Controllers/loginController.php" method="POST">
            <div class="form-group">
                <label for="username">Gebruikersnaam:</label>
                <input type="text" name="username" id="username" class="form-input" required>
            </div>

            <div class="form-group">
                <label for="password">Wachtwoord:</label>
                <input type="password" name="password" id="password" class="form-input" required>
            </div>
            
            <button type="submit" class="btn">Login</button>
        </form>
    </div>

    <footer>
        <p>&copy; 2025 Pretpark Takenlijst</p>
        <p>Jowy, Mohamed, Robin</p>
    </footer>
</body>

</html>
