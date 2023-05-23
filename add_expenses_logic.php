<?php
session_start();
require('class/Depense.php');

// Affichage des erreurs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$depense = new Depense();

if (isset($_POST['submit'])) {
    unset($_POST['submit']);
    foreach ($_POST as $key => $value) {
        $_POST[$key] = Depense::cleaner($value);
    }
    if (!$_POST['titre']) {
        $_SESSION['erreurAjout'] = "Veuillez renseigner un titre";
    } elseif (!$_POST['prix']) {
        $_SESSION['erreurAjout'] = "Veuillez renseigner un montant";
    } 

    if (isset($_SESSION['erreurAjout'])) {
        $_SESSION['old'] = $_POST;
        header('location:add_expenses.php');
        die();
    } else {
        if ($depense->addDepense($_POST)){
            $_SESSION['succesAjout'] = "La dépense ".$_POST["titre"]." a bien été ajoutée";
            header('location:index.php');
        } else {
            $_SESSION['erreurAjout'] = "Une erreur est survenue";
            header('location:add_expenses.php');
        }
        
    }
      
}

