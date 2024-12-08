<?php

namespace App\Task\Infrastructure\Controller;

use App\Shared\Domain\Bus\Query\QueryBus;
use App\Task\Application\Detail\TaskDetailQuery;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

class DetailTaskController extends AbstractController
{
    #[Route('/detail/{id}', name: 'detail_task')]
    public function detail(int $id,QueryBus $commandBus): Response
    {
        $task = $commandBus->ask(new TaskDetailQuery($id));
        if (!$task)
            return $this->redirectToRoute('tasks_index');

        return $this->render('Task/detail_task.html.twig', [
            'task' => $task,
        ]);
    }
}