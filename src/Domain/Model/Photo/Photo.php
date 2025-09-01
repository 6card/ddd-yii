<?php

namespace App\Domain\Model\Photo;

use DateTimeImmutable;

final class Photo
{
    private ?int $id;
    private string $filename;
    private string $url;
    private DateTimeImmutable $createdAt;
    private DateTimeImmutable $updatedAt;

    private function __construct(?int $id, string $filename, string $url, ?DateTimeImmutable $createdAt = null, ?DateTimeImmutable $updatedAt = null)
    {
        $this->id = $id;
        $this->filename = $filename;
        $this->url = $url;
        $this->createdAt = $createdAt ?? new \DateTimeImmutable();
        $this->updatedAt = $updatedAt ?? new \DateTimeImmutable();
    }

    public static function create(string $filename, string $url)
    {
        return new self(null, $filename, $url);
    }

    public function update(string $filename, string $url)
    {
        $this->filename = $filename;
        $this->url = $url;
    }

    public static function reconstitute(int $id, string $filename, string $url, DateTimeImmutable $createdAt, DateTimeImmutable $updatedAt): self
    {
        $photo = new self($id, $filename, $url, $createdAt, $updatedAt);

        return $photo;
    }

    public function getFilename(): string
    {
        return $this->filename;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function isCover(?int $coverId): bool
    {
        return $this->id === (int)$coverId;
    }

}
