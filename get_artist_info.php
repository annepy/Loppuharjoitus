<?php
require "dbconnection.php";
$dbcon = createDbConnection();

$sql = "SELECT Name FROM artists";
$statement = $dbcon->prepare($sql);
$statement->execute();

$artist_id = $statement->fetchAll(PDO::FETCH_ASSOC);

$json = json_encode($artist_id);
header('Content-type: application/json');
echo $json;

//Yläpuolella on mitä sain itse aikaiseksi ennen kun jäin jumiin
//alapuolella Chat GTP:n avulla tehty toimiva vastaus

// require "dbconnection.php";
// $dbcon = createDbConnection();

// $sql = "SELECT a.ArtistId, a.Name, al.AlbumId, al.Title, t.TrackId, t.Name as TrackName
//         FROM artists a
//         JOIN albums al ON al.ArtistId = a.ArtistId
//         JOIN tracks t ON t.AlbumId = al.AlbumId
//         ORDER BY a.ArtistId, al.AlbumId, t.TrackId";

// $statement = $dbcon->prepare($sql);
// $statement->execute();

// $artists = array();
// $current_artist_id = null;
// $current_album_id = null;

// while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
//     if ($row['ArtistId'] != $current_artist_id) {
//         $current_artist_id = $row['ArtistId'];
//         $artists[] = array(
//             'Name' => $row['Name'],
//             'Albums' => array()
//         );
//         $current_album_id = null;
//     }
//     if ($row['AlbumId'] != $current_album_id) {
//         $current_album_id = $row['AlbumId'];
//         $artists[count($artists)-1]['Albums'][] = array(
//             'Title' => $row['Title'],
//             'Tracks' => array()
//         );
//     }
//     $artists[count($artists)-1]['Albums'][count($artists[count($artists)-1]['Albums'])-1]['Tracks'][] = array(
//         'Name' => $row['TrackName']
//     );
// }

// $json = json_encode($artists);
// header('Content-type: application/json');
// echo $json;