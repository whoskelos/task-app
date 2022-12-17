<?php
include "database.php";
if ($_POST["name"] && $_POST["description"]) {
    $name = $_POST["name"];
    $description = $_POST["description"];
    $id = $_POST["id"];

    $db = conectaDB();
    $query = $db->prepare("UPDATE task SET name = ?, description = ? WHERE id = ?");
    $result = $query->execute(array($name,$description,$id));
    if ($result == true) {
        echo "Task edited successfully";
    } else {
        echo "ERROR";
    }
}
?>