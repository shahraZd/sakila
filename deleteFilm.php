<?php
require 'db.php';
$film_id = $_GET['film_id'];
$sql = 'DELETE FROM film WHERE film_id= :film_id';
$statement = $connection->prepare($sql);
if ($statement->execute([':film_id' => $film_id])) {
  header("Location: films.php");
}