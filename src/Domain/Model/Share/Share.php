<?php

namespace App\Domain\Model\Share;

class Share
{
    private ?int $id;
    private int $albumId;
    private ShareUuid $uuid;

    private function __construct(?int $id, int $albumId, ShareUuid $uuid)
    {
        $this->id = $id;
        $this->albumId = $albumId;
        $this->uuid = $uuid;
    }

    public static function create(int $albumId): self
    {
        $uuid = new ShareUuid();
        return new self(null, $albumId, $uuid);
    }

    public static function reconstitute(int $id, int $albumId, ShareUuid $uuid): self
    {
        return new self($id, $albumId, $uuid);
    }

    public function rebuildUuid(): void
    {
        $this->uuid = new ShareUuid();
    }

    public function getAlbumId(): int
    {
        return $this->albumId;
    }

    public function getUuid(): ShareUuid
    {
        return $this->uuid;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}
