<?php
require 'db.php';
$actor_id = $_GET['actor_id'];
$sql = 'DELETE FROM actor WHERE actor_id= :actor_id';
$statement = $connection->prepare($sql);
if ($statement->execute([':actor_id' => $actor_id])) {
  header("Location: index.php");
}