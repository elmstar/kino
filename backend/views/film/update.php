<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Film $model */

$this->title = 'Update Film: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Фильмы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->context->title;
\yii\web\YiiAsset::register($this);
?>
<div class="films-update">

    <h1><?= Html::encode($this->context->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
