<?php

namespace App\Domain\Repository;

use App\Domain\Model\Share\Share;

interface ShareRepositoryInterface
{
    public function findById(int $id): ?Share;
    public function findByAlbumId(int $albumId): array;
    public function findByUuid(string $id): ?Share;
    public function save(Share $share): Share;
    public function remove(Share $share): void;
}
