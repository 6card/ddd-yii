<?php

use yii\web\View;
use App\Presentation\Admin\Form\AddPhotosForm;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use App\Domain\Model\Album\Album;

/** @var View $this */
/** @var AddPhotosForm $form */

?>


<?php $activeForm = ActiveForm::begin([
    'action' => ['album/add-photo', 'id' => $form->getId()],
    'errorCssClass' => 'error',
    'successCssClass' => 'success',
    'options' => [
        'enctype' => 'multipart/form-data',
        'class' => ['ui', 'form']
    ]
]); ?>

    <?= $activeForm->field($form, 'imageFiles[]', ['options' => ['class' => 'field']])->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>

    <?= Html::submitButton('Добавить фото', ['class' => ['ui', 'button', 'primary']]) ?>
<?php ActiveForm::end(); ?>
