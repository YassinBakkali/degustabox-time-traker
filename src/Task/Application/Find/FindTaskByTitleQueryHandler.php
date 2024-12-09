<?php

declare(strict_types=1);

namespace App\Task\Application\Find;


use App\Shared\Domain\Bus\Query\QueryHandler;
use App\Task\Domain\Responses\TaskResponse;
use App\Task\Domain\TaskRepository;

class FindTaskByTitleQueryHandler implements QueryHandler
{
    public function __construct(
        private readonly FindTaskByTitleFinder $tasksFinder,
        private readonly TaskRepository $taskRepository
    )
    {}

    public function __invoke(FindTaskByTitleQuery $query): TaskResponse|null
    {
        if ($this->checkIfExists($query->getTitle()))
            return $this->tasksFinder->__invoke($query->getTitle());
        {
            return null;
        }
    }

    private function checkIfExists(string $title): bool
    {
        return $this->taskRepository->findByTitle($title) !== null;
    }

}