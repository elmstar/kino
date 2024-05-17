<?php

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Админ панель</h1>

        <p class="lead">Здесь предполагается статистика или другая разновидность сводной инфы</p>

        <p><div class="btn btn-lg btn-success">Рыба кнопку не стал убирать</div></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Фильмы</h2>

                <p>Сюда заносим данные о фильмах</p>

                <p><a class="btn btn-outline-secondary" href="<?= Yii::$app->request->hostInfo ?>/backend/web/films">Фильмы</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Сеансы</h2>

                <p>Настройка сеансов</p>

                <p><a class="btn btn-outline-secondary" href="<?= Yii::$app->request->hostInfo ?>/backend/web/sessions">Сеансы</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-outline-secondary" href="https://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
