<?php
require 'db.php';
$message = '';
if (isset($_POST['title'])  && isset($_POST['description']) && isset($_POST['release_year'])) {
  $title = $_POST['title'];
  $description = $_POST['description'];
  $release_year = $_POST['release_year'];
  $sql = 'INSERT INTO film(title, description,release_year) VALUES(:title, :description,:release_year)';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':title' => $title, ':description' => $description, ':release_year' => $release_year])) {
    $message = 'data inserted successfully';
    header("Location: films.php");
  }
}


?>
<?php require 'header.php'; ?>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Ajouter un Film</h2>
    </div>
    <div class="card-body">
      <?php if (!empty($message)) : ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
      <form method="post">
        <div class="form-group">
          <label for="title">Titre</label>
          <input type="text" name="title" id="title" class="form-control">
        </div>
        <div class="form-group">
          <label for="description">Déscription</label>
          <textarea type="text" name="description" id="description" class="form-control"></textarea>
        </div>
        <div class="form-group">
          <label for="release_year">Année</label>
          <input type="text" name="release_year" id="release_year" class="form-control">
        </div>
        <div class="form-group">
          <!-- <button type="submit" class="btn btn-info">Ajouter</button> -->
        </div>
      </form>
    </div>
  </div>
</div>
<?php require 'footer.php'; ?>