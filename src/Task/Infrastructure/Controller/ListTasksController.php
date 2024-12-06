<?php

namespace App\Task\Infrastructure\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ListTasksController extends AbstractController
{
    #[Route('/tasks', name: 'tasks_index')]
    public function index(): Response
    {


        return $this->render('Task/list_tasks.html.twig', []);
    }
}