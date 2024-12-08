<?php

declare(strict_types=1);

namespace App\Task\Domain\Responses;

use App\Shared\Domain\Bus\Query\Response;

class TaskResponse implements Response {
    private int $id;
    private string $title;
    private string $description;
    private \DateTime $createdAt;
    private \DateTime|null $updatedAt;
    private int $elapsedTime;

    public static function create(
        int $id,
        string $title,
        string $description,
        \DateTime $createdAt,
        \DateTime|null $updatedAt,
        int $elapsedTime
    ): self {
        return (new self())
            ->setId($id)
            ->setTitle($title)
            ->setDescription($description)
            ->setCreatedAt($createdAt)
            ->setUpdatedAt($updatedAt)
            ->setElapsedTime($elapsedTime)
            ;
    }
    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): TaskResponse
    {
        $this->id = $id;
        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): TaskResponse
    {
        $this->title = $title;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
    public function setDescription(string $description): TaskResponse
    {
        $this->description = $description;
        return $this;
    }

    public function getCreatedAt(): \DateTime|null
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): TaskResponse
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTime $updatedAt): TaskResponse
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    public function getElapsedTime(): int
    {
        return $this->elapsedTime;
    }

    public function setElapsedTime(int $elapsedTime): TaskResponse
    {
        $this->elapsedTime = $elapsedTime;
        return $this;
    }
    public function getElapsedTimeFormatted(): string {
        $hours = intdiv($this->getElapsedTime(), 3600);
        $minutes = intdiv($this->getElapsedTime() % 3600, 60);
        $seconds = $this->getElapsedTime() % 60;

        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }

}