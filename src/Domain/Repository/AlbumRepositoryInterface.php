<?php

namespace App\Domain\Repository;

use App\Domain\Model\Album\Album;

interface AlbumRepositoryInterface
{
    // public function get(int $albumId): Album;
    public function save(Album $album): Album;
    public function findById(int $albumId): ?Album;
    public function remove(Album $album): void;
    /** @return Album[] */
    public function findAll(): array;
}
