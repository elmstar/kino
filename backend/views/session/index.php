<?php

use backend\models\Session;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var backend\models\SessionSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */


$this->params['breadcrumbs'][] = $this->context->title;
?>
<div class="sessions-index">

    <h1><?= Html::encode($this->context->title) ?></h1>

    <p>
        <?= Html::a('Добавить сеанс', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'film.title',
            'datetime',
            'film.duration',
            'price',
            [
                'class' => ActionColumn::class,
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
