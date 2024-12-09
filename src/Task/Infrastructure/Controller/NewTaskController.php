<?php

namespace App\Task\Infrastructure\Controller;

use App\Shared\Domain\Bus\Command\CommandBus;
use App\Shared\Domain\Bus\Query\QueryBus;
use App\Task\Application\Find\FindTaskByTitleQuery;
use App\Task\Application\New\NewTaskCommand;
use App\Task\Domain\Responses\TaskResponse;
use App\Task\Infrastructure\Form\TaskType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class NewTaskController extends AbstractController
{
    #[Route('/new', name: 'new_task')]
    public function new(Request $request,CommandBus $commandBus, QueryBus $queryBus): Response
    {
        $form = $this->createForm(TaskType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $title = $data['title'];

            $task = $queryBus->ask(new FindTaskByTitleQuery($title));
            if ($task instanceof TaskResponse) {
                return $this->redirectToRoute('detail_task', ['id' => $task->getId()]);
            } else {
                $commandBus->dispatch(new NewTaskCommand($title));
                $task = $queryBus->ask(new FindTaskByTitleQuery($title));

                return $this->redirectToRoute('detail_task', ['id' => $task->getId()]);
            }
        }

        return $this->render('Task/new_task.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}