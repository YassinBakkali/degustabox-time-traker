<?php

namespace App\Task\Infrastructure\Controller;

use App\Shared\Domain\Bus\Command\CommandBus;
use App\Task\Application\Update\UpdateTaskCommand;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

class UpdateTaskController extends AbstractController
{
    #[Route('/update/{id}', name: 'update_task')]
    public function update(int $id, Request $request, CommandBus $commandBus): JsonResponse
    {
        $accumulatedSeconds = $request->request->get('accumulatedSeconds');
        $commandBus->dispatch(
            new UpdateTaskCommand($id, null,null, $accumulatedSeconds)
        );

        return new JsonResponse(['status' => 'success']);
    }
}