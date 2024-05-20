<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Session $model */


$this->params['breadcrumbs'][] = ['label' => 'Сеансы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->context->title;
?>
<div class="sessions-update">

    <h1><?= Html::encode($this->context->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
