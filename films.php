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
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <div class="row mb-3">
        <div class="col-12 text-center">
          <h2>List des Films</h2>
        </div>
      </div>
      <div class="row mb-3 d-flex justify-content-center">
        <?php
        if (isset($_COOKIE["username"])) {
          echo ' <div class="col-4">

                    <a type="button" class="btn btn-danger " href="createFilm.php">Ajouter</a>
                </div>';
        }
        ?>

        <form method="post" class="col-8  ">
          <div class="input-group mb-3">
            <input type="text" class="form-control" value="" name="txtSearch" id="txtSearch" placeholder="Recherche..." aria-label="Recherche..." aria-describedby="button-addon2">
            <button class="btn btn-outline-secondary" name="btnSearch" type="submit" id="button-addon2"><i class="bi bi-search"></i></button>
          </div>
          <div class="d-flex">
            <div class="form-check mr-5 ml-3">
              <input class="form-check-input" type="radio" name="RBsearch" id="RBsearch" value="title">
              <label for="RBsearch">Titre</label>
            </div>
            <div class="form-check ">
              <input class="form-check-input" type="radio" name="RBsearch" id="RBsearch1" value="release_year">
              <label for="RBsearch1">Année</label>
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
          <th>Déscription</th>
          <th>Année</th>
          <?php
          if (isset($_COOKIE["username"])) {
            echo '<th>Action</th>';
          }
          ?>

        </tr>
        <?php foreach ($film as $person) : ?>
          <tr>
            <td><?= $person->film_id; ?></td>
            <td><?= $person->title; ?></td>
            <td><?= $person->description; ?></td>
            <td><?= $person->release_year; ?></td>
            <?php
            if (isset($_COOKIE["username"])) {
              echo '   <td>
                  <a href="edit.php?film_id=' . $person->film_id . '" class="btn btn-info"><i class="fa fa-pencil-square-o fa-lg"></i></a>
                  <a onclick="confirmation()" href="delete.php?film_id=' .  $person->film_id . '" class="btn btn-danger"><i class="fa fa-trash-o fa-lg"></i></a>
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