<?php

declare(strict_types=1);

namespace App\Task\Application\New;
use App\Shared\Domain\Bus\Command\Command;

class NewTaskCommand implements Command
{
    private string $title;
    private string $description;

    public function __construct(string $title, string $description){
        $this->title = $title;
        $this->description = $description;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}