<?php
try {
  //connect to DB
  require 'db.php';
  //test if the user is already logged in he can't access to login page
  if (isset($_COOKIE["username"])) {
    header("location:index.php");
  }
  // user click on login button
  if (isset($_POST["login"])) {
    // test if the fields are empty 
    if (empty($_POST["username"]) || empty($_POST["password"])) {
      $message = '<label>All fields are required</label>';
    } else {
      //send query
      $query = "SELECT * FROM login WHERE username = :username AND password = :password";
      $statement = $connection->prepare($query);
      //put the result in an array
      $statement->execute(
        array(
          'username'     =>     $_POST["username"],
          'password'     =>     $_POST["password"]
        )
      );
      // count array length
      $count = $statement->rowCount();
      if ($count > 0) {
        // array not empty user exist
        $result = $statement->fetchAll();
        foreach ($result as $row) {
          // create cookie for 1hour
          setcookie("username", $row["username"], time() + 3600);
          setcookie("type", $row["type"], time() + 3600);
          // redirect to index page
          header("location:index.php");
        }
      } else {
        // array empty user don't exist
        $message = '<label>Wrong Data</label>';
      }
    }
  }
} catch (PDOException $error) {
  //error in query
  $message = $error->getMessage();
}

?>

<?php include("./header.php") ?>
<div class="container mt-5 d-flex align-items-center justify-content-center">
  <main class="form-signin w-50">
    <?php if (!empty($message))
      //display error message
      echo '<div class="alert alert-danger text-center message" role="alert">' . $message . '</div>'
    ?>
    <form method="post">
      <div class="form-floating mb-3">
        <label for="floatingInput">Nom d'utilisateur</label>
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