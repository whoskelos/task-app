<?php
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    if ($id != "") {
        include "database.php";
        $db = conectaDB();
        $query = $db->prepare("DELETE FROM task WHERE id = ?");
        $result = $query->execute(array($id));
        if ($result == true) {
            echo "Task deleted successfully";
        } else {
            echo "ERROR";
        }
    }
}
?>