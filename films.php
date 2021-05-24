<?php
require 'db.php';
$sql = 'SELECT * FROM film';
$t = "";
$v = "";
if ((isset($_POST['RBsearch']) || isset($_POST['RBsearch1'])) && isset($_POST['txtSearch'])) {
  $v = $_POST['txtSearch'];
  $t = $_POST['RBsearch'];
  $sql .= ' WHERE ' . strtolower($t) . ' LIKE "' . $v . '"';
}
$statement = $connection->prepare($sql);
$statement->execute();
$film = $statement->fetchAll(PDO::FETCH_OBJ);
?>
<?php include("./header.php") ?>
<?php $isAdmin = (isset($_COOKIE['type']) && $_COOKIE['type'] == 'admin') ? true : false; ?>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <div class="row mb-3">
        <div class="col-12 text-center">
          <h2>Liste des Films</h2>
        </div>
      </div>
      <div class="row mb-3 d-flex justify-content-center">
        <?php
        if (isset($_COOKIE["username"])&& $isAdmin) {
          echo ' <div class="col-4">
                    <a type="button" class="btn btn-danger " href="createFilm.php">Ajouter</a>
                </div>';
        }
        ?>
				<br>
		<a type="button" class="btn btn-danger " href="films.php">Supprimer filtre recherche</a>
		<br>
		</div>

        <form method="post" class="col-8  ">
          <div class="input-group mb-3">
            <input type="text" class="form-control" value="" name="txtSearch" id="txtSearch" placeholder="Recherche..." aria-label="Recherche..." aria-describedby="button-addon2">
            <button class="btn btn-outline-secondary" name="btnSearch" type="submit" id="button-addon2"> <?php
            if (!empty($t)) {
              echo '<i class="bi bi-x text-danger"></i></button>';
            } else {
              echo '  <i class="bi bi-search text-primary"></i>';
            }
            ?></i></button>
          </div>
          <div class="d-flex">
            <div class="form-check mr-5 ml-3">
              <input class="form-check-input" type="radio" name="RBsearch"  value="title">
              <label >Titre</label>
            </div>
            <div class="form-check ">
              <input class="form-check-input" type="radio" name="RBsearch"  value="release_year">
              <label >Année</label>
            </div>
          </div>
        </form>
      </div>

    </div>
    <div class="card-body">
      <table class="table caption-top table-striped table-hover " id="paginationNumbers">
        <caption> <?php echo count($film) . 'enregistrement(s)'; ?></caption>
        <tr class=" table-warning">
          <th>ID</th>
          <th>Titre</th>
          <th>Catégorie</th>
          <th>Description</th>
          <th>Année</th>
               <?php
          if (isset($_COOKIE["username"]) && $isAdmin) {
            echo '<th>Action</th>';
          }
          ?>

        </tr>
        <?php foreach ($film as $film) : ?>
		<?php $findCategorySql = 'SELECT name FROM category INNER JOIN film_category ON category.category_id = film_category.category_id WHERE film_category.film_id = '. $film->film_id .' ;'; ?>
       
		<?php $statement = $connection->prepare($findCategorySql);
			  $statement->execute();
			  $category = $statement->fetchAll(PDO::FETCH_OBJ); 
		?>
		  <tr>
            <td><?= $film->film_id; ?></td>
            <td><?= $film->title; ?></td>
            <td><?= isset($category[0]->name)? $category[0]->name : '' ?></td>
            <td><?= $film->description; ?></td>
            <td><?= $film->release_year; ?></td>
            <?php
            if (isset($_COOKIE["username"])&& $isAdmin)  {
              echo '   <td>
                  <a href="editFilm.php?film_id=' . $film->film_id . '" class="btn btn-info"><i class="fa fa-pencil-square-o fa-lg"></i></a>
                  <a onclick="confirmation()" href="deleteFilm.php?film_id=' .  $film->film_id . '" class="btn btn-danger"><i class="fa fa-trash-o fa-lg"></i></a>
                </td>';
            }
            ?>

          </tr>
        <?php endforeach; ?>
      </table>
    </div>
  </div>
</div>
<?php require 'footer.php'; ?>