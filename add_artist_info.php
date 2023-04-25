<?php
require "dbconnection.php";
$dbcon = createDbConnection();

$artist = strip_tags($_POST["artist_name"]);

$sql = "INSERT INTO artists (Name) VALUES (?)";
$statement = $dbcon->prepare($sql);
$statement->execute(array($artist));

//jäin tässä tehtävässä aivan jumiin