<?php
require_once __DIR__ . "/../traitement/fonctions.php";

// -------------------
// TRAITEMENT POST : ajout / modification
// -------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;

    if ($id) {
        updateTask(
            $id,
            $_POST['titre'],
            $_POST['description'],
            $_POST['priorite'],
            $_POST['date_limite'],
            $_POST['statut'] ?? 'à faire'
        );
        header("Location: index.php?page=taks_liste&msg=modif");
        exit;
    } else {
        addTask(
            $_POST['titre'],
            $_POST['description'],
            $_POST['priorite'],
            $_POST['date_limite'],
            $_POST['responsable']
        );
        header("Location: index.php?page=taks_liste&msg=ajout");
        exit;
    }
}

// -------------------
// TRAITEMENT GET : supprimer / changer statut
// -------------------
if (isset($_GET['action']) && $_GET['action']=='changer_statut' && isset($_GET['id'])) {
    changeStatus($_GET['id']);
    header("Location: index.php?page=taks_liste");
    exit;
}

if (isset($_GET['action']) && $_GET['action']=='supprimer' && isset($_GET['id'])) {
    deleteTask($_GET['id']);
    header("Location: index.php?page=taks_liste");
    exit;
}

// -------------------
// FILTRAGE
// -------------------
$keyword  = $_GET['keyword'] ?? '';
$statut   = $_GET['statut'] ?? '';
$priorite = $_GET['priorite'] ?? '';

$tasks = filterTasks($keyword, $statut, $priorite);

// -------------------
// POUR MODIFICATION
// -------------------
$editTask = null;
if (isset($_GET['id'])) {
    foreach ($tasks as $t) {
        if ($t['id'] == $_GET['id']) {
            $editTask = $t;
            break;
        }
    }
}
