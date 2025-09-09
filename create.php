<?php
require 'dossier_inclus/db.php';
if(isset($_POST['titre_task'],$_POST['description_task'])){
    if (!empty((($_POST['titre_task'])) && ($_POST['description_task']))){
       header('Location: /index.php');
       exit;
    }
}
?>
<title>Ajouter des taches</title>
<h2>Formulaire d'ajout d'une tache:</h2>
 <p>Ajouter une tache ci-apres:</p>
    <form action="" method="post">
        <input type="text" name="titre_task" placeholder="Titre de la tache"><br>
       <textarea rows="4" cols="50" name="description_task"  placeholder="Entrez une tache">
       </textarea>
       <br>
       <button type="submit">Enregistrer</button>
    </form>