<?php

use yii\web\View;
use App\Presentation\Admin\Form\AlbumCreateForm;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var View $this */
/** @var AlbumCreateForm $form */

$this->title = 'Update album #' . $form->getId();

?>

<?= $this->render('_form-update', ['form' => $form]) ?>
