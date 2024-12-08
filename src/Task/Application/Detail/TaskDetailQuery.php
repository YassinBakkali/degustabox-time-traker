<?php

declare(strict_types=1);

namespace App\Task\Application\Detail;

use App\Shared\Domain\Bus\Query\Query;

class TaskDetailQuery implements Query
{
    private int $id;
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }
}