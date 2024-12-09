<?php

declare(strict_types=1);

namespace App\Task\Application\Update;

use App\Shared\Domain\Bus\Command\CommandHandler;
use App\Task\Domain\TaskRepository;

class UpdateTaskCommandHandler implements CommandHandler
{
    public function __construct(
        private readonly UpdateTask $newTask,
        private readonly TaskRepository $taskRepository
    ){}

    public function __invoke(UpdateTaskCommand $command): void {

        if ($this->checkIfExists($command->getId()))
            $this->newTask->__invoke(
                $command->getId(),
                $command->getTitle(),
                $command->getDescription(),
                $command->getElapsedTime()
            );
    }

    private function checkIfExists(int $id): bool
    {
        return $this->taskRepository->findById($id) !== null;
    }
}