<?php

use backend\models\Films;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var backend\models\FilmsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */


$this->params['breadcrumbs'][] = $this->context->title;
?>
<div class="films-index">

    <h1><?= Html::encode($this->context->title) ?></h1>

    <p>
        <?= Html::a('Добавить фильм', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'photo',
            'description:ntext',

            [
                'attribute' => 'age',
                'content'   => function ($data) {
                    return $data->age . '+';
                },
                'filter' => Films::getDropDownListAge()
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Films $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
