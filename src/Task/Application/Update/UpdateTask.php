<?php

declare(strict_types=1);

namespace App\Task\Application\Update;

use App\Task\Domain\Task;
use App\Task\Domain\TaskRepository;

class UpdateTask
{
    public function __construct(
        private readonly TaskRepository $repository
    ) {}

    public function __invoke(int $id, string|null $title, string|null $description, int|null $elapsedTime): void
    {
        $task = $this->repository->findById($id);
        $task->setTitle($title ?? $task->getTitle());
        $task->setDescription($description ?? $task->getDescription());
        $task->setElapsedTime($elapsedTime ?? $task->getElapsedTime());

        $this->repository->save($task);
    }
}