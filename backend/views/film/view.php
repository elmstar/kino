<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Film $model */

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
                    $part = Url::to('@backend/web/upload/film/'.$data->id.'.'.$data->photo);
                    $url = Url::to('@web/upload/film/'.$data->id.'.'.$data->photo);
                    if (@fopen($part, "r")) {
                        return '<img 
                                src="'.$url.'"
                                style="width:300px;"
                            >';
                    } else return 'Файл отсутствует';
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
