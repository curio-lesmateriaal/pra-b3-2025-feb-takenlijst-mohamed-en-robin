<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: resource/views/login/login.php");
    exit;
}

require 'backend/conn.php';
?>

<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Takenlijst</title>
    <style>
        html, body {
            margin: 0; 
            padding: 0; 
            min-height: 100%; 
            font-family: Arial, sans-serif;
            background-color: #fff;
            color: #333;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: lightskyblue;
            padding: 20px 40px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        header img {
            height: 50px;
        }
        /* Header link wit houden */
        header a {
            color: white;
            text-decoration: underline;
            font-weight: bold;
            font-size: 18px;
        }
        /* Afdeling-links als button met border en padding */
        ul.afdeling-links {
            list-style: none;
            padding: 0;
            margin-bottom: 20px;
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }
        ul.afdeling-links li a {
            color: #333;
            border: 2px solid #333;
            padding: 6px 14px;
            border-radius: 6px;
            background-color: #f0f0f0;
            text-decoration: none;
            font-weight: bold;
            display: inline-block;
            transition: background-color 0.3s, color 0.3s;
        }
        ul.afdeling-links li a:hover {
            background-color: #333;
            color: #fff;
            cursor: pointer;
            text-decoration: none;
        }
        /* Alle andere links normale blauwe standaardstijl */
        a {
            color: blue;
            text-decoration: underline;
            font-weight: normal;
        }
        a:hover {
            text-decoration: none;
        }
        .container {
            width: 90%;
            max-width: 1000px;
            margin: 20px auto 60px; /* margin onderaan zodat footer niet overlapt */
        }
        h1, h2 {
            color: #333;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 50px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #eee;
        }
        footer {
            background-color: lightskyblue;
            text-align: center;
            padding: 15px 0;
            color: #333;
        }
    </style>
</head>
<body>

<header>
    <img src="logo-big-v4.png" alt="Pretpark Logo">
</header>

<main class="container">
    <h1>Takenlijst</h1>
    <p>Hieronder staan alle taken die nog niet klaar zijn:</p>
    <a href="resource/views/meldingen/create.php">Nieuwe Taak Aanmaken</a>
    <p><a href="resource/views/meldingen/done.php">Bekijk voltooide taken</a></p>

    <h2>Filter op afdeling:</h2>
    <?php
    $afdelingen = ['personeel', 'horeca', 'techniek', 'inkoop', 'klantenservice', 'groen', 'overig'];
    echo "<ul class='afdeling-links'>";
    foreach ($afdelingen as $afdeling) {
        echo "<li><a href='resource/views/meldingen/afdeling.php?afdeling=" . urlencode($afdeling) . "'>" . htmlspecialchars(ucfirst($afdeling)) . "</a></li>";
    }
    echo "</ul>";
    ?>

    <?php
    $stmt = $pdo->query("SELECT id, titel, beschrijving, afdeling, status, deadline FROM taken WHERE status <> 'done' ORDER BY deadline ASC");
    echo "<table>";
    echo "<tr>
            <th>Titel</th>
            <th>Beschrijving</th>
            <th>Afdeling</th>
            <th>Status</th>
            <th>Deadline</th>
            <th>Actie</th>
          </tr>";
    while ($row = $stmt->fetch()) {
        echo "<tr>
                <td>" . htmlspecialchars($row['titel']) . "</td>
                <td>" . htmlspecialchars($row['beschrijving']) . "</td>
                <td>" . htmlspecialchars($row['afdeling']) . "</td>
                <td>" . htmlspecialchars($row['status']) . "</td>
                <td>" . htmlspecialchars($row['deadline']) . "</td>
                <td>
                    <a href='delete.php?id={$row['id']}' onclick='return confirm(\"Weet je zeker dat je deze taak wilt verwijderen?\")'>Verwijderen</a> |
                    <a href='resource/views/meldingen/edit.php?id={$row['id']}'>Bewerken</a>
                </td>
              </tr>";
    }
    echo "</table>";
    ?>
</main>

<footer>
    <p>&copy; 2025 Pretpark Takenlijst</p>
    <p>Jowy, Mohamed, Robin</p>
</footer>

</body>
</html>
