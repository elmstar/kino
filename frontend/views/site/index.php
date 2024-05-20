<?php
use backend\models\Session;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var yii\web\View $this */
/** @var backend\models\SessionSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

?>
<div class="site-index">
    <h1> Афиша </h1>
    <?php Pjax::begin(); ?>
    <?php  //echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'film.title',
            [
                'attribute' =>  'film.photo',
                'content'   => function ($data) {
                    if (isset($data->film->id) && isset($data->film->photo)) {
                        $part = 'upload/film/'.$data->film->id.'.'.$data->film->photo;
                        if (file_exists($part)) {
                            return '<img 
                                src="'.Yii::$app->request->hostInfo.'/'.$part.'"
                                style="width:300px;"
                            >';
                        } else return 'Фото отсутствует';
                    }
                }
            ],
            'film.description',
            [
                'attribute' =>  'datetime',
                'format'    => 'datetime',
                'filter'    => false
            ],
            'price'
        ],
    ]); ?>

    <?php Pjax::end(); ?>
</div>
