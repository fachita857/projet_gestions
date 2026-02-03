<div class="container mt-4">
    <h2 class="mb-4">Liste des tâches</h2>

    <?php if(isset($_GET['msg'])): ?>
        <div class="alert alert-success">
            <?= $_GET['msg']=='ajout'?'Ajout réussi !':'Modification réussie !' ?>
        </div>
    <?php endif; ?>

    <!-- Filtre -->
    <form method="get" action="index.php" class="row g-3 mb-3">
        <input type="hidden" name="page" value="taks_liste">
        <div class="col-md-4">
            <input type="text" class="form-control" name="keyword" placeholder="Rechercher..." value="<?= htmlspecialchars($keyword) ?>">
        </div>
        <div class="col-md-3">
            <select class="form-select" name="statut">
                <option value="">--Statut--</option>
                <option value="à faire" <?= $statut=='à faire'?'selected':'' ?>>À faire</option>
                <option value="en cours" <?= $statut=='en cours'?'selected':'' ?>>En cours</option>
                <option value="terminée" <?= $statut=='terminée'?'selected':'' ?>>Terminée</option>
            </select>
        </div>
        <div class="col-md-3">
            <select class="form-select" name="priorite">
                <option value="">--Priorité--</option>
                <option value="basse" <?= $priorite=='basse'?'selected':'' ?>>Basse</option>
                <option value="moyenne" <?= $priorite=='moyenne'?'selected':'' ?>>Moyenne</option>
                <option value="haute" <?= $priorite=='haute'?'selected':'' ?>>Haute</option>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-secondary w-100">Filtrer</button>
        </div>
    </form>

    <!-- Tableau des tâches -->
    <table class="table table-striped table-hover bg-white rounded shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>Titre</th>
                <th>Description</th>
                <th>Priorité</th>
                <th>Statut</th>
                <th>Date limite</th>
                <th>Responsable</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php if(empty($tasks)): ?>
            <tr><td colspan="7" class="text-center">Aucune tâche</td></tr>
        <?php else: ?>
            <?php foreach($tasks as $t): ?>
            <tr class="<?= isLate($t)?'table-danger':'' ?>">
                <td><?= htmlspecialchars($t['titre']) ?></td>
                <td><?= htmlspecialchars($t['description']) ?></td>
                <td><?= $t['priorite'] ?></td>
                <td><?= $t['statut'] ?></td>
                <td><?= $t['date_limite'] ?></td>
                <td><?= htmlspecialchars($t['responsable']) ?></td>
                <td>
                    <a href="index.php?page=taks_form&id=<?= $t['id'] ?>" class="btn btn-sm btn-primary">Modifier</a>
                    <a href="index.php?page=taks_liste&action=changer_statut&id=<?= $t['id'] ?>" class="btn btn-sm btn-warning">Statut</a>
                    <a href="index.php?page=taks_liste&action=supprimer&id=<?= $t['id'] ?>" onclick="return confirm('Supprimer ?')" class="btn btn-sm btn-danger">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
</div>
