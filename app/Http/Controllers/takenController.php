<?php

function connectToDatabase() {
    require_once '../../../backend/conn.php';
    return $conn;
}

function handleErrors($errors) {
    if (count($errors) > 0) {
        echo "<ul>";
        foreach ($errors as $error) {
            echo "<li>{$error}</li>";
        }
        echo "</ul>";
        exit();
    }
}

function insertTask($title, $content, $department) {
    $conn = connectToDatabase();
    $query = "INSERT INTO taken (titel, beschrijving, afdeling) VALUES(:title, :content, :department)";
    $statement = $conn->prepare($query);
    $statement->execute([
        ":title" => $title,
        ":content" => $content,
        ":department" => $department
    ]);
}

function updateTask($id, $title, $content, $department, $status) {
    $conn = connectToDatabase();
    $query = "UPDATE taken SET titel = :title, beschrijving = :content, afdeling = :department, status = :status WHERE id = :id";
    $statement = $conn->prepare($query);
    $statement->execute([
        ":title" => $title,
        ":content" => $content,
        ":department" => $department,
        ":status" => $status,
        ":id" => $id
    ]);
}

function deleteTask($id) {
    $conn = connectToDatabase();
    $query = "DELETE FROM taken WHERE id = :id";
    $statement = $conn->prepare($query);
    $statement->execute([":id" => $id]);
}

$action = $_POST['action'];
$errors = [];

if ($action == "create") {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $department = $_POST['department'];

    if (empty($title)) {
        $errors[] = "De titel van de taak is verplicht.";
    }

    if (empty($content)) {
        $errors[] = "Een geldige beschrijving is verplicht.";
    }

    handleErrors($errors);
    insertTask($title, $content, $department);
    header("Location: ../../../tasks/index.php?msg=Taak succesvol toegevoegd");
    exit();
}

if ($action == "edit") {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $department = $_POST['department'];
    $status = $_POST['status'];

    if (empty($title)) {
        $errors[] = "De titel van de taak is verplicht.";
    }

    if (empty($content)) {
        $errors[] = "Een geldige beschrijving is verplicht.";
    }

    handleErrors($errors);
    updateTask($id, $title, $content, $department, $status);
    header("Location: ../../../meldingen/index.php?msg=Taak succesvol aangepast");
    exit();
}

if ($action == "delete") {
    $id = $_POST['id'];
    deleteTask($id);
    header("Location: ../../../meldingen/index.php?msg=Taak succesvol verwijderd");
    exit();
}
