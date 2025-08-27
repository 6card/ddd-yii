<?php

use yii\web\View;
use App\Domain\Model\Album\Album;
use App\Domain\Model\Photo\Photo;
use yii\helpers\Html;

/** @var View $this */
/** @var Photo $photo */
/** @var Album $album */

?>

<div class="card">
    <div class="image">
        <?= Html::img(Yii::getAlias('@web/uploads/photo/' . $photo->getFilename())) ?>
    </div>
    <div class="extra content">
      <div class="ui two buttons">
            <?php if (!$photo->isCover($album->getCoverId())) : ?>
                <?= Html::a(Html::tag('i', '',  ['class' => ['photo', 'video', 'icon']]) . ' Set cover', ['album/set-cover', 'albumId' => $album->getId(), 'id' => $photo->getId()], ['class' => 'ui green button']) ?>
            <?php endif; ?>
        <?= Html::a(Html::tag('i', '',  ['class' => ['trash', 'icon']]) . ' Remove', ['album/remove-photo', 'albumId' => $album->getId(), 'id' => $photo->getId()], ['class' => 'ui red button']) ?>
      </div>
    </div>

</div>
