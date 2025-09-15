<?php
namespace App\Controller;

use App\Model\Task;
use App\Repository\TaskRepository;

class TaskController extends Controller {

    public function index(){
        $repoTask = new TaskRepository();
        $taches = $repoTask->all();
        $this->render('Views/index.html.twig',[
            'taches'=> $taches,
        ]);
    }
    public function create(){
        $tache = new Task();
        $repository = new TaskRepository();
        if(isset($_POST['titre_task'],$_POST['description_task'])){
            if (!empty((($_POST['titre_task'])) && ($_POST['description_task']))){
                $tache->setTitre($_POST['titre_task'])
                ->setCreatedAt('now')
                ->setDescription($_POST['description_task']);
                $repository->create($tache);
                header('Location: /index.php');
                exit;
            }
        }
        $this->render('/Views/create.html.twig',[
            'tache'=>$tache,
            'get'=>$_GET,
            'post'=>$_POST
        ]);
    }
    public function delete(){
        $identifiant = $_GET['id'];
        if(!isset($identifiant)){
            header('Location: /index.php');
            exit();
        }
        $repoTask = new TaskRepository();
        $repoTask->delete($identifiant);
        header('Location: /index.php');
        exit();
    }
    
}