<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\data\Pagination;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use app\modules\admin\models\UserMaster;
use app\modules\admin\models\SearchUser;
use app\modules\admin\components\AdminController;
use app\models\ReportMaster;
use app\models\RatingMaster;

class RatingController extends AdminController {

    public function columns() {
        $viewMsg = 'View';
        $updateMsg = 'Update';
        $deleteMsg = 'Delete';
        $gridColumns = [
            ['class' => 'kartik\grid\SerialColumn'],
            [
                'class' => '\kartik\grid\DataColumn',
                'header' => 'Driver',
                'attribute' => 'driver_id',
                'value' => function($data) {
                    return $data->driverDetails->first_name.' '.$data->driverDetails->last_name;
                },
                
            ],
              [
                'class' => '\kartik\grid\DataColumn',
                'header' => 'Passenger',
                'attribute' => 'user_id',
                'value' => function($data) {
                    return $data->userDetails->first_name.' '.$data->userDetails->last_name;
                },
                
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'header' => 'Booking Id',
                'attribute' => 'booking_id',
                'value' => function($data) {
                    return $data->bookingDetails->trackId;
                },
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'header' => 'rating',
                'attribute' => 'rating',
            ],
            [
                'class' => 'kartik\grid\ActionColumn',
                'dropdown' => false,
                'vAlign' => 'middle',
                'urlCreator' => function($action, $model, $key, $index) {
                    switch ($action) {
                        case "view":
                            return Url::to(['rating/view', 'id' => $model->id]);
                            break;
                        case "delete":
                            return Url::to(['rating/delete', 'id' => $model->id]);
                            break;
                        
                    }
                },
                        'template' => '{view} {delete}',
                        'viewOptions' => ['title' => $viewMsg, 'data-toggle' => 'tooltip'],
                        'buttons' => [
                            'edit' => function ($url, $model) {
                                return Html::a('<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', Url::to(['refund/update', 'id' => $model->id]), [
                                            'title' => Yii::t('yii', 'refund'),
                                            'data-toggle' => 'tooltip'
                                ]);
                            },
                                ],
                                'updateOptions' => ['title' => $updateMsg, 'data-toggle' => 'tooltip'],
                                'deleteOptions' => ['title' => $deleteMsg, 'data-toggle' => 'tooltip', 'data-confirm' => "Are you sure you want to delete this user?"],
                            ]
                        ];
                        return $gridColumns;
                    }

                    public function actionIndex() {
                        $this->view->title = $this->getProjectName() . ": Report Management";

                        $model = new RatingMaster;
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
//                                'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> Create User', ['create'], ['class' => 'btn btn-success']),
                                    ],
                        ]);
                        return $this->render('index', ['widget' => $widget]);
                    }

                    public function actionView() {
                        $report_id= $_REQUEST['id'];
                        $model= RatingMaster::findOne($report_id);
                       return $this->render('view', ['model' => $model]); 
                    }
                    
                    public function actionDelete() {
                        $userId = $_REQUEST['id'];
                        $user = $this->findModel($userId);
                        $user->status = 3;
                        $user->save(false);
                        Yii::$app->session->setFlash('success', 'Rating has been deleted.');
//                        return $this->redirect(['index']);
                        return true;
                    }

                   

                    protected function findModel($id) {
                        if (($model = RatingMaster::findOne($id)) !== null) {
                            return $model;
                        } else {
                            throw new NotFoundHttpException('The requested page does not exist.');
                        }
                    }

                }
                