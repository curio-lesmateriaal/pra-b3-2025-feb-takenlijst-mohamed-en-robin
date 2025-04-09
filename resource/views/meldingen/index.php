<?php
    session_start();
    if(!isset($_SESSION['user_id'])){
        $msg="Je moet eerst inloggen!";
        header("Location: ../../../resources/views/login/login.php?msg= .$msg ");
    }
?>
<?php require_once __DIR__.'/../../../backend/config.php'; ?>
<!doctype html>
<html lang="nl">

<head>
    <title>StoringApp / Meldingen</title>
    <?php require_once __DIR__.'/../components/head.php'; ?>
</head>

<body>

    <?php require_once __DIR__.'/../components/header.php'; ?>

    <div class="container">
        <h1>taken</h1>
        <a href="create.php">Nieuwe taak aanmaken>> &gt;</a>
        <p><a href="done.php">Bekijk voltooide taken</a></p>


        <?php if(isset($_GET['msg']))
        {
            echo "<div class='msg'>" . $_GET['msg'] . "</div>";
        } ?>

    <div style="height: 300px; background: #ededed; display: flex; justify-content: center; align-items: center; color: #666666;">
  <?php
        // 1. Verbinding
    require_once '../../../config/conn.php';

// 2. Query
    $query ="SELECT * FROM taken ";

// 3. Prepare
    $statement = $conn->prepare($query);

// 4. Execute
    $statement->execute();
     
 //5.fetch
    $taken= $statement->fetchAll(PDO::FETCH_ASSOC);

    ?>

    <table>
<tr>
   <th>Personeel</th>
   <th>Horeca</th>
   <th>techniek</th>
   <th>inkoop</th>
   <th>Klantenservice</th>
   <th>groen</th>
   <th>Overig</th>
</tr>



    <?php

?>
     <?php foreach($taken as $taak): ?>
        <tr>
            <td><?php echo $taak['personeel']; ?></td>
            <td><?php echo $taak['horeca']; ?></td>
            <td><?php echo $taak['techniek']; ?></td>
            <td><?php echo $taak['inkoop']; ?></td>
            <td><?php echo $taak['klantenservice']; ?></td>
            <td><?php echo $taak['groen']; ?></td>
            <td><?php echo $taak['overig']; ?></td>
            
            
            
            
        </tr>
    <?php endforeach; ?>

    </table>

    </div>
    </div>

    </body>
    </html>
