<?php
include "database.php";
$db = conectaDB();
$json = $db->query("SELECT * FROM task")->fetchAll(PDO::FETCH_OBJ);
$jsonString = json_encode($json);
echo $jsonString;
?>