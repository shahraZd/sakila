<?php
  //connect to DB
require 'db.php';
//get the id 
$actor_id = $_GET['actor_id'];
//send query
$sql = 'DELETE FROM actor WHERE actor_id= :actor_id';
$statement = $connection->prepare($sql);
//if query true
if ($statement->execute([':actor_id' => $actor_id])) {
  //redirect to main page
  header("Location: index.php");
}