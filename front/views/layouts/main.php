<?php

/** @var yii\web\View $this */
/** @var string $content */

use yii\helpers\Html;
use front\assets\AppAsset;

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
<html lang="<?= Yii::$app->language ?>">

<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>
    <?php $this->beginBody() ?>

    <head>
      <nav class="navbar is-transparent is-fixed-top is-top" id="main_menu">
        <div class="container">
          <div class="navbar-brand">
            <a class="navbar-item" href="#">Logo</a>
            <a
              role="button"
              class="navbar-burger"
              aria-label="menu"
              aria-expanded="false"
              data-target="navbar_menu"
              id="navbar_burger"
            >
              <span aria-hidden="true"></span>
              <span aria-hidden="true"></span>
              <span aria-hidden="true"></span>
              <span aria-hidden="true"></span>
            </a>
          </div>

          <div id="navbar_menu" class="navbar-menu">
            <div class="navbar-start">
              <a class="navbar-item" href="#">Альбомы</a>
              <a class="navbar-item" href="#">Портфолио</a>
              <a class="navbar-item" href="#">Обо мне</a>
              <a class="navbar-item" href="#">Контакты</a>
            </div>
            <div class="navbar-end">
              <a class="navbar-item" href="#">Вход</a>
            </div>
          </div>
        </div>
      </nav>
    </head>

    <main id="main" role="main">
        <?= $content ?>
    </main>

    <footer class="footer">
      <div class="content has-text-centered">
        <p><strong>Yana</strong> photographer</p>
      </div>
    </footer>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>
