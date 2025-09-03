<?php

namespace admin\controllers;

use App\Application\Command\AddPhotosCommand;
use App\Application\Command\ClearCoverCommand;
use App\Application\Command\CreateAlbumCommand;
use App\Application\Command\RemovePhotoCommand;
use App\Application\Command\SetCoverCommand;
use App\Application\Command\UpdateAlbumCommand;
use App\Application\DTO\UploadedFileInfo;
use App\Application\Handler\CreateAlbumHandler;
use App\Application\Service\AlbumService;
use App\Domain\Repository\AlbumRepositoryInterface;
use App\Domain\Repository\ShareRepositoryInterface;
use App\Infrastructure\Persistence\Mapper\AlbumMapper;
use App\Infrastructure\Persistence\Repository\AlbumRepository;
use App\Presentation\Admin\Form\AddPhotosForm;
use App\Presentation\Admin\Form\CreateAlbumForm;
use App\Presentation\Admin\Form\UpdateAlbumForm;
use DateTimeImmutable;
use Yii;
use yii\web\NotFoundHttpException;
use yii\web\UnprocessableEntityHttpException;
use yii\web\UploadedFile;

class AlbumController extends \yii\web\Controller
{
    private readonly AlbumRepositoryInterface $albums;
    private readonly ShareRepositoryInterface $shares;
    private readonly AlbumService $albumService;

    public function __construct($id, $module, AlbumRepositoryInterface $albums, ShareRepositoryInterface $shares, AlbumService $albumService, $config = [])
    {
        $this->albums = $albums;
        $this->shares = $shares;
        $this->albumService = $albumService;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
        $albums = $this->albums->findAll();
        return $this->render('index', ['albums' => $albums]);
    }

    public function actionCreate()
    {
        $form = new CreateAlbumForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $files = array_map(fn(UploadedFile $f) => new UploadedFileInfo($f->name, $f->type,  $f->size, $f->tempName, $f->error), UploadedFile::getInstances($form, 'imageFiles'));
                $command = new CreateAlbumCommand($form->title, DateTimeImmutable::createFromFormat('d.m.Y', $form->date)->setTime(0, 0), $files);
                $album = $this->albumService->createAlbum($command);
                return $this->redirect(['view-model', 'id' => $album->getId()]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        if ($form->hasErrors()) {
            throw new UnprocessableEntityHttpException(json_encode($form->getErrors()));
        }

        return $this->render('create', ['form' => $form]);
    }

    public function actionView($id)
    {
        if (!$album = $this->albums->findById($id)) {
            throw new NotFoundHttpException();
        }
        $form = new AddPhotosForm($album);
        return $this->render('view', [
            'album' => $album,
            'shares' => $this->shares->findByAlbumId($album->getId()),
            'form' => $form
        ]);
    }

    public function actionUpdate($id)
    {
        if (!$album = $this->albums->findById($id)) {
            throw new NotFoundHttpException();
        }
        $form = new UpdateAlbumForm($album);

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $command = new UpdateAlbumCommand($form->getId(), $form->title, DateTimeImmutable::createFromFormat('d.m.Y', $form->date));
                $this->albumService->updateAlbum($command);
                return $this->redirect(['view', 'id' => $album->getId()]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        if ($form->hasErrors()) {
            throw new UnprocessableEntityHttpException(json_encode($form->getErrors()));
        }

        return $this->render('update', ['form' => $form]);
    }

    public function actionRemovePhoto($albumId, $id)
    {
        if (!$album = $this->albums->findById($albumId)) {
            throw new NotFoundHttpException();
        }

        $command = new RemovePhotoCommand($id, $album->getId());
        $this->albumService->removePhoto($command);
        return $this->redirect(['album/view', 'id' => $album->getId()]);
    }

    public function actionAddPhoto($id)
    {
        if (!$album = $this->albums->findById($id)) {
            throw new NotFoundHttpException();
        }

        $form = new AddPhotosForm($album);

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $files = array_map(fn(UploadedFile $f) => new UploadedFileInfo($f->name, $f->type,  $f->size, $f->tempName, $f->error), UploadedFile::getInstances($form, 'imageFiles'));
                $command = new AddPhotosCommand($form->getId(), $files);
                $this->albumService->addPhoto($command);
                return $this->redirect(['view', 'id' => $album->getId()]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        if ($form->hasErrors()) {
            throw new UnprocessableEntityHttpException(json_encode($form->getErrors()));
        }

        return $this->redirect(['view', 'id' => $album->getId()]);
    }

    public function actionSetCover($albumId, $id)
    {
        if (!$album = $this->albums->findById($albumId)) {
            throw new NotFoundHttpException();
        }

        $command = new SetCoverCommand($id, $album->getId());
        $this->albumService->setCover($command);
        return $this->redirect(['album/view', 'id' => $album->getId()]);
    }

    public function actionClearCover($id)
    {
        if (!$album = $this->albums->findById($id)) {
            throw new NotFoundHttpException();
        }

        $command = new ClearCoverCommand($album->getId());
        $this->albumService->clearCover($command);
        return $this->redirect(['album/view', 'id' => $album->getId()]);
    }
}
