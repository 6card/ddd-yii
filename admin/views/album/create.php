<?php

use yii\web\View;
use App\Presentation\Admin\Form\AlbumCreateForm;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var View $this */
/** @var AlbumCreateForm $form */

$this->title = 'Create album';

?>

<?= $this->render('_form-create', ['form' => $form]) ?>
