<?php
session_start();
require 'db.php';
$sql = 'SELECT * FROM actor';
$statement = $connection->prepare($sql);
$statement->execute();
$people = $statement->fetchAll(PDO::FETCH_OBJ);

?>
<?php include("./header.php") ?>
<div class="container">
  <div class="card mt-5">

    <div class="card-header">
      <div class="row mb-3">
        <div class="col-4">
          <h2>List des Auteurs</h2>
        </div>
        <div class="col-1">

          <select class="form-select" aria-label="Default select example">
            <option value="1" selected>Nom</option>
            <option value="2">Naissance</option>
          </select>

        </div>
        <div class="col-7">

          <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" placeholder="Search..." id="searchinput">

        </div>
      </div>

    </div>
    <div class="card-body">
      <table class="table table-striped table-hover">
      <caption> <?php echo count($people).'enregistrement(s)'; ?></caption>
        <tr class=" table-warning">
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <?php
          if (isset($_SESSION["username"])) {
            echo '<th>Action</th>';
          }
          ?>

        </tr>
        <?php foreach ($people as $person) : ?>
          <tr>
            <td><?= $person->id; ?></td>
            <td><?= $person->name; ?></td>
            <td><?= $person->email; ?></td>
            <?php
            if (isset($_SESSION["username"])) {
              echo '   <td>
                  <a href="edit.php?id=<?= $person->id ?>" class="btn btn-info"><i class="fa fa-pencil-square-o fa-lg"></i></a>
                  <a onclick="return confirm("Are you sure you want to delete this entry?")" href="delete.php?id=<?= $person->id ?>" class="btn btn-danger"><i class="fa fa-trash-o fa-lg"></i></a>
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