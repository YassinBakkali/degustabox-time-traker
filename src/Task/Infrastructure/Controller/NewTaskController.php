<?php

namespace App\Task\Infrastructure\Controller;

use App\Shared\Domain\Bus\Command\CommandBus;
use App\Task\Application\New\NewTask;
use App\Task\Application\New\NewTaskCommand;
use App\Task\Domain\Task;
use App\Task\Infrastructure\Form\TaskType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class NewTaskController extends AbstractController
{
    #[Route('/new', name: 'new_task')]
    public function new(Request $request,CommandBus $commandBus): Response
    {
        $form = $this->createForm(TaskType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $commandBus->dispatch(new NewTaskCommand($data["title"], $data["description"]));
        }

        return $this->render('Task/new_task.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}