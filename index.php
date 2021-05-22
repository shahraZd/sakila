<?php
require 'db.php';
$sql = 'SELECT * FROM actor';
$t = "";
$v = "";
if ((isset($_POST['RBsearch']) || isset($_POST['RBsearch1'])) && isset($_POST['txtSearch'])) {
  $v = $_POST['txtSearch'];
  $t = $_POST['RBsearch'];
  $sql .= ' WHERE ' . strtolower($t) . ' LIKE "' . $v . '"';
}
$statement = $connection->prepare($sql);
$statement->execute();
$actor = $statement->fetchAll(PDO::FETCH_OBJ);
?>
<?php include("./header.php") ?>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <div class="row mb-3">
        <div class="col-12 text-center">
          <h2>List des Acteurs</h2>
        </div>
      </div>
      <div class="row mb-3 d-flex justify-content-center">
        <?php
        if (isset($_COOKIE["username"])) {
          echo ' <div class="col-4">

                    <a type="button" class="btn btn-danger " href="create.php">Ajouter</a>
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
              <input class="form-check-input" type="radio" name="RBsearch" id="RBsearch" value="first_name">
              <label for="RBsearch">Nom</label>
            </div>
            <div class="form-check ">
              <input class="form-check-input" type="radio" name="RBsearch" id="RBsearch1" value="last_name">
              <label for="RBsearch1">Prenom</label>
            </div>
          </div>
        </form>
      </div>

    </div>
    <div class="card-body">
      <table class="table caption-top table-striped table-hover " id="paginationNumbers">
        <caption> <?php echo count($actor) . 'enregistrement(s)'; ?></caption>
        <tr class=" table-warning">
          <th>ID</th>
          <th>Nom</th>
          <th>Prenom</th>
          <?php
          if (isset($_COOKIE["username"])) {
            echo '<th>Action</th>';
          }
          ?>

        </tr>
        <?php foreach ($actor as $person) : ?>
          <tr>
            <td><?= $person->actor_id; ?></td>
            <td><?= $person->first_name; ?></td>
            <td><?= $person->last_name; ?></td>
            <?php
            if (isset($_COOKIE["username"])) {
              echo '   <td>
                  <a href="edit.php?actor_id=' . $person->actor_id . '" class="btn btn-info"><i class="fa fa-pencil-square-o fa-lg"></i></a>
                  <a onclick="confirm()" href="delete.php?actor_id=' .  $person->actor_id . '" class="btn btn-danger"><i class="fa fa-trash-o fa-lg"></i></a>
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