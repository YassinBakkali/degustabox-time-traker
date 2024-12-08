<?php

declare(strict_types=1);

namespace App\Task\Application\New;

use App\Shared\Domain\Bus\Command\CommandHandler;

class NewTaskCommandHandler implements CommandHandler
{
    public function __construct(
       private readonly NewTask $newTask
    ){}

    public function __invoke(NewTaskCommand $command): void {
        $this->newTask->__invoke($command->getTitle(), $command->getDescription());
    }
}