<?php
require 'db.php';
$message = '';
if (isset ($_POST['first_name'])  && isset($_POST['last_name']) ) {
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $sql = 'INSERT INTO actor(first_name, last_name) VALUES(:first_name, :last_name)';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':first_name' => $first_name, ':last_name' => $last_name])) {
    $message = 'data inserted successfully';
  }



}


 ?>
<?php require 'header.php'; ?>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Ajouter un acteur</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
      <form method="post">
        <div class="form-group">
          <label for="first_name">Nom</label>
          <input type="text" name="first_name" id="first_name" class="form-control">
        </div>
        <div class="form-group">
          <label for="last_name">Prenom</label>
          <input type="text" name="last_name" id="last_name" class="form-control">
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-info">Ajouter</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php require 'footer.php'; ?>
