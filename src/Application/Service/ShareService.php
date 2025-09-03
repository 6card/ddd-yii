<?php

namespace App\Application\Service;

use App\Application\Command\CreateShareCommand;
use App\Application\Command\RemoveShareCommand;
use App\Domain\Model\Share\Share;
use App\Domain\Model\Album\AlbumTitle;
use App\Domain\Repository\ShareRepositoryInterface;
use App\Application\Storage\PhotoStorageInterface;
use App\Domain\Repository\AlbumRepositoryInterface;

class ShareService
{
    public function __construct(private readonly AlbumRepositoryInterface $albumRepository, private readonly ShareRepositoryInterface $shareRepository)
    {
    }

    public function createShare(CreateShareCommand $command): Share
    {
        if (!$album = $this->albumRepository->findById($command->albumId))
        {
            throw new \DomainException("Album not found");
        }
        $share = Share::create($album->getId());
        return $this->shareRepository->save($share);
    }

    public function removeShare(RemoveShareCommand $command): void
    {
        if (!$share = $this->shareRepository->findById($command->id))
        {
            throw new \DomainException("Album not found");
        }
        $this->shareRepository->remove($share);
    }

}
