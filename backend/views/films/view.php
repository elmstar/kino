<?php

use yii\helpers\Html;
use yii\web\Response;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Films $model */

$this->params['breadcrumbs'][] = ['label' => 'Фильмы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->context->title;
\yii\web\YiiAsset::register($this);
?>
<div class="films-view">

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
            'title',
            [
                'attribute' => 'photo',
                'format'    => 'raw',
                'value'     => function ($data) {
                    $part = 'images/'.$data->id.'.'.$data->photo;
                    if (file_exists($part)) {
                        return '<img 
                                src="'.Yii::$app->request->hostInfo.'/'.$part.'"
                                style="width:300px;"
                            >';
                    }
                }
            ],
            'description:ntext',
            'duration',
            [
                'attribute' =>   'age',
                'value'   => function ($data) {
                    return $data->age . '+';
                }
            ],

        ],
    ]) ?>

</div>
