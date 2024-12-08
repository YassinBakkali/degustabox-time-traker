<?php

declare(strict_types=1);

namespace App\Task\Application\All;

use App\Task\Domain\Responses\TaskResponse;
use App\Task\Domain\Responses\TasksResponseCollection;
use App\Task\Domain\TaskRepository;


class AllTasksFinder
{
    public function __construct(private readonly TaskRepository $repository)
    {}

    public function __invoke(): TasksResponseCollection
    {
        $tasks = $this->repository->findAll();

        $taskResponses= [];
        foreach ($tasks as $task) {
            $taskResponses[] = $this->convertToResponse($task);
        }

        return TasksResponseCollection::create($taskResponses);
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