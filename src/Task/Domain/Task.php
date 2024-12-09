<?php

declare(strict_types=1);

namespace App\Task\Domain;

class Task
{
    private int $id;
    private string $title;
    private string $description;
    private \DateTime $createdAt;
    private \DateTime|null $updatedAt;
    private int $elapsedTime = 0;
    private int $elapsedTimeToday = 0;

    public function __construct(string $title = '', string $description = '')
    {
        $this->title = $title;
        $this->description = $description;
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): \DateTime|null
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTime|null $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function getElapsedTime(): int
    {
        return $this->elapsedTime;
    }

    public function setElapsedTime(int $elapsedTime): void
    {
        $this->elapsedTime = $elapsedTime;
    }

    public function getElapsedTimeToday(): int
    {
        return $this->elapsedTimeToday;
    }

    public function setElapsedTimeToday(int $elapsedTimeToday): void
    {
        $this->elapsedTimeToday = $elapsedTimeToday;
    }

}
