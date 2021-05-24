<?php
  //connect to DB
require 'db.php';
//get the id 
$film_id = $_GET['film_id'];

$connection->exec('SET FOREIGN_KEY_CHECKS=0');
//send query
$sql = 'DELETE FROM film WHERE film_id= :film_id';

$statement = $connection->prepare($sql);
//if query true
if ($statement->execute([':film_id' => $film_id])) {
  //redirect to main page
$connection->exec('SET FOREIGN_KEY_CHECKS=1'); 
  header("Location: films.php");
}