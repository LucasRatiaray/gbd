<?php
session_start();
require('class/Depense.php');

// Affichage des erreurs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$depense = new Depense();
$id = $_SESSION['update'];

if (isset($_POST['submit'])) {
    unset($_POST['submit']);
    foreach ($_POST as $key => $value) {
        $_POST[$key] = Depense::cleaner($value);
    }
    if (!$_POST['titre']) {
        $_SESSION['erreurModif'] = "Veuillez renseigner un titre";
    } elseif (!$_POST['prix']) {
        $_SESSION['erreurModif'] = "Veuillez renseigner un montant";
    } 

    if (isset($_SESSION['erreurModif'])) {
        header("location:update_expenses.php?update=$id");
        die();
    } else {
        if ($depense->updateDepense($_POST, $_SESSION['update'])){
            $_SESSION['succesModif'] = "La dépense ".$_POST["titre"]." a bien été modifiée";
            unset($_SESSION['update']);
            header('location:index.php');
        } else {
            $_SESSION['erreurModif'] = "Une erreur est survenue";
            header('location:update_expenses.php?update=$id');
        }
        
    }
      
}
