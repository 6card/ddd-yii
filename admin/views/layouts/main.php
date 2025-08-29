<?php

/** @var yii\web\View $this */
/** @var string $content */

use yii\helpers\Html;
use admin\assets\AppAsset;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['http-equiv' => 'X-UA-Compatible', 'content' => 'IE=edge,chrome=1']);
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);

$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>
    <?php $this->beginBody() ?>

    <header id="header">
        <!-- Following Menu -->
        <div class="ui large top menu">
            <div class="ui container">
                <?= Html::a('Home', ['site/index'], ['class' => ['item', str_starts_with(Yii::$app->controller->getRoute(), 'site/index') ? 'active' : null]]) ?>
                <?= Html::a('Albums', ['album/index'], ['class' => ['item', str_starts_with(Yii::$app->controller->getRoute(), 'album/') ? 'active' : null]]) ?>
                <a class="item">Work</a>
                <a class="item">Company</a>
                <a class="item">Careers</a>
                <div class="right menu">
                    <div class="item">
                        <?= Html::a('Logout', ['auth/logout'], ['class' => ['ui', 'primary', 'button']]) ?>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main id="main" role="main">
        <div class="main ui container">
            <?= $content ?>
        </div>
    </main>

    <footer id="footer">
        <div class="ui inverted vertical footer segment">
            <div class="ui container">
                <div>&copy; My Company <?= date('Y') ?></div>
                <div><?= Yii::powered() ?></div>
            </div>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>
