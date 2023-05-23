<?php
session_start();

// ancienne données
$titre = $_SESSION['old']['titre'] ?? '';
$prix = $_SESSION['old']['prix'] ?? '';

// suppression des données de session
unset($_SESSION['old']);

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
    <title>Gestion budge - Ajouter une tâche/title>
</head>

<body>
    <div class="container">
        <h1 class="my-4">Ajouter une tâche</h1>
        <?php if (isset($_SESSION['erreurAjout'])) : ?>
            <div class="my-4 alert alert-danger" role="alert">
                <?= $_SESSION['erreurAjout'];
                unset($_SESSION['erreurAjout']);
                ?>
                <span class="delete" onclick="this.parentElement.remove();">x</span>
            </div>
        <?php endif; ?>
        <form action="add_expenses_logic.php" method="POST">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" name="name" placeholder="Course">
                <label for="floatingInput">Nom de la tâche</label>
            </div>
            <div class="my-4 d-grid gap-2 d-md-flex">
                <button name="submit" class="btn btn-success me-md-2" type="submit">Ajouter</button>
            </div>
        </form>
    </div>
</body>

</html>