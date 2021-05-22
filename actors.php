<?php
require 'db.php';
$sql = 'SELECT * FROM actor';
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
            <div class="row mb-3">
                <?php
                  if (isset($_COOKIE["username"])) {
                    echo ' <div class="col-4">

                    <a type="button" class="btn btn-danger " href="create.php">Ajouter</a>
                </div>';
                }
                ?>
               
                <div  <?php
                  if (isset($_COOKIE["username"])) {
                    echo 'class="col-8"';
                }else{
                    echo 'class="col-12"';
                }
                ?>>

                    <select class="form-select" aria-label="Default select example">
                        <option value="1" selected>Nom</option>
                        <option value="2">Naissance</option>
                    </select>


                    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" placeholder="Search..." id="searchinput">

                </div>
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