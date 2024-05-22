<?php

namespace backend\controllers;

use backend\models\Session;
use backend\models\SessionSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SessionController implements the CRUD actions for Session model.
 */
class SessionController extends Controller
{
    public $title = 'Сеансы';
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'actions' => ['index'],
                            'controllers' => ['site'],
                            'allow' => true
                        ],
                        [
                            'actions' => ['login', 'logout', 'error'],
                            'allow' => true,
                        ],
                        [
                            'actions' => ['index', 'view', 'create', 'update','delete'],
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Session models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SessionSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Session model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $this->title = 'Просмотр карточки ' . \Yii::$app->formatter->asDate($model->datetime, "php:d.m.Y H:i:s");
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Session model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Session();

        if ($this->request->isPost) {
            $this->saveWrapper($model, $this->request->post());
        } else {
            $model->loadDefaultValues();
        }
        $this->title = 'Добавление сеанса';
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Session model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost) {
            $this->saveWrapper($model, $this->request->post());
        }
        $this->title = 'Редактирование сеанса ' . \Yii::$app->formatter->asDate($model->datetime, "php:d.m.Y H:i:s");
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Session model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Session model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Session the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Session::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function saveWrapper($model, $post)
    {
        $model->load($post);
        $model->setDatetime($post['Session']['datetime']);
        if ($model->validateTime()) {
            $testSave = $model->save();
            if ($testSave)
                return $this->redirect(['view', 'id' => $model->id]);
        } else
            \Yii::$app->session->setFlash('error', 'Киносеансы пересекаются по времени');
        return $this->render('update', [
            'model' => $model,
        ]);
    }
}
