<?php
//connect to DB
require 'db.php';
//get the id 
$actor_id = $_GET['actor_id'];
//get the data query
$sql = 'SELECT * FROM actor WHERE actor_id=:actor_id';
$statement = $connection->prepare($sql);
$statement->execute([':actor_id' => $actor_id]);
$person = $statement->fetch(PDO::FETCH_OBJ);
//get the fields value
if (isset($_POST['first_name'])  && isset($_POST['last_name'])) {
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  //send update query
  $sql = 'UPDATE actor SET first_name=:first_name, last_name=:last_name WHERE actor_id=:actor_id';
  $statement = $connection->prepare($sql);
  //if query true
  if ($statement->execute([':first_name' => $first_name, ':last_name' => $last_name, ':actor_id' => $actor_id])) {
    //redirect to main page
    header("Location: index.php");
  }
}
?>
<?php require 'header.php'; ?>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Modifier acteur</h2>
    </div>
    <div class="card-body">
      <?php if (!empty($message)) : ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
      <form method="post">
        <div class="form-group">
          <label for="first_name">Nom</label>
          <input value="<?php echo ($person->first_name); ?>" type="text" name="first_name" id="first_name" class="form-control">
        </div>
        <div class="form-group">
          <label for="last_name">Prenom</label>
          <input type="text" value="<?php echo ($person->last_name); ?>" name="last_name" id="last_name" class="form-control">
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-info">Modifier</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php require 'footer.php'; ?>