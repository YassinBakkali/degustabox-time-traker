<?php

declare(strict_types=1);

namespace App\Task\Application\Find;

use App\Task\Domain\Responses\TaskResponse;
use App\Task\Domain\TaskRepository;


class FindTaskByTitleFinder
{
    public function __construct(private readonly TaskRepository $repository)
    {}

    public function __invoke(string $title): TaskResponse
    {
        $task = $this->repository->findByTitle($title);
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
            $task->getElapsedTime(),
            $task->getElapsedTimeToday(),
        );
    }
}