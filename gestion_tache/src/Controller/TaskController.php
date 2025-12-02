<?php

namespace App\Controller;

use App\Entity\Task;
use App\Form\TaskType;
use App\Repository\TaskRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Requirement\EnumRequirement;

#[Route('task', name: 'task.')]
final class TaskController extends AbstractController
{
    #[Route('/', name: 'all')]
    public function index(TaskRepository $taskRepository): Response
    {
        $tasks = $taskRepository->findAll();

        return $this->render('task/index.html.twig', [
            'tasks' => $tasks
        ]);
    }

    #[Route('/create', name: 'create')]
    public function create(Request $request, EntityManagerInterface $entityManager){
        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){
            $task->setCreatedAt(new DateTimeImmutable("now"));
            $task->setIsDone(false);
            $entityManager->persist($task);
            $entityManager->flush();
            return $this->redirectToRoute('task.all');
        }

        return $this->render('task/create.html.twig', [
            'task' => $task,
            'form' => $form
        ]);
    }

    #[Route('/update/{id}', name: 'update')]
    public function edit(Request $request,Task $task, EntityManagerInterface $entityManager){
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if($form->isSubmitted()  && $form->isValid()){
            $entityManager->flush($task);

            return $this->redirectToRoute('task.all');
        }

        return $this->render('task/edit.html.twig', [
            'task' => $task,
            'form' => $form
        ]);
    }

    #[Route('/delete/{id}', name: 'delete')]
    public function delete(Task $task, EntityManager $entityManager){
        $entityManager->remove($task);
        $entityManager->flush();
        return $this->redirectToRoute('task.all');
    }
    
}
