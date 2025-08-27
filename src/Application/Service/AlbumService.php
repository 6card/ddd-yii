<?php

namespace App\Application\Service;

use App\Application\Command\AddPhotoCommand;
use App\Application\Command\AddPhotosCommand;
use App\Application\Command\ClearCoverCommand;
use App\Application\Command\CreateAlbumCommand;
use App\Application\Command\DeleteAlbumCommand;
use App\Application\Command\RemovePhotoCommand;
use App\Application\Command\SetCoverCommand;
use App\Application\Command\UpdateAlbumCommand;
use App\Application\Command\UpdatePhotoCommand;
use App\Domain\Model\Album\Album;
use App\Domain\Model\Album\AlbumTitle;
use App\Domain\Repository\AlbumRepositoryInterface;
use App\Application\Storage\PhotoStorageInterface;

class AlbumService
{

    public function __construct(private readonly AlbumRepositoryInterface $albumRepository, private readonly PhotoStorageInterface $photoStorage)
    {
    }

    public function createAlbum(CreateAlbumCommand $command): Album
    {
        $album = Album::create(new AlbumTitle($command->title), $command->date);
        foreach($command->photosData as $photoData) {
            $savedFileName = $this->photoStorage->save($photoData);
            $album->addPhoto($savedFileName, "random1");
        }
        return $this->albumRepository->save($album);
    }

    public function updateAlbum(UpdateAlbumCommand $command): Album
    {
        if (!$album = $this->albumRepository->findById($command->id)) {
            throw new \DomainException('Album not found');
        }
        $album->edit(new AlbumTitle($command->title), $command->date);
        // foreach($command->photosData as $photoData) {
        //     $savedFileName = $this->photoStorage->save($photoData);
        //     $album->addPhoto($savedFileName, "random1");
        // }
        return $this->albumRepository->save($album);
    }

    public function deleteAlbum(DeleteAlbumCommand $command): void
    {
        if(!$album = $this->albumRepository->findById($command->id)) {
            throw new \RuntimeException('Album not found.');
        }
        $this->albumRepository->remove($album);
    }

    public function addPhoto(AddPhotosCommand $command): void
    {
        if(!$album = $this->albumRepository->findById($command->albumId)) {
            throw new \RuntimeException('Album not found.');
        }
        foreach($command->photosData as $photoData) {
            $savedFileName = $this->photoStorage->save($photoData);
            $album->addPhoto($savedFileName, "random1");
        }
        $this->albumRepository->save($album);
    }

    public function updatePhoto(UpdatePhotoCommand $command): void
    {
        if(!$album = $this->albumRepository->findById($command->albumId)) {
            throw new \RuntimeException('Album not found.');
        }
        $album->updatePhoto($command->id, $command->filename, $command->url);
        $this->albumRepository->save($album);
    }

    public function removePhoto(RemovePhotoCommand $command): void
    {
        if(!$album = $this->albumRepository->findById($command->albumId)) {
            throw new \RuntimeException('Album not found.');
        }
        $filename = $album->removePhoto($command->id);
        $this->photoStorage->delete($filename);
        $this->albumRepository->save($album);
    }

    public function setCover(SetCoverCommand $command): void
    {
        if(!$album = $this->albumRepository->findById($command->albumId)) {
            throw new \RuntimeException('Album not found.');
        }
        $album->setCover($command->id);
        $this->albumRepository->save($album);
    }

    public function clearCover(ClearCoverCommand $command): void
    {
        if(!$album = $this->albumRepository->findById($command->id)) {
            throw new \RuntimeException('Album not found.');
        }
        $album->clearCover();
        $this->albumRepository->save($album);
    }

    /** @return Album[] */
    public function getAllAlbums(): array
    {
        return $this->albumRepository->findAll();
    }
}
