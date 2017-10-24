<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Seo;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\web\Controller;
use kartik\grid\GridView;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\console\Application;
use yii\web\NotFoundHttpException;
use app\modules\admin\models\SearchSeo;
use app\modules\admin\components\AdminController;

class SeoController extends AdminController {

    public function column_seo() {
        $viewMsg = 'View';
        $updateMsg = 'Update';
        $gridColumns = [
            ['class' => 'kartik\grid\SerialColumn'],
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'route',
                'label' => 'Route',
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'title',
                'label' => 'Title',
                'value' => function ($model) {
                    return ($model->title != '') ? (substr($model->title, 0, 20)) . ((strlen($model->title) > 20) ? ".." : "") : "Not Set";
                }
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'description',
                'label' => 'Description',
                'value' => function ($model) {
                    return ($model->description != '') ? (substr($model->description, 0, 20)) . ((strlen($model->description) > 20) ? ".." : "") : "Not Set";
                }
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'keyword',
                'label' => 'Keyword',
                'value' => function ($model) {
                    return ($model->title != '') ? (substr($model->keyword, 0, 20)) . ((strlen($model->keyword) > 20) ? ".." : "") : "Not Set";
                }
            ],
            [
                'class' => 'kartik\grid\ActionColumn',
                'dropdown' => false,
                'vAlign' => 'middle',
                'urlCreator' => function($action, $model, $key, $index) {
                    switch ($action) {
                        case "view":
                            return Url::to(['seo/view', 'id' => $model->id]);
                            break;
                        case "update":
                            return Url::to(['seo/update', 'id' => $model->id]);
                            break;
                    }
                },
                        'template' => '{view} {update}',
                        'viewOptions' => ['title' => $viewMsg, 'data-toggle' => 'tooltip'],
                        'updateOptions' => ['title' => $updateMsg, 'data-toggle' => 'tooltip'],
                    ]
                ];
                return $gridColumns;
            }

            public function actionIndex() {
                $searchModel = new SearchSeo();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $widget = GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'columns' => $this->column_seo(),
                            'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
                            'headerRowOptions' => ['class' => 'kartik-sheet-style'],
                            'filterRowOptions' => ['class' => 'kartik-sheet-style'],
                            'beforeHeader' => [
                                [
                                    'options' => ['class' => 'skip-export'] // remove this row from export
                                ]
                            ],
                            'toolbar' => [
                                ['content' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset', ['index'], ['class' => 'btn btn-info'])
                                ],
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
                $model = new Seo;
                $model->scenario = "create_seo";
                if ($model->load(Yii::$app->request->post())) {
                    $model->updated_at = date("Y-m-d H:i:s");
                    if ($model->validate() && $model->save()) {
                        Yii::$app->session->setFlash('success', 'New Seo have been created successfully');
                        return $this->redirect(["index"]);
                    }else{
                        echo "<pre>";
                        print_r($model->getErrors());
                        echo "</pre>";
                        exit;
                    }
                }
                return $this->render("create", ["model" => $model]);
            }

            public function actionView($id) {
                return $this->render('view', ['model' => $this->findModel($id),
                ]);
            }

            public function actionUpdate($id) {
                $model = $this->findModel($id);
                $model->scenario = 'update';
                if ($model->load(Yii::$app->request->post())) {
                    $model->attributes = $_POST['Seo'];
                    $model->title = $_POST['Seo']['title'];
                    $model->description = $_POST['Seo']['description'];
                    $model->keyword = $_POST['Seo']['keyword'];
                    $model->save(false);
                    Yii::$app->session->setFlash('success', 'Seo updated successfully!');
                    return $this->refresh();
                }
                $data['model'] = $model;
                return $this->render('update', $data);
            }

            protected function findModel($id) {
                if (($model = Seo::findOne($id)) !== null) {
                    return $model;
                } else {
                    throw new NotFoundHttpException('The requested page does not exist.');
                }
            }

        }
        