<?php

declare(strict_types=1);

namespace App\Task\Application\Detail;


use App\Shared\Domain\Bus\Query\QueryHandler;
use App\Task\Domain\Responses\TaskResponse;
use App\Task\Domain\TaskRepository;

class TaskDetailQueryHandler implements QueryHandler
{
    public function __construct(
        private readonly TaskDetailFinder $tasksFinder,
        private readonly TaskRepository $taskRepository
    )
    {}

    public function __invoke(TaskDetailQuery $query): TaskResponse|null
    {
        if ($this->checkIfExists($query->getId()))
            return $this->tasksFinder->__invoke($query->getId());
        {
            return null;
        }
    }

    private function checkIfExists(int $id): bool
    {
       return $this->taskRepository->findById($id) !== null;
    }

}