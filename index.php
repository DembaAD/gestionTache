<?php
require 'dossier_inclus\db.php';
$query = "SELECT * FROM tache;";
$statement = $pdo->prepare($query);
$statement->execute();
$taches = $statement->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceuil</title>
</head>

<body>
    <h2>Les taches disponibles</h2>
    <?php if(!empty($taches)) : ?>
    <?php foreach($taches as $task): ?>
    <ul>
        <li>Titre : <?= $task['titre']; ?> </li>
        <li>Description : <?= $task['description']; ?> </li>
        <a href="delete.php?id=<?=$task['identifiant'];?>" onclick="return confirm('Supprimer cette tâche ?');>Supprimer la tache</a></li>
        <a href="edit.php?id=<?=$task['identifiant'];?>">Modifier la tache</a></li>
    </ul>
    <?php endforeach; ?>
    <?php else: ?>
        <p>Votre liste de taches est vide, ajoutez-y une ou deux taches.</p>
    <?php endif ?>
   <a href="create.php">Ajouter une tache ici </a>
</body>
</html>