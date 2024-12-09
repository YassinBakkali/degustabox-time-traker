<?php

declare(strict_types=1);

namespace App\Task\Application\Find;

use App\Shared\Domain\Bus\Query\Query;

class FindTaskByTitleQuery implements Query
{
    private string $title;
    public function __construct(string $title)
    {
        $this->title = $title;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }


}