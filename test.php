<?php
session_start();
require('class/Depense.php');

// Affichage des erreurs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$depense = new Depense();
$listDepenses = $depense->listDepenses();

if (isset($_GET['delete'])) {
  $depense->deleteDepense($_GET['delete']);
  header('location:index.php');
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="CSS/bootstrap.css">
  <link rel="stylesheet" href="CSS/style.css">
  <script src="JS/bootstrap.js" defer></script>
  <script src="JS/main.js" defer></script>
  <title>Gestion Budget</title>
</head>

<body>
  <div class="container">
    <div class="row">
      <!-- La class row crée un ligne qu'on peux modifier à volonté ! -->
      <div class="col-lg-4 ">
        <!-- card -->
        <div class="card  mt-4 mb-4 text-bg-success mb-3 shadow-lg  mb-5 rounded">
          <div class="card-header">Total des dépenses</div>
          <div class="card-body">
            <h5 class="card-title h1">
              <?php
              $total = $depense->calculeSolde();
              echo number_format($total, 2, ',', ' ');
              ?> €
            </h5>
            <p class="card-text">La liste ci-dessous résumes les dépenses :</p>
          </div>
        </div>
      </div>
      <div class="col-lg-8 order-lg-first">
        <!-- Titre -->
        <h1 class="mt-4 mb-4">Liste des dépenses</h1>
        <a href="add_expenses.php" class="btn mb-4 btn-success">Créer une dépense </a>

      </div>
    </div>
    <!-- Liste des dépenses -->
    <div class='row wrap'>
      <?php if (isset($_SESSION['succesModif'])) : ?>
        <div class="my-4 alert alert-success" role="alert">
          <?= $_SESSION['succesModif'];
          unset($_SESSION['succesModif']);
          ?>
          <span class="delete" onclick="this.parentElement.remove();">x</span>
        </div>
      <?php elseif ((isset($_SESSION['succesAjout']))) : ?>
        <div class="my-4 alert alert-success" role="alert">
          <?= $_SESSION['succesAjout'];
          unset($_SESSION['succesAjout']);
          ?>
          <span class="delete" onclick="this.parentElement.remove();">x</span>
        </div>
      <?php endif; ?>

      <?php foreach ($listDepenses as $uneDepense) : ?>
        <?php if ($uneDepense["debite"] == 1) : ?>
          <div class="col-10 position-relative">
            <ol class="list-group shadow-lg p-3 mb-3 alert alert-secondary rounded ">
              <span class="position-absolute top-0 start-100  translate-middle p-2 bg-secondary border border-light rounded-circle"></span>
              <li class=" d-flex justify-content-between align-items-start ">
                <div class="ms-2 me-auto">
                  <div class="fw-bold"><?= $uneDepense["titre"] ?></div>
                </div>
                <span class="badge rouge"><?= $uneDepense["prix"] ?> €</span>
              </li>
            </ol>
          </div>
          <div class="col-1 ">
            <a href="index.php?delete=<?= $uneDepense["id"] ?>" class="btn mb-4 btn-danger" onclick="return confirm('Voulez-vous vraiment supprimer cette dépense ?');">supprimer</a>
          </div>
          <div class='col-1 '>
            <a href="update_expenses.php?update=<?= $uneDepense["id"] ?>" class="btn mb-4 btn-info">modifier</a>
          </div>
        <?php else : ?>
          <div class="col-10">
            <ol class="list-group shadow-lg p-3 mb-3 bg-body rounded">
              <li class="d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                  <div class="fw-bold"><?= $uneDepense["titre"] ?></div>
                </div>
                <span class="badge rouge"><?= $uneDepense["prix"] ?> €</span>
              </li>
            </ol>
          </div>
          <div class="col-1">
            <a href="index.php?delete=<?= $uneDepense["id"] ?>" class="btn mb-4 btn-danger" onclick="return confirm('Voulez-vous vraiment supprimer cette dépense ?');">supprimer</a>
          </div>
          <div class="col-1">
            <a href="update_expenses.php?update=<?= $uneDepense["id"] ?>" class="btn mb-4 btn-info">modifier</a>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
  </div>

</body>

</html>