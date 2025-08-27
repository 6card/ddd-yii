<?php

use yii\web\View;
use App\Domain\Model\Album\Album;
use yii\helpers\Html;

/** @var View $this */
/** @var Album[] $albums */

?>
<div class="ui grid">
    <div class="row">
        <div class="column">
            <?= Html::a(Html::tag('i', '', ['class' => ['plus', 'icon'] ]) . 'Add album', ['album/create'],  ['class' => ['positive', 'ui', 'button']]) ?>
        </div>

    </div>
    <div class="row">
        <div class="column">
            <table class="ui celled table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Ttile</th>
                        <th>Date</th>
                        <th>Photos</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($albums as $album) : ?>
                        <tr>
                            <td data-label="ID"><?= Html::encode($album->getId()) ?></td>
                            <td data-label="Title"><?= Html::a(Html::encode($album->getTitle()), ['album/view', 'id' => $album->getId()]) ?></td>
                            <td data-label="Date"><?= Html::encode($album->getDate()->format('d.m.Y H:i:s')) ?></td>
                            <td data-label="Photos"><?= Html::encode(count($album->getPhotos())) ?></td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
