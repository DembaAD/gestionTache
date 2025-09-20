<?php
namespace App\Repository;

use App\Model\Task;
use DateTime;
use Dotenv\Dotenv;
use PDO,PDOException;

class TaskRepository implements InterfaceRepository{
    private PDO $pdo;

    public function __construct() {
        $dotenv = Dotenv::createImmutable(dirname(__DIR__));
        $dotenv->load();
        try{
             $this->pdo = new PDO("mysql:host=" . $_ENV['DB_HOST'] . ";dbname=" . $_ENV['DB_NAME'],$_ENV['DB_USER'],$_ENV['DB_PASSWORD'],[
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]); 
        }
       catch(PDOException $e){
        throw $e;
    }
}
    public function findById($identifiant): ?Task
    {
        $query = "SELECT * from tache WHERE identifiant = ?";
        $statement = $this->pdo->prepare($query);
        $statement->execute([$identifiant]);
        $row = $statement->fetch(); 
        return $this->hydrateTask($row);
       
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
        $query = "SELECT * FROM tache;";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        $rows =  $statement->fetchAll();
        return array_map(fn($rows) => $this->hydrateTask($rows), $rows);
    }
    public function update($id, Task $taskToEdit)
    {
        $query = "UPDATE tache set titre = :titre, description = :description WHERE identifiant = :id";
        $statement = $this->pdo->prepare($query);
        $statement->execute([
            'titre' => $taskToEdit->getTitre(),
            'description'=>$taskToEdit->getDescription(),
            'id'=>$id
        ]);
    }
    public function hydrateTask(array $data): Task {
        $task = new Task();
        $task->setIdentifiant((int)$data['identifiant'])
            ->setTitre($data['titre'])
            ->setDescription($data['description'])
            ->setCreatedAt(new DateTime($data['createdAt']));
        return $task;
    }

}