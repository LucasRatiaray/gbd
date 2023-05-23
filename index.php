<?php
session_start();
require('class/Depense.php');
require('class/Task.php');

// Affichage des erreurs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$depense = new Depense();
$listDepenses = $depense->listDepenses();
$task = new Task();
$listTasks = $task->listTasks();

if (isset($_GET['delete'])) {
    $depense->deleteDepense($_GET['delete']);
    header('location:index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard - Brand</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <script src="assets/js/main.js" defer></script>
</head>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
            <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-laugh-wink"></i></div>
                    <div class="sidebar-brand-text mx-3"><span>GestionNAIRE <br>de BUDGET</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item"><a class="nav-link active" href="index.html"><i class="fas fa-tachometer-alt"></i><span>Tableau de bord</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="add_expenses.php"><i class="fas fa-euro-sign"></i><span>Nouvelle transaction</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="add_tasks.php"><i class="fas fa-tasks"></i><span>Nouvelle tâche</span></a></li>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid">
                        <ul class="navbar-nav flex-nowrap ms-auto"></ul>
                    </div>
                </nav>
                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h3 class="text-dark mb-0">Tableau de bord</h3>
                    </div>
                    <div class="row">
                        <?php if (isset($_SESSION['succesModif'])) : ?>
                            <div class="d-flex justify-content-center mb-2 alert alert-success" role="alert">
                                <?= $_SESSION['succesModif'];
                                unset($_SESSION['succesModif']);
                                ?>
                                <span class="delete" onclick="this.parentElement.remove();">.</span>
                            </div>
                        <?php elseif ((isset($_SESSION['succesAjout']))) : ?>
                            <div class="d-flex justify-content-center  my-2 alert alert-success" role="alert">
                                <?= $_SESSION['succesAjout'];
                                unset($_SESSION['succesAjout']);
                                ?>
                                <span class="delete" onclick="this.parentElement.remove();">.</span>
                            </div>
                        <?php endif; ?>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-start-primary py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>TOTAL DEPENSES</span></div>
                                            <div class="text-dark fw-bold h5 mb-0"><span>
                                                    <?php
                                                    $total = $depense->calculeSolde();
                                                    echo number_format($total, 2, ',', ' ');
                                                    ?> €</span></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-euro-sign fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4"></div>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-start-success py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-success fw-bold text-xs mb-1"><span>Nombre de tâche</span></div>
                                            <div class="text-dark fw-bold h5 mb-0"><span>0</span></div>
                                        </div>
                                        <div class="col-auto"><i class="fa fa-tasks fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xxl-6">
                            <div class="card shadow">
                                <div class="card-header py-3">
                                    <p class="text-primary m-0 fw-bold">Dépenses</p>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive table mt-2" id="dataTable-1" role="grid" aria-describedby="dataTable_info">
                                        <table class="table my-0" id="dataTable">
                                            <thead>
                                                <tr>
                                                    <th>Nom</th>
                                                    <th>Montant</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($listDepenses as $uneDepense) : ?>
                                                    <tr>
                                                        <td><?= $uneDepense["titre"] ?></td>
                                                        <td><?= $uneDepense["prix"] ?> €</td>
                                                        <td><a href="update_expenses.php?update=<?= $uneDepense["id"] ?>"><i class="fa fa-edit"></i></a></td>
                                                        <td><a href="index.php?delete=<?= $uneDepense["id"] ?>" onclick="return confirm('Voulez-vous vraiment supprimer cette dépense ?');"><i class="fa fa-trash"></i></a></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                            <tfoot>
                                                <tr></tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="text-primary fw-bold m-0">Todo List</h6>
                                </div>
                                <?php foreach ($listTasks as $uneTask) : ?>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <div class="row align-items-center no-gutters">
                                            <div class="col me-2">
                                                <h6 class="mb-0"><strong><?= $uneTask["name"] ?></strong></h6><span class="text-xs"><?= $uneTask["date"] ?></span>
                                            </div>
                                            <div class="col-auto">
                                                <div class="form-check"><input class="form-check-input" type="checkbox" id="formCheck-1"><label class="form-check-label" for="formCheck-1"></label></div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © Lucas Ratiaray 2023</span></div>
                </div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>