<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Film $model */

$this->params['breadcrumbs'][] = ['label' => 'Фильмы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->context->title;
?>
<div class="films-create">

    <h1><?= Html::encode($this->context->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
