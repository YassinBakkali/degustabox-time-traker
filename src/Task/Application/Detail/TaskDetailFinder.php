<?php

declare(strict_types=1);

namespace App\Task\Application\Detail;

use App\Task\Domain\Responses\TaskResponse;
use App\Task\Domain\TaskRepository;


class TaskDetailFinder
{
    public function __construct(private readonly TaskRepository $repository)
    {}

    public function __invoke(int $id): TaskResponse
    {
        $task = $this->repository->findById($id);
        return $this->convertToResponse($task);
    }

    private function convertToResponse($task): TaskResponse
    {
        return TaskResponse::create(
            $task->getId(),
            $task->getTitle(),
            $task->getDescription(),
            $task->getCreatedAt(),
            $task->getUpdatedAt(),
            $task->getElapsedTime()
        );
    }
}