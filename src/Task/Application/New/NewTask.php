<?php

declare(strict_types=1);

namespace App\Task\Application\New;

use App\Task\Domain\Task;
use App\Task\Domain\TaskRepository;

class NewTask
{
    public function __construct(
        private readonly TaskRepository $repository
    ) {}

    public function __invoke(string $title, string $description): void
    {
        $this->repository->save(new Task($title, $description));
    }
}