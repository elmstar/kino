<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Sessions $model */


$this->params['breadcrumbs'][] = ['label' => 'Сеансы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->context->title;
?>
<div class="sessions-create">

    <h1><?= Html::encode($this->context->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
