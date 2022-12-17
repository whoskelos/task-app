<?php
require("database.php");
if (isset($_POST['search'])) {
    $search = $_POST['search'];
    if ($_POST['search'] != "") {
        $db = conectaDB();
        // $query = $db->prepare("SELECT * FROM task WHERE name LIKE '?"."%'");
        // $result = $query->execute(array($search));
        // if ($result == false) {
        //     echo "ERROR en la consulta";
        // }
        $tasks = $db->query("SELECT * FROM task WHERE name LIKE '$search%'")->fetchAll(PDO::FETCH_OBJ);

        $json = [];
        // $tasks = $query->fetchAll(PDO::FETCH_OBJ);
        foreach ($tasks as $task) {
            $json[] = array(
                'name' => $task->name,
                'description' => $task->description,
                'id' => $task->id
            );
        }
    }
    $jsonString = json_encode($json);
    echo $jsonString;
}
