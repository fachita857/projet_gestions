<?php
define('JSON_FILE', __DIR__ . '/taks.json');

// Récupérer toutes les tâches
function getTasks() {
    if (!file_exists(JSON_FILE)) file_put_contents(JSON_FILE, json_encode([]));
    $tasks = json_decode(file_get_contents(JSON_FILE), true);
    return $tasks ?: [];
}

// Sauvegarder les tâches
function saveTasks($tasks) {
    file_put_contents(JSON_FILE, json_encode($tasks, JSON_PRETTY_PRINT));
}

// Ajouter une tâche
function addTask($titre, $description, $priorite, $date_limite, $responsable) {
    $tasks = getTasks();
    $id = !empty($tasks) ? max(array_column($tasks, 'id')) + 1 : 1;
    $tasks[] = [
        'id' => $id,
        'titre' => $titre,
        'description' => $description,
        'priorite' => $priorite,
        'statut' => 'à faire',
        'date_creation' => date('Y-m-d'),
        'date_limite' => $date_limite,
        'responsable' => $responsable
    ];
    saveTasks($tasks);
}

// Supprimer une tâche
function deleteTask($id) {
    $tasks = getTasks();
    $tasks = array_filter($tasks, fn($t) => $t['id'] != $id);
    saveTasks(array_values($tasks));
}

// Modifier une tâche
function updateTask($id, $titre, $description, $priorite, $date_limite, $statut) {
    $tasks = getTasks();
    foreach ($tasks as &$t) {
        if ($t['id'] == $id) {
            $t['titre'] = $titre;
            $t['description'] = $description;
            $t['priorite'] = $priorite;
            $t['date_limite'] = $date_limite;
            $t['statut'] = $statut;
            break;
        }
    }
    saveTasks($tasks);
}

// Changer le statut d'une tâche
function changeStatus($id) {
    $tasks = getTasks();
    foreach ($tasks as &$t) {
        if ($t['id'] == $id) {
            switch($t['statut']) {
                case 'à faire': $t['statut'] = 'en cours'; break;
                case 'en cours': $t['statut'] = 'terminée'; break;
            }
            break;
        }
    }
    saveTasks($tasks);
}

// Filtrer les tâches
function filterTasks($keyword = '', $statut = '', $priorite = '') {
    $tasks = getTasks();
    return array_filter($tasks, function($t) use ($keyword, $statut, $priorite) {
        $match = true;
        if ($keyword) $match = stripos($t['titre'], $keyword)!==false || stripos($t['description'], $keyword)!==false;
        if ($statut) $match = $match && $t['statut'] === $statut;
        if ($priorite) $match = $match && $t['priorite'] === $priorite;
        return $match;
    });
}

// Vérifier si une tâche est en retard
function isLate($task) {
    return $task['statut'] != 'terminée' && strtotime($task['date_limite']) < strtotime(date('Y-m-d'));
}
