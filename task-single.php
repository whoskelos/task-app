<?php
if (isset($_POST["id"])) {
    $id = $_POST["id"];
    include "database.php";
    $db = conectaDB();
    $query = $db->prepare("SELECT * FROM task WHERE id = ?");
    $result = $query->execute(array($id));
    if ($result == true) {
        $task = $query->fetch(PDO::FETCH_OBJ);
        $taskString = json_encode($task);
        echo $taskString;
    } else {
        echo "ERROR";
    }
}
?>