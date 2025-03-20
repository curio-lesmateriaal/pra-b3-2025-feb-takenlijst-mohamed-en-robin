<?php

function connectDatabase() {
    require_once '../../../backend/conn.php';
    return $conn;
}

function handleValidationErrors($errors) {
    if (count($errors) > 0) {
        echo "<ul>";
        foreach ($errors as $error) {
            echo "<li>{$error}</li>";
        }
        echo "</ul>";
        exit();
    }
}

function addNewTask($title, $description, $department) {
    $conn = connectDatabase();
    $query = "INSERT INTO taken (titel, beschrijving, afdeling) VALUES(:title, :description, :department)";
    $statement = $conn->prepare($query);
    $statement->execute([
        ":title" => $title,
        ":description" => $description,
        ":department" => $department
    ]);
}

function modifyTask($id, $title, $description, $department, $status) {
    $conn = connectDatabase();
    $query = "UPDATE taken SET titel = :title, beschrijving = :description, afdeling = :department, status = :status WHERE id = :id";
    $statement = $conn->prepare($query);
    $statement->execute([
        ":title" => $title,
        ":description" => $description,
        ":department" => $department,
        ":status" => $status,
        ":id" => $id
    ]);
}

function removeTask($id) {
    $conn = connectDatabase();
    $query = "DELETE FROM taken WHERE id = :id";
    $statement = $conn->prepare($query);
    $statement->execute([":id" => $id]);
}

$action = $_POST['action'];
$errors = [];

if ($action == "create") {
    $title = $_POST['title'];
    $description = $_POST['content'];
    $department = $_POST['department'];

    if (empty($title)) {
        $errors[] = "De titel van de taak is verplicht.";
    }

    if (empty($description)) {
        $errors[] = "Een geldige beschrijving is verplicht.";
    }

    handleValidationErrors($errors);
    addNewTask($title, $description, $department);
    header("Location: ../../../tasks/index.php?msg=Taak succesvol toegevoegd");
    exit();
}

if ($action == "edit") {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['content'];
    $department = $_POST['department'];
    $status = $_POST['status'];

    if (empty($title)) {
        $errors[] = "De titel van de taak is verplicht.";
    }

    if (empty($description)) {
        $errors[] = "Een geldige beschrijving is verplicht.";
    }

    handleValidationErrors($errors);
    modifyTask($id, $title, $description, $department, $status);
    header("Location: ../../../meldingen/index.php?msg=Taak succesvol aangepast");
    exit();
}

if ($action == "delete") {
    $id = $_POST['id'];
    removeTask($id);
    header("Location: ../../../meldingen/index.php?msg=Taak succesvol verwijderd");
    exit();
}
