<?php
// URL du dossier public pour CSS / JS / images
$dossierpublic = "http://localhost/projet_gestion/public/";

// Inclure les parties communes (HTML)
include_once __DIR__ . "/include/header.php";
include_once __DIR__ . "/include/navbar.php";
include_once __DIR__ . "/include/sidebar.php";

// Inclure le backend PHP pour toutes les fonctions (CRUD, filtre, statut)
include_once __DIR__ . "/traitement/function.php";

// --- TRAITEMENT DES FORMULAIRES POST ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;

    if ($id) {
        // Modification d'une tâche
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
        // Ajout d'une tâche
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

// --- TRAITEMENT DES ACTIONS GET ---
if (isset($_GET['action'], $_GET['id'])) {
    $action = $_GET['action'];
    $id = $_GET['id'];

    if ($action === 'supprimer') deleteTask($id);
    if ($action === 'changer_statut') changeStatus($id);

    header("Location: index.php?page=taks_liste");
    exit;
}

// --- FILTRAGE DES TÂCHES POUR LA LISTE ---
$keyword  = $_GET['keyword'] ?? '';
$statut   = $_GET['statut'] ?? '';
$priorite = $_GET['priorite'] ?? '';
$tasks = filterTasks($keyword, $statut, $priorite);

// --- PRÉPARATION POUR MODIFICATION ---
$page = $_GET['page'] ?? 'dashboard';
$editTask = null;
if (isset($_GET['id'])) {
    foreach ($tasks as $t) {
        if ($t['id'] == $_GET['id']) {
            $editTask = $t;
            break;
        }
    }
}

// --- ROUTEUR ---
switch($page) {
    case 'taks_form':
        include __DIR__ . "/pages/taks_form.php";
        break;
    case 'taks_liste':
        include __DIR__ . "/pages/taks_liste.php";
        break;
    default:
        include __DIR__ . "/pages/dashboard.php";
        break;
}

// Inclure footer
include_once __DIR__ . "/include/footer.php";
?>
