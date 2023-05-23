<?php
session_start();
require('class/Depense.php');

// Affichage des erreurs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$depense = new Depense();

if (isset($_GET['update'])) {   
    $oldFormData = $depense->getDepense($_GET['update']);
    $_SESSION['update'] = $_GET['update'];
}

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/swiper.css">
    <script src="assets/js/bootstrap.js" defer></script>
    <script src="assets/js/swiper.js" defer></script>
    <script src="assets/js/theme.js" defer></script>
    <script src="assets/js/main.js" defer></script>
    <title>Gestion budge - Modifier une dépense</title>
</head>

<body>
    <div class="container">
        <h1 class="my-4">Modifier une dépense</h1>
        <?php if (isset($_SESSION['erreurModif'])) : ?>
            <div class="my-4 alert alert-danger" role="alert">
                <?= $_SESSION['erreurModif'];
                unset($_SESSION['erreurModif']);
                ?>
                <span class="delete" onclick="this.parentElement.remove();">x</span>
            </div>
        <?php endif; ?>
        <form action="update_expenses_logic.php" method="POST">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" name="titre" value="<?= $oldFormData['titre'];?>" required>
                <label for="floatingInput">Entrez un nouveau titre</label>
            </div>
            <div class="form-floating">
                <input type="number" class="form-control" id="floatingPassword" name="prix" value="<?= $oldFormData['prix'];?>" required>
                <label for="floatingPassword">Entrez un nouveau prix</label>
            </div>
            <div class="my-4 d-grid gap-2 d-md-flex">
                <button name="submit" class="btn btn-success me-md-2" type="submit">Modifier</button>
                <a href="index.php" class="btn btn-dark" type="button">Revenir</a>
            </div>
        </form>
    </div>
</body>

</html>