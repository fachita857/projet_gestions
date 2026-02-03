<?php
// Inclure correctement le fichier traitement
include_once __DIR__ . "/../traitement/dashbord.php";
?>

<div class="container mt-4">
    <h2>Tableau de bord</h2>

    <div class="row g-3 mt-3">
        <div class="col-md-3">
            <div class="card text-white bg-primary">
                <div class="card-body text-center">
                    <h3><?= $dashboard_stats['total'] ?></h3>
                    <p>Total de tâches</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success">
                <div class="card-body text-center">
                    <h3><?= $dashboard_stats['done'] ?></h3>
                    <p>Tâches terminées</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-dark bg-warning">
                <div class="card-body text-center">
                    <h3><?= $dashboard_stats['percent_done'] ?>%</h3>
                    <p>% terminées</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger">
                <div class="card-body text-center">
                    <h3><?= $dashboard_stats['late'] ?></h3>
                    <p>En retard</p>
                </div>
            </div>
        </div>
    </div>
</div>
