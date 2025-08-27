<?php

/** @var yii\web\View $this */
/** @var string $content */

use yii\helpers\Html;
use App\Presentation\Web\Assets\AppAsset;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['http-equiv' => 'X-UA-Compatible', 'content' => 'IE=edge,chrome=1']);
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1.0, maximum-scale=1.0']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);

$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <title><?= Html::encode($this->title) ?></title>

    <style type="text/css">
        body>.grid {
            height: 100%;
        }

        .column {
            max-width: 450px;
        }
    </style>
    <?php $this->head() ?>
</head>

<body>
    <?php $this->beginBody() ?>

    <div class="ui middle aligned center aligned grid">
        <div class="column">
            <?= $content ?>
        </div>
    </div>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>
