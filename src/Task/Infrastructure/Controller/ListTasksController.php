<?php

namespace App\Task\Infrastructure\Controller;

use App\Shared\Domain\Bus\Query\QueryBus;
use App\Task\Application\All\AllTasksQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ListTasksController extends AbstractController
{
    #[Route('/tasks', name: 'tasks_index')]
    public function index(QueryBus $queryBus): Response
    {
        $tasksResponse = $queryBus->ask(new AllTasksQuery());

        return $this->render('Task/list_tasks.html.twig', [
            'tasks' => $tasksResponse->getTasksResponse(),
        ]);
    }
}