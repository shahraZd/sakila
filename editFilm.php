<?php
require 'db.php';
$one = 1;
$film_id = $_GET['film_id'];

$sql = 'SELECT * FROM film WHERE film_id=:film_id';
$statement = $connection->prepare($sql);
$statement->execute([':film_id' => $film_id]);
$film = $statement->fetch(PDO::FETCH_OBJ);
if (isset($_POST['title'])  && isset($_POST['description']) && isset($_POST['release_year']) && isset($_POST['catégorie'])){ 
  $title = $_POST['title'];
  $description = $_POST['description'];
  $release_year = $_POST['release_year'];
  $catégorie = $_POST['catégorie'];
  
  
$sql = ("UPDATE film 
						SET 
						title = '".$title."' , 
						description = '".$description."' , 
						release_year='".$release_year."'WHERE film_id='".$film_id."'"
						);

	if($connection->exec($sql)){
		 header("Location: films.php");
	}; 
}
?>
<?php require 'header.php'; ?>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Modifier le film</h2>
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
          <input value="<?php echo($film->title); ?>" type="text" name="title" id="title" class="form-control">
        </div>
        <div class="form-group">
          <label for="description">Description</label>
          <input type="text" value="<?php echo($film->description); ?>" name="description" id="description" class="form-control">
        </div>
		
		 <div class="form-group">
          <label for="release_year">Année</label>
          <input type="text" value="<?php echo($film->release_year); ?>" name="release_year" id="release_year" class="form-control">
        </div>
		
	
		
        <div class="form-group">
          <button type="submit" class="btn btn-info">Modifier</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php require 'footer.php'; ?>