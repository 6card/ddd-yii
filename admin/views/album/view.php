<?php

use yii\web\View;
use App\Domain\Model\Album\Album;
use App\Domain\Model\Share\Share;
use yii\helpers\Html;

/** @var View $this */
/** @var Album $album */
/** @var Share[] $shares */
/** @var AddPhotosForm $form */

$this->title = (string)$album->getTitle();

?>

<h1><?= Html::encode((string)$album->getTitle()) ?></h1>
<div class="ui grid">
    <div class="row">
        <div class="column">
            <?= Html::a(Html::tag('i', '', ['class' => ['pen', 'icon']]) . 'Edit album', ['album/update', 'id' => $album->getId()],  ['class' => ['primary', 'ui', 'button']]) ?>
        </div>

    </div>
    <div class="two column row">
        <div class="column">
            <table class="ui celled table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Value</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>ID</td>
                        <td data-label="ID"><?= Html::encode($album->getId()) ?></td>
                    </tr>
                    <tr>
                        <td>Title</td>
                        <td data-label="Title"><?= Html::encode($album->getTitle()) ?></td>
                    </tr>
                    <tr>
                        <td>Date</td>
                        <td data-label="Title"><?= Html::encode($album->getDate()->format('d.m.Y')) ?></td>
                    </tr>
                    <tr>
                        <td>Created at</td>
                        <td data-label="Title"><?= Html::encode($album->getCreatedAt()->format('d.m.Y H:i:s')) ?></td>
                    </tr>
                    <tr>
                        <td>Updated at</td>
                        <td data-label="Title"><?= Html::encode($album->getUpdatedAt()->format('d.m.Y H:i:s')) ?></td>
                    </tr>
                    <?php foreach ($shares as $share) : ?>
                    <tr>
                        <td>Share link</td>
                        <td data-label="Share link"><?= Html::encode($share->getUuid()->value()) . " " . Html::a(Html::tag("i", "", ['class' => 'delete icon']), ['share/remove', 'albumId' => $share->getAlbumId()], [
                            'class' => 'ui icon circular negative tertiary button',
                            'data' => [
                                'method' => 'post',
                                'params' => [
                                    'id' => $share->getId(),
                                ],
                            ],
                        ]) ?></td>
                    </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td></td>
                        <td><?= Html::a("add link", ['share/create', 'albumId' => $album->getId()]) ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="column">
            <?= Html::img(Yii::getAlias('@web/uploads/photo/' . $album->getCover()?->getFilename()), ['class' => 'ui medium rounded image']) ?>
            <?php if ($album->getCover()) : ?>
                <?= Html::a(Html::tag('i', '',  ['class' => ['trash', 'icon']]) . ' Clear cover', ['album/clear-cover', 'id' => $album->getId()], ['class' => 'ui red button']) ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="row">
        <div class="column">
            <?= $this->render('_form-add-photo', ['form' => $form]) ?>
        </div>
    </div>
    <div class="row">
        <div class="column">
            <div class="ui inverted cards">

                <?php foreach ($album->getPhotos() as $photo) : ?>
                    <?= $this->render('_photo_card', ['album' => $album, 'photo' => $photo]) ?>
                <?php endforeach; ?>

            </div>
        </div>
    </div>
</div>
