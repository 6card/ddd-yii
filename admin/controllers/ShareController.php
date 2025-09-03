<?php

namespace admin\controllers;

use App\Application\Command\AddPhotosCommand;
use App\Application\Command\ClearCoverCommand;
use App\Application\Command\CreateAlbumCommand;
use App\Application\Command\CreateShareCommand;
use App\Application\Command\RemovePhotoCommand;
use App\Application\Command\RemoveShareCommand;
use App\Application\Command\SetCoverCommand;
use App\Application\Command\UpdateAlbumCommand;
use App\Application\DTO\UploadedFileInfo;
use App\Application\Handler\CreateAlbumHandler;
use App\Application\Service\AlbumService;
use App\Application\Service\ShareService;
use App\Domain\Repository\AlbumRepositoryInterface;
use App\Domain\Repository\ShareRepositoryInterface;
use App\Infrastructure\Persistence\Mapper\AlbumMapper;
use App\Infrastructure\Persistence\Repository\AlbumRepository;
use App\Presentation\Admin\Form\AddPhotosForm;
use App\Presentation\Admin\Form\CreateAlbumForm;
use App\Presentation\Admin\Form\CreateShareForm;
use App\Presentation\Admin\Form\RemoveShareForm;
use App\Presentation\Admin\Form\ShareForm;
use App\Presentation\Admin\Form\UpdateAlbumForm;
use DateTimeImmutable;
use Yii;
use yii\web\NotFoundHttpException;
use yii\web\UnprocessableEntityHttpException;
use yii\web\UploadedFile;

class ShareController extends \yii\web\Controller
{
    private readonly ShareRepositoryInterface $shares;
    private readonly ShareService $shareService;

    public function __construct($id, $module, ShareRepositoryInterface $shares, ShareService $shareService, $config = [])
    {
        $this->shares = $shares;
        $this->shareService = $shareService;
        parent::__construct($id, $module, $config);
    }

    public function actionCreate($albumId)
    {
        $form = new CreateShareForm();

        if ($form->load(['albumId' => $albumId], '') && $form->validate()) {
            try {
                $command = new CreateShareCommand($form->albumId);
                $share = $this->shareService->createShare($command);
                return $this->redirect(['album/view', 'id' => $share->getAlbumId()]);
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

    public function actionRemove($albumId)
    {
        $form = new RemoveShareForm();
        $id = \Yii::$app->request->post('id');

        if ($form->load(['albumId' => $albumId, 'id' => $id], '') && $form->validate()) {
            try {
                $command = new RemoveShareCommand($form->id, $form->albumId);
                $this->shareService->removeShare($command);
                return $this->redirect(['album/view', 'id' => $albumId]);
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
}
