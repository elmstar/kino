<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

\yii\web\YiiAsset::register($this);
use kartik\datetime\DateTimePicker;

/** @var yii\web\View $this */
/** @var backend\models\Session $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="sessions-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'film_id')->dropDownList(
        \backend\models\Film::getDropDownListFilms(),
        ['prompt' => 'Выберите фильм']
    ) ?>


    <div class="form-group field-news-date">
        <label class="control-label" >Дата начала показа</label>
        <?= DateTimePicker::widget([
            'name' => 'Session[datetime]',
            'language' => 'ru',
            'options' => ['placeholder' => 'Выберите дату ...'
            ],
            'value' => (is_null($model->datetime))?'':date('d.m.Y H:i:s', strtotime($model->datetime)),
            'convertFormat' => true,
            'type' => 2,
            'pluginOptions' => [
                'ranges' => true,
                'format' => 'd.M.y H:i:s',
                'singleDatePicker' => true,
                'autoclose' => true

            ]
        ]);
        ?>
    </div>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
