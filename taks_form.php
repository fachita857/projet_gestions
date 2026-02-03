<div class="container mt-5">
    <h2 class="mb-4"><?= isset($editTask) ? "Modifier une tâche" : "Ajouter une tâche" ?></h2>

    <form method="post" action="index.php?page=taks_form<?= isset($editTask) ? '&id='.$editTask['id'] : '' ?>" class="p-4 bg-light rounded shadow">
        <input type="hidden" name="id" value="<?= $editTask['id'] ?? '' ?>">

        <div class="mb-3">
            <label class="form-label">Titre</label>
            <input type="text" class="form-control" name="titre" required value="<?= $editTask['titre'] ?? '' ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" name="description" rows="3" required><?= $editTask['description'] ?? '' ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Priorité</label>
            <select class="form-select" name="priorite" required>
                <option value="basse" <?= isset($editTask) && $editTask['priorite']=='basse'?'selected':'' ?>>Basse</option>
                <option value="moyenne" <?= isset($editTask) && $editTask['priorite']=='moyenne'?'selected':'' ?>>Moyenne</option>
                <option value="haute" <?= isset($editTask) && $editTask['priorite']=='haute'?'selected':'' ?>>Haute</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Date limite</label>
            <input type="date" class="form-control" name="date_limite" required value="<?= $editTask['date_limite'] ?? '' ?>">
        </div>

        <?php if(!isset($editTask)): ?>
        <div class="mb-3">
            <label class="form-label">Responsable</label>
            <input type="text" class="form-control" name="responsable" required>
        </div>
        <?php endif; ?>

        <div class="mb-3">
            <label class="form-label">Statut</label>
            <select class="form-select" name="statut">
                <option value="à faire" <?= isset($editTask) && $editTask['statut']=='à faire'?'selected':'' ?>>À faire</option>
                <option value="en cours" <?= isset($editTask) && $editTask['statut']=='en cours'?'selected':'' ?>>En cours</option>
                <option value="terminée" <?= isset($editTask) && $editTask['statut']=='terminée'?'selected':'' ?>>Terminée</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary"><?= isset($editTask) ? "Modifier" : "Ajouter" ?></button>
    </form>
</div>
