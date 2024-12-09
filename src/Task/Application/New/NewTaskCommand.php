<?php

declare(strict_types=1);

namespace App\Task\Application\New;
use App\Shared\Domain\Bus\Command\Command;

class NewTaskCommand implements Command
{
    private string $title;

    public function __construct(string $title){
        $this->title = $title;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
}