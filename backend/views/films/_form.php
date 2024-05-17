<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use marqu3s\summernote\Summernote;

/** @var yii\web\View $this */
/** @var backend\models\Films $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="films-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'photo')->textInput(['maxlength' => true])
    ?>
    <?= $form->field($model, 'imageFile')->fileInput() ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'duration')->input('number') ?>

    <?= $form->field($model, 'age')->dropDownList(
        \backend\models\Films::getDropDownListAge(),
        ['prompt' => 'Выберите возрастное ограничение']
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
