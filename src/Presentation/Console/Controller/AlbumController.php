<?php

namespace App\Presentation\Console\Controller;

use App\Application\Command\AddPhotoCommand;
use App\Application\Command\CreateAlbumCommand;
use App\Application\Command\DeleteAlbumCommand;
use App\Application\Command\RemovePhotoCommand;
use App\Application\Command\UpdatePhotoCommand;
use App\Application\Handler\CreateAlbumHandler;
use App\Application\Service\AlbumService;
use App\Domain\Repository\AlbumRepositoryInterface;
use App\Infrastructure\Persistence\Mapper\AlbumMapper;
use App\Infrastructure\Persistence\Repository\AlbumRepository;
use yii\console\ExitCode;
use yii\helpers\Console;
use yii\console\widgets\Table;

class AlbumController extends \yii\console\Controller
{
    private readonly AlbumService $albumService;
    private readonly AlbumRepository $albumRepository;

    public function __construct($id, $module, AlbumRepositoryInterface $albumRepository, AlbumService $albumService, $config = [])
    {
        $this->albumRepository = $albumRepository;
        $this->albumService = $albumService;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
        $albums = $this->albumService->getAllAlbums();

        // Using static widget method
        $table = Table::widget([
            'headers' => ['#', 'title', 'date', 'created_at', 'updaed_at', 'count photos'],
            'rows' => array_map(fn($a) => [$a->getId(), $a->getTitle(), $a->getDate()->format('d.m.Y H:i:s'), $a->getCreatedAt()->format('d.m.Y H:i:s'), $a->getUpdatedAt()->format('d.m.Y H:i:s'), count($a->getPhotos())], $albums),
        ]);

        $this->stdout($table);
        return ExitCode::OK;
    }

    public function actionCreate()
    {
        $command = new CreateAlbumCommand("test", new \DateTimeImmutable());
        $album = $this->albumService->createAlbum($command);
        $this->stdout(sprintf("✓ Create album #%d DONE\n", $album->getId()), Console::FG_GREEN);

       return ExitCode::OK;
    }

    public function actionAddPhoto(string $albumId)
    {
        if (empty($albumId)) {
            throw new \RuntimeException("Id must be a number");
        }

        $command = new AddPhotoCommand(intval($albumId), "test_filename", "test_url");
        $this->albumService->addPhoto($command);
        $this->stdout(sprintf("✓ Add photo to album #%d DONE\n", $albumId), Console::FG_GREEN);

       return ExitCode::OK;
    }

    public function actionUpdatePhoto(string $albumId, string $id)
    {
        if (empty($id) || empty($albumId)) {
            throw new \RuntimeException("Id and albumId must be a number");
        }

        $command = new UpdatePhotoCommand(intval($id), intval($albumId), "test2", "url2");
        $this->albumService->updatePhoto($command);
        $this->stdout(sprintf("✓ Remove photo #%d from album #%d DONE\n", $id, $albumId), Console::FG_GREEN);

       return ExitCode::OK;
    }

    public function actionRemovePhoto(string $albumId, string $id)
    {
        if (empty($id) || empty($albumId)) {
            throw new \RuntimeException("Id and albumId must be a number");
        }

        $command = new RemovePhotoCommand(intval($id), intval($albumId));
        $this->albumService->removePhoto($command);
        $this->stdout(sprintf("✓ Remove photo #%d from album #%d DONE\n", $id, $albumId), Console::FG_GREEN);

       return ExitCode::OK;
    }

    public function actionView(string $id)
    {
        if (empty($id)) {
            throw new \RuntimeException("Id must be a number");
        }

        $album = $this->albumRepository->findById($id);
        $this->stdout($album->getTitle() . PHP_EOL);
        $table = Table::widget([
            'headers' => ['#', 'filename', 'url'],
            'rows' => array_map(fn($p) => [$p->getId(), $p->getFilename(), $p->getUrl()], $album->getPhotos()),
        ]);

        $this->stdout($table);

       return ExitCode::OK;
    }

    public function actionDelete(string $id)
    {
        if (empty($id)) {
            throw new \RuntimeException("Id must be a number");
        }
        $command = new DeleteAlbumCommand(intval($id));
        $this->albumService->deleteAlbum($command);
        $this->stdout(sprintf("✓ Delete album #%s DONE\n", $id), Console::FG_GREEN);

       return ExitCode::OK;
    }
}
