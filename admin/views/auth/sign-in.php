<?php

use App\Presentation\Admin\Form\UserAuthForm;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var \yii\web\View $this */
/** @var UserAuthForm $form */


?>

<h2 class="ui teal image header">
    <div class="content">
        Log-in to your account
    </div>
</h2>

<?php $activeForm = ActiveForm::begin([
    'errorCssClass' => 'error',
    'successCssClass' => 'success',
    'options' => [
        'class' => ['ui', 'form', 'large']
    ]
]); ?>
<div class="ui stacked segment">

    <?= $activeForm->field($form, 'email', ['options' => ['class' => 'field']])->textInput(['placeholder' => 'email'])->label(false) ?>
    <?= $activeForm->field($form, 'password', ['options' => ['class' => 'field']])->textInput(['placeholder' => 'password'])->label(false) ?>
    <?= $activeForm->field($form, 'rememberMe', ['options' => ['class' => 'field']])->checkbox() ?>

    <?= Html::submitButton('Submit', ['class' => ['ui', 'button', 'primary', 'fluid', 'teal', 'large']]) ?>
</div>

<?php ActiveForm::end(); ?>


<div class="ui message">
    New to us? <a href="#">Sign Up</a>
</div>
