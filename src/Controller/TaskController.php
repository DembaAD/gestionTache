<?php
namespace App\Controller;

use App\Model\Task;
use App\Repository\TaskRepository;

class TaskController extends Controller {

    public function index() {
        $repoTask = new TaskRepository();
        $taches = $repoTask->all();

        // Chemin relatif au dossier Views défini dans le loader
        $this->render('index.html.twig', [
            'taches' => $taches,
        ]);
    }

    public function create() {
        $tache = new Task();
        $repository = new TaskRepository();

        if (isset($_POST['titre_task'], $_POST['description_task'])) {
            if (!empty($_POST['titre_task']) && !empty($_POST['description_task'])) {
                $tache->setTitre($_POST['titre_task'])
                      ->setCreatedAt('now')
                      ->setDescription($_POST['description_task']);

                $repository->create($tache);
                header('Location: /');
                exit;
            }
        }

        $this->render('create.html.twig', [
            'tache' => $tache,
            'get' => $_GET,
            'post' => $_POST
        ]);
    }

    public function delete() {
        if (!isset($_GET['id'])) {
            header('Location: /');
            exit();
        }

        $identifiant = $_GET['id'];
        $repoTask = new TaskRepository();
        $repoTask->delete($identifiant);

        header('Location: /');
        exit();
    }
}
