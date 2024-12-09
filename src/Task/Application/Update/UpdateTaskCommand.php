<?php

declare(strict_types=1);

namespace App\Task\Application\Update;
use App\Shared\Domain\Bus\Command\Command;

class UpdateTaskCommand implements Command
{
    private int $id;
    private string|null $title;
    private string|null $description;

    private int|null $elapsedTime;

    public function __construct(int $id, string|null $title, string|null $description, int|null $elapsedTime){
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->elapsedTime = $elapsedTime;
    }

    public function getId(): int|null
    {
        return $this->id;
    }
    public function getTitle(): string|null
    {
        return $this->title;
    }

    public function getDescription(): string|null
    {
        return $this->description;
    }
    public function getElapsedTime(): int
    {
        return $this->elapsedTime;
    }
}