<?php

declare(strict_types=1);

namespace App\Task\Domain\Responses;

use App\Shared\Domain\Bus\Query\Response;

class TasksResponseCollection implements Response {

    private array $tasks_response;

    public static function create(array $tasks_response): self
    {
        return (new self())->setTasksResponse($tasks_response);
    }

    public function getTasksResponse(): array
    {
        return $this->tasks_response;
    }

    public function setTasksResponse(array $tasks_response): self
    {
        $this->tasks_response = $tasks_response;
        return $this;
    }
}