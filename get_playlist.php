<?php

require "dbconnection.php";
$dbcon = createDbConnection();

$sql = "SELECT Name, Composer FROM tracks";
$statement = $dbcon->prepare($sql);
$statement->execute();

$playlist_id = $statement->fetchAll(PDO::FETCH_ASSOC);

foreach ($playlist_id as $id) {
    echo "<h2>".$id["Name"]."</h2>"."<br>".$id["Composer"];
}