<?php
include_once __DIR__ . "/function.php";

// Récupérer toutes les tâches
$tasks = getTasks();

// Calcul des statistiques
$tasks_total = count($tasks);
$tasks_done  = count(array_filter($tasks, fn($t) => $t['statut'] === 'terminée'));
$tasks_late  = count(array_filter($tasks, fn($t) => isLate($t)));
$tasks_percent_done = $tasks_total > 0 ? round(($tasks_done / $tasks_total) * 100, 2) : 0;

// On stocke dans un tableau pour que la page HTML puisse l'afficher
$dashboard_stats = [
    'total' => $tasks_total,
    'done' => $tasks_done,
    'percent_done' => $tasks_percent_done,
    'late' => $tasks_late
];
?>
