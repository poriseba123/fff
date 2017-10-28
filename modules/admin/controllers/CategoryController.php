<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\web\Controller;
use kartik\grid\GridView;
use app\models\EmailNotify;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use app\modules\admin\models\SearchEmail;
use app\modules\admin\components\AdminController;

class CategoryController extends AdminController {

    public function columns() {
        $viewMsg = 'View';
        $updateMsg = 'Update';
        $deleteMsg = 'Delete';
        $gridColumns = [
            ['class' => 'kartik\grid\SerialColumn'],
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'email_code',
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'subject',
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'created_at',
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
                            return Url::to(['emails/view', 'id' => $model->id]);
                            break;
                        case "delete":
                            return Url::to(['emails/delete', 'id' => $model->id]);
                            break;
                    }
                },
                        'template' => '{view}',
                        'viewOptions' => ['title' => $viewMsg, 'data-toggle' => 'tooltip'],
                        'deleteOptions' => ['title' => $deleteMsg, 'data-toggle' => 'tooltip', 'data-confirm' => "Are you sure you want to delete this user?"],
                    ]
                ];
                return $gridColumns;
            }

            public function actionIndex() {
                $model = new SearchEmail();
                $dataProvider = $model->search(Yii::$app->request->queryParams);
                //echo "<pre>";
                //print_r($dataProvider);
                //die();
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
                                'heading' => '<h3 class="panel-title"><i class="icon-email"></i> Emails</h3>',
                                'heading' => '',
                                'type' => 'info',
//                                        'type' => GridView::TYPE_PRIMARY,
//                                'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> Create User', ['create'], ['class' => 'btn btn-success']),
                            ],
                ]);
                return $this->render('index', ['widget' => $widget]);
            }

            public function actionView($id) {
                $model = EmailNotify::findOne($id);
                $model->scenario = "admin-update-email";
                if ($model->load(Yii::$app->request->post())) {
                    $model->updated_at = date('Y-m-d H:i:s');
                    if ($model->validate() && $model->save()) {
                        Yii::$app->session->setFlash('success-msg', 'Email content are successfully updated');
                        return $this->refresh();
                    }
                }
                return $this->render('view', ['model' => $model]);
            }

            public function actionDelete($id) {
                $model = EmailNotify::findOne($id);
                $model->status = '3';
                $model->save(false);
                Yii::$app->session->setFlash('success-msg', 'Email content are successfully updated');
                return $this->redirect(['index']);
            }

        }
        