<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <link rel="stylesheet" href="style/index.css" >
</head>

<body class="bg-light">

  <header class="p-3 text-white">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-between justify-content-lg-between">
        <a href="index.php" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
          <img src="./uploads/logo.png" alt="logo">
        </a>
        <?php
        //login_success.php  
        if (isset($_COOKIE["username"])) {
          echo '   <nav class="navbar navbar-expand-lg navbar-dark" aria-label="Tenth navbar example">
            <div class="container-fluid">
              <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample08">
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link " aria-current="page" href="index.php">Liste des acteurs</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link " aria-current="page" href="films.php">Liste des Films</a>
                  </li>
				     <li class="nav-item">
                    <a class="nav-link " aria-current="page" href="index_categories.php">Liste des catégories</a>
                  </li>
			
				  	 <li class="nav-item">
                    <a class="nav-link " aria-current="page" href="Historique_paiement.php">Historique de paiement</a>
                  </li>
                 
  
                </ul>
              </div>
            </div>
          </nav>';
        } else {
          echo '<h2>Bienvenue</h2>';
        }
        ?>


        <a href="login.php" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
          <?php
          //login_success.php  
          
          if (isset($_COOKIE["username"])) {
            echo '<a type="button" class="btn btn-danger" href="logout.php" >Déconnexion</a>';
          } else {
            echo '<button type="button" class="btn btn-warning">Connexion</button>';
          }
          ?>


        </a>

      </div>
    </div>
  </header>