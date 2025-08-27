<?php
require 'dossier_inclus\db.php';
if(isset($_GET['id'])){
    if(!empty($_GET['id'])){
        $id = $_GET['id'] ?? null;
        $query = "DELETE FROM tache WHERE identifiant = :id";
        $statement = $pdo->prepare($query);
        $statement->execute([
            'id'=>$id
        ]);
         header(
        'Location: index.php'
       );
       exit;
    }
}
