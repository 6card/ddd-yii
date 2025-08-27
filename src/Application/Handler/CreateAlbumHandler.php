<?php

namespace App\Application\Handler;

use App\Application\Command\CreateAlbumCommand;
use App\Domain\Model\Album\Album;
use App\Domain\Repository\AlbumRepositoryInterface;

class CreateAlbumHandler
{
    public function __construct(private readonly AlbumRepositoryInterface $albumRepository)
    {

    }
    public function handle(CreateAlbumCommand $command)
    {
        $album = Album::create($command->title, $command->date);

        $this->albumRepository->save($album);
    }
}
