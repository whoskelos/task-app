<?php
if (isset($_POST['name']) && isset($_POST['description'])) {
    if ($_POST['name'] != "" && $_POST['description'] != "") {
        $name = $_POST['name'];
        $description = $_POST['description'];

        include "database.php";
        $db = conectaDB();
        $query = $db->prepare("INSERT INTO task (name,description) VALUES (?,?)");
        $result = $query->execute(array($name,$description));
        if ($result == true) {
            echo "Task added successfully 😄";
        } else {
            echo "Error creating new task 😞";
        }
    }
}
?>