<?php

use yii\web\View;
use App\Presentation\Admin\Form\AlbumCreateForm;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var View $this */
/** @var AlbumCreateForm $form */

?>

<?php $activeForm = ActiveForm::begin([
    'errorCssClass' => 'error',
    'successCssClass' => 'success',
    'options' => [
        'enctype' => 'multipart/form-data',
        'class' => ['ui', 'form']
    ]
]); ?>

    <?= $activeForm->field($form, 'title', ['options' => ['class' => 'field']])->textInput(['placeholder' => 'Название альбома']) ?>
    <?= $activeForm->field($form, 'date', ['options' => ['class' => 'field', 'id' => 'calendar']])->textInput(['placeholder' => 'Дата съемки']) ?>

    <?= Html::submitButton('Submit', ['class' => ['ui', 'button', 'primary']]) ?>
<?php ActiveForm::end(); ?>

<?php

    $this->registerJs(
        "jQuery('#calendar').calendar({
            type: 'date',
            formatter: {
                date: 'DD.MM.YYYY'
            },
            parser: {
                date: function (text, settings) {
                    if (!text) {
                        return null;
                    }

                    const dts = text.split('.');
                    return new Date(+dts[2], dts[1] - 1, +dts[0]);
                }
            }
        });",
        View::POS_READY,
        'calendar-handler'
    );
?>
