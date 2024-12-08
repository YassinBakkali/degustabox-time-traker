<?php

declare(strict_types=1);

namespace App\Task\Application\All;


use App\Shared\Domain\Bus\Query\QueryHandler;
use App\Task\Domain\Responses\TasksResponseCollection;

class AllTasksQueryHandler implements QueryHandler
{
    public function __construct(private readonly AllTasksFinder $tasksFinder)
    {}

    public function __invoke(AllTasksQuery $query): TasksResponseCollection
    {
       return $this->tasksFinder->__invoke();
    }
}