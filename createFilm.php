<?php
require 'db.php';
$message = '';
$one = 1;
if (isset($_POST['title'])  && isset($_POST['description']) && isset($_POST['release_year']) ) {
  $title = $_POST['title'];
  $description = $_POST['description'];
  $release_year = $_POST['release_year'];
  
$sql = 'INSERT INTO film (title,description,release_year,language_id ,original_language_id ,rental_duration ,rental_rate,replacement_cost) 
VALUES("'.$title.'", "'.$description.'", "'.$release_year.'", "'.$one.'", "'.$one.'", "'.$one.'", "'.$one.'", "'.$one.'")';
	if($connection->exec($sql)){
		 header("Location: films.php");
	}; 
}





 ?>
<?php require 'header.php'; ?>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Ajouter un Film</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
      <form method="post">
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" name="title" id="title" class="form-control">
        </div>
        <div class="form-group">
          <label for="description">Description</label>
          <input type="text" name="description" id="description" class="form-control">
        </div>
		
		 <div class="form-group">
          <label for="release_year">Année</label>
          <input type="text" name="release_year" id="release_year" class="form-control">
        </div>
		
		
		
        <div class="form-group">
          <button type="submit" class="btn btn-info">Ajouter</button>
        </div>
		      </form>
    </div>
  </div>
</div>
<?php require 'footer.php'; ?>
