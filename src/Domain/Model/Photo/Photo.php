<?php

namespace App\Domain\Model\Photo;

use App\Domain\Model\Album\Album;
use DateTimeImmutable;

final class Photo
{
    private ?int $id = null;
    private string $filename;
    private string $url;
    private DateTimeImmutable $createdAt;
    private DateTimeImmutable $updatedAt;

    private function __construct(string $filename, string $url, ?DateTimeImmutable $createdAt = null, ?DateTimeImmutable $updatedAt = null)
    {
        $this->filename = $filename;
        $this->url = $url;
        $this->createdAt = $createdAt ?? new \DateTimeImmutable();
        $this->updatedAt = $updatedAt ?? new \DateTimeImmutable();
    }

    public static function create(string $filename, string $url)
    {
        return new self($filename, $url);
    }

    public function update(string $filename, string $url)
    {
        $this->filename = $filename;
        $this->url = $url;
    }

    public static function reconstitute(int $id, string $filename, string $url, DateTimeImmutable $createdAt, DateTimeImmutable $updatedAt): self
    {
        $photo = new self($filename, $url, $createdAt, $updatedAt);
        $photo->setId($id);

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

    public function setId(int $id): void
    {
        if ($this->id !== null) {
            throw new \LogicException('ID уже установлен.');
        }
        $this->id = $id;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function isCover(?int $coverId): bool
    {
        return $this->id === (int)$coverId;
    }

}
