<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Cms;
use yii\helpers\Url;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use app\modules\admin\models\SearchCms;
use app\modules\admin\components\AdminController;

class CmsController extends AdminController {

    public function columns() {
        $viewMsg = 'View';
        $updateMsg = 'Update';
        $gridColumns = [
            ['class' => 'kartik\grid\SerialColumn'],
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'slug',
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'title',
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'updated_at',
                'filterType' => false,
                'pageSummary' => true,
            ],
            [
                'class' => 'kartik\grid\ActionColumn',
                'dropdown' => false,
                'vAlign' => 'middle',
                'urlCreator' => function($action, $model, $key, $index) {
                    switch ($action) {
                        case "view":
                            return Url::to(['cms/view', 'id' => $model->id]);
                            break;
                        case "update":
                            return Url::to(['cms/update', 'id' => $model->id]);
                            break;
                    }
                },
                        'template' => '{update}',
                        'viewOptions' => ['title' => $viewMsg, 'data-toggle' => 'tooltip'],
                        'updateOptions' => ['title' => $updateMsg, 'data-toggle' => 'tooltip'],
                    ]
                ];
                return $gridColumns;
            }

            public function actionIndex() {
                $model = new SearchCms;
                $dataProvider = $model->search(Yii::$app->request->queryParams);
                $widget = GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $model,
                            'columns' => $this->columns(),
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
                                'heading' => '<h3 class="panel-title"><i class="icon-user"></i> Users</h3>',
                                'heading' => '',
                                'type' => 'info',
//                                        'type' => GridView::TYPE_PRIMARY,
//                                        'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> Create User', ['create'], ['class' => 'btn btn-success']),
                            ],
                ]);
                return $this->render('index', ['widget' => $widget]);
            }

            public function actionView($id) {
                return $this->render('view', [
                            'model' => $this->findModel($id)
                ]);
            }

            public function actionUpdate($id) {
                $model = $this->findModel($id);
                $model->scenario = 'update_cms';
                $data['model'] = $model;
                if ($model->load(Yii::$app->request->post())) {
                    $model->updated_at = date('Y-m-d H:i:s');
                    if ($model->validate()) {
                        $model->save(false);
                        Yii::$app->session->setFlash('success-msg', 'Static details updated successfully.');
                        return $this->refresh();
                    }
                }
                return $this->render('update', $data);
            }

            protected function findModel($id) {
                if (($model = Cms::findOne($id)) !== null) {
                    return $model;
                } else {
                    throw new NotFoundHttpException('The requested page does not exist.');
                }
            }

        }
        