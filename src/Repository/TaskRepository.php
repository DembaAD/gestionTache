<?php
namespace App\Repository;

use App\Model\Task;
use PDO,PDOException;

class TaskRepository implements InterfaceRepository{
    private PDO $pdo;

    public function __construct() {
        try{
    $this->pdo = new PDO("mysql:host=localhost;dbname=test","root","",[
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_CLASS,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);
}catch(PDOException $e){
    return $e->getMessage();
}
    }

    public function findById($id)
    {
        $query = "SELECT * from tache WHERE id = ?";
        $statement = $this->pdo->prepare($query);
        $statement->execute([$id]);
    }
    public function create(Task $task){
        $query = "INSERT INTO tache(titre,description) VALUES (:titre,:description)";
       $statement = $this->pdo->prepare($query);
       $statement->execute([
        'titre' => $task->getTitre(),
        'description'=>$task->getDescription()
       ]);
    }
    
    public function delete($id){
        $query = "DELETE FROM tache WHERE identifiant = :id";
        $statement = $this->pdo->prepare($query);
        $statement->execute([
            'id'=>$id
        ]);
    }
    public function all()
    {
        $query = "SELECT * FROM tache";
        $statement = $this->pdo->prepare($query);
        $statement->setFetchMode(PDO::FETCH_CLASS, Task::class);
        $statement->fetchAll();
    }
    public function update($id)
    {
        $query = "UPDATE tache set titre = :titre, description = :description WHERE identifiant = :id";
        $statement = $this->pdo->prepare($query);
        $statement->execute([
            'titre' => $_POST['titre_task'],
            'description'=>$_POST['description_task'],
            'id'=>$id
        ]);
    }

}