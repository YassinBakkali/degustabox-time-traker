<?php

declare(strict_types=1);

namespace App\Task\Infrastructure\Persistence\Doctrine;

use App\Task\Domain\Task;
use App\Task\Domain\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class DoctrineTaskRepository implements TaskRepository
{
    private EntityManagerInterface $entityManager;
    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    public function getEntityRepository(): EntityRepository
    {
        return $this->entityManager->getRepository(Task::class);
    }

    public function save(Task $task): void
    {
        $this->entityManager->persist($task);
        $this->entityManager->flush();
    }

    public function findById(int $id): ?Task {
        return $this->getEntityRepository()->find($id);
    }

    public function findAll(): array
    {
        return $this->getEntityRepository()->findAll();
    }
}