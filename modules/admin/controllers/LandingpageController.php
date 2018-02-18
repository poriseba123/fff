<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\UploadedFile;
use app\models\Seo;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\web\Controller;
use kartik\grid\GridView;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\console\Application;
use yii\web\NotFoundHttpException;
use app\modules\admin\components\AdminController;
use app\models\Landingpage;
use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;
use Imagine\Image\BoxInterface;

class LandingpageController extends AdminController {

    public function column() {

        $viewMsg = 'View';
        $updateMsg = 'Update';
        $gridColumns = [
            ['class' => 'kartik\grid\SerialColumn'],
            [
                'class' => '\kartik\grid\DataColumn',
                'label' => 'Heading',
                'attribute' => 'heading',
            ], [
                'class' => '\kartik\grid\DataColumn',
                'label' => 'Tagline',
                'attribute' => 'tagline',
                'value' => function($data) {
                    return substr(strip_tags($data->tagline), 1, 100) . '...';
                }
            ], [
                'class' => '\kartik\grid\DataColumn',
                'label' => 'Listing Heading',
                'attribute' => 'listing_line',
                'value' => function($data) {
                    return substr(strip_tags($data->listing_line), 1, 100) . '...';
                }
            ], [
                'class' => '\kartik\grid\DataColumn',
                'label' => 'Slider Heading',
                'attribute' => 'slider_line',
                'value' => function($data) {
                    return substr(strip_tags($data->slider_line), 1, 100) . '...';
                }
            ], [
                'class' => '\kartik\grid\DataColumn',
                'label' => 'Subscription Heading',
                'attribute' => 'subscription_line',
                'value' => function($data) {
                    return substr(strip_tags($data->subscription_line), 1, 100) . '...';
                }
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'label' => 'Youtube url',
                'attribute' => 'youtube_url',
                'value' => function($data) {
                    return substr(strip_tags($data->youtube_url), 1, 100) . '...';
                }
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'label' => 'About Us',
                'attribute' => 'about_us',
                'value' => function($data) {
                    return substr(strip_tags($data->about_us), 1, 100) . '...';
                }
            ],
            [
                'class' => 'kartik\grid\ActionColumn',
                'dropdown' => false,
                'vAlign' => 'middle',
                'urlCreator' => function($action, $model, $key, $index) {
                    switch ($action) {
                        case "update":
                            return Url::to(['landingpage/update', 'id' => $model->id]);
                            break;
                    }
                }
            ]
        ];
        return $gridColumns;
    }

    public function actionIndex() {
        $searchModel = new Landingpage;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $widget = GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => $this->column(),
                    'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
                    'headerRowOptions' => ['class' => 'kartik-sheet-style'],
                    'filterRowOptions' => ['class' => 'kartik-sheet-style'],
                    'beforeHeader' => [
                        [
                            'options' => ['class' => 'skip-export'] // remove this row from export
                        ]
                    ],
                    'toolbar' => [
//                        ['content' => Html::a('<i class="glyphicon glyphicon-plus"></i> Add', ['create'], ['class' => 'btn btn-info']),
//                        ],
                        ['content' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset', ['index'], ['class' => 'btn btn-info']),
                        ]
                    ],
                    'pjax' => true,
                    'bootstrap' => true,
                    'bordered' => true,
                    'striped' => false,
                    'condensed' => true,
                    'responsive' => true,
                    'hover' => true,
                    'floatHeader' => false,
                    'perfectScrollbar' => false,
                    'perfectScrollbarOptions' => ['position' => 'relative', 'height' => '2px'],
                    'showPageSummary' => false,
                    'panel' => [
                        'heading' => false,
//                        'heading' => '<h3 class="panel-title"><i class="icon-user"></i> Users</h3>',
                        'heading' => '',
                        'type' => 'info',
//                        'type' => GridView::TYPE_PRIMARY,
//                                'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> Add new', ['create'], ['class' => 'btn btn-success']),
                    ],
        ]);
        return $this->render('index', ['widget' => $widget]);
    }

    public function actionCreate() {
        $data = [];
        $model = new Landingpage;
        $model->scenario = "create";
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {

                $model->save(false);
                Yii::$app->session->setFlash('success', 'created successfully');
                return $this->redirect(["index"]);
            }
        }
        return $this->render("create", ["model" => $model]);
    }

    public function actionCreateajax() {
        if (Yii::$app->request->isAjax) {
            $resp = [];
            $resp['flag'] = false;
            $model = new Landingpage();
            $model->scenario = "create";
            if ($model->load(Yii::$app->request->post())) {
                if ($model->validate()) {
                    $model->save(false);
                    $resp['flag'] = true;
                    $resp['url'] = Url::to(['landingpage/index']);
                    $resp['msg'] = "successfully created";
                } else {
                    $resp['errors'] = $model->getErrors();
                }
            }
            echo json_encode($resp);
            exit;
        }
    }

    public function actionUpdateajax() {
        if (Yii::$app->request->isAjax) {
            $otion_id = $_POST['option_id'];
            $resp = [];
            $resp['flag'] = false;
            $model = Landingpage::findOne($otion_id);
            $model->scenario = "update";
            if ($model->load(Yii::$app->request->post())) {
                if ($model->validate()) {
                    $model->save(false);
                    $resp['flag'] = true;
                    $resp['url'] = Url::to(['landingpage/index']);
                    $resp['msg'] = "successfully updated";
                } else {
                    $resp['errors'] = $model->getErrors();
                }
            }
            echo json_encode($resp);
            exit;
        }
    }

    public function actionUpdate($id) {
        $data = [];
        $model = Landingpage::findOne($id);
        $model->scenario = 'update';
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save(false);
            Yii::$app->session->setFlash('success', 'updated successfully!');
            return $this->refresh();
        }
        return $this->render('update', ["model" => $model]);
    }

    protected function findModel($id) {
        if (($model = Landingpage::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}

?>