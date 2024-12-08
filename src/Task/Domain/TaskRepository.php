<?php

declare(strict_types=1);

namespace App\Task\Domain;

interface TaskRepository {
    public function save(Task $task): void;
    public function findAll(): array;
    public function findById(int $id): ?Task;
}