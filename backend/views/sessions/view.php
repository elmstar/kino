<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Sessions $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Сеансы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->context->title;
\yii\web\YiiAsset::register($this);
?>
<div class="sessions-view">

    <h1><?= Html::encode($this->context->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'film_id',
                'value'     => function ($data) {
                    return (!empty($data->film->title)) ? $data->film->title : '';
                },
                'label'     => 'Название фильма'
            ],
            'datetime:datetime',
            'price',
        ],
    ]) ?>

</div>
