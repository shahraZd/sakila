<?php
  // $host = "localhost";
  // $username = "root";
  // $password = "";
  // $database = "sakila";
  // $message = "";
  try {
    require 'db.php';
    if (isset($_POST["login"])) {
      if (empty($_POST["username"]) || empty($_POST["password"])) {
        $message = '<label>All fields are required</label>';
      } else {
        $query = "SELECT * FROM login WHERE username = :username AND password = :password";
        $statement = $connection->prepare($query);
        $statement->execute(
          array(
            'username'     =>     $_POST["username"],
            'password'     =>     $_POST["password"]
          )
        );
        $count = $statement->rowCount();
        if ($count > 0) {
          $_SESSION["username"] = $_POST["username"];
          header("location:index.php");
        } else {
          $message = '<label>Wrong Data</label>';
        }
      }
    }
  } catch (PDOException $error) {
    $message = $error->getMessage();
  }

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>

<body>
  <?php include("./header.php") ?>
  <div class="container mt-5 d-flex align-items-center justify-content-center">
    <main class="form-signin w-50">
      <?php if (!empty($message))
        echo '<div class="alert alert-danger text-center message" role="alert">' . $message . '</div>'
      ?>
      <form method="post">
        <div class="form-floating mb-3">
          <label for="floatingInput">Non d'utilisateur</label>
          <input type="text" name="username" class="form-control" id="floatingInput" placeholder="name@example.com">
        </div>
        <div class="form-floating mb-3">
          <label for="floatingPassword">Mot de passe</label>
          <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
        </div>
        <input class="w-100 btn btn-lg btn-primary" type="submit" name="login" value="Login" />
      </form>
    </main>

  </div>
  <?php include("./footer.php") ?>
  <div>

    <!-- JS, Popper.js, and jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
  </div>

</body>

</html>