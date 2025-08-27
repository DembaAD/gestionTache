<?php
require 'dossier_inclus\db.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
    if(!empty($_GET['id'])){
        $queryFetch = "SELECT * from tache WHERE identifiant =:id";
        $statement = $pdo->prepare($queryFetch);
        $statement->execute([
            'id' => $_GET['id']
        ]);
        $tache = $statement->fetch();
        if(isset($_POST['titre_task'], $_POST['description_task'])){
            $query = "UPDATE tache set titre = :titre, description = :description WHERE identifiant = :id";
        $statement = $pdo->prepare($query);
        $statement->execute([
            'titre' => $_POST['titre_task'],
            'description'=>$_POST['description_task'],
            'id'=>$id
        ]);
         header(
        'Location: index.php'
       );
       exit;
        }
    }
}
?>
<title>Modifier des taches</title>
<h2>Formulaire d'ajout d'une tache:</h2>
 <p>Modifier la tache</p>
    <form action="" method="post">
        <input type="text" name="titre_task" placeholder="Titre de la tache" value="<?= $tache['titre'] ?>"><br>
       <textarea rows="4" cols="50" name="description_task"  placeholder="Entrez une tache"> <?= $tache['description'];?>
       </textarea>
       <br>
       <button type="submit">Enregistrer</button>
    </form>