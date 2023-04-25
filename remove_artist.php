<?php
require "dbconnection.php";
$dbcon = createDbConnection();

$artist_id = 1;

try{
    $dbcon->beginTransaction();

    $statement = $dbcon->prepare("DELETE FROM invoice_items WHERE TrackId IN
    (SELECT TrackId FROM tracks WHERE AlbumId IN(SELECT AlbumId FROM albums WHERE ArtistId=$artist_id))");
    $statement->execute();

    $statement = $dbcon->prepare("DELETE FROM invoices WHERE InvoiceId IN
     (SELECT InvoiceId FROM invoice_items WHERE TrackId IN(SELECT TrackId FROM tracks WHERE AlbumId IN
     (SELECT AlbumId FROM albums WHERE ArtistId=$artist_id)))");
    $statement->execute();

    $statement = $dbcon->prepare("DELETE FROM playlist_track WHERE TrackId IN
    (SELECT TrackId FROM tracks WHERE AlbumId IN(SELECT AlbumId FROM albums WHERE ArtistId=$artist_id))");
    $statement->execute();

    $statement = $dbcon->prepare("DELETE FROM tracks WHERE AlbumId IN
    (SELECT AlbumId FROM albums WHERE ArtistId=$artist_id)");
    $statement->execute();

    $statement = $dbcon->prepare("DELETE FROM albums WHERE ArtistId=$artist_id");
    $statement->execute();

    $statement = $dbcon->prepare("DELETE FROM artists WHERE ArtistId=$artist_id");
    $statement->execute();

    $dbcon->commit();

    echo "Artisti ja kaikki siihen liittyvät tiedot on poistettu";
    
} catch(Exception $e){
    $dbcon->rollBack();
    echo $e->getMessage();
}