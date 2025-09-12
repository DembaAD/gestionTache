<?php
require 'vendor/autoload.php';
use App\Model\Task;
use App\Repository\TaskRepository;

if(isset($_GET['id'])){
    $id = $_GET['id'];
    if(!empty($_GET['id'])){
        $repository = new TaskRepository();
        $taskToEdit = $repository->findById($id);
        if(isset($_POST['titre_task'], $_POST['description_task'])){
            $taskToEdit->setTitre($_POST['titre_task'])
                        ->setDescription($_POST['description_task']);
            $repository->update($id, $taskToEdit);
         header(
        'Location: index.php'
       );
       exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Modifier des taches</title>
</head>
<div class="container mt-5">
<h2>Formulaire d'ajout d'une tache:</h2>
 <p>Modifier la tache</p>
    <form action="" method="post" class="form-group">
        <input type="text" class="form-control" name="titre_task" placeholder="Titre de la tache" value="<?= $taskToEdit->getTitre() ?>"><br>
       <textarea rows="4" class="form-control"  cols="50" name="description_task"  placeholder="Entrez une tache"> <?= $taskToEdit->getDescription(); ?>
       </textarea>
           <button class="btn btn-primary mt-3" type="submit">Enregistrer</button>
    </form>
</div>