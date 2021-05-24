<?php
require 'db.php';
$sql = 'SELECT payment_id, amount FROM payment ';
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

<?php $isAdmin = (isset($_COOKIE['type']) && $_COOKIE['type'] == 'admin') ? true : false; ?>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <div class="row mb-3">
        <div class="col-12 text-center">
          <h2>Paiements</h2>
        </div>
      </div>
      </div>

    </div>
	
    <div class="card-body">
      <table class="table caption-top table-striped table-hover " id="paginationNumbers">
        <caption> <?php echo count($actor) . 'enregistrement(s)'; ?></caption>
        <tr class=" table-warning">
          <th>ID  <?php if (isset($_COOKIE["type"]));  ?></th>
          <th>Nom</th>
          <?php
          if (isset($_COOKIE["username"]) && $isAdmin) {
            echo '<th>Action</th>';
          }
          ?>

        </tr>
        <?php foreach ($actor as $person) : ?>
          <tr>
            <td><?= $person->paiement_id; ?></td>
            <td><?= $person->Nom_Client; ?></td>
          

          </tr>
        <?php endforeach; ?>
      </table>
    </div>
  </div>
</div>
<?php require 'footer.php'; ?>