<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\data\Pagination;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use app\modules\admin\models\BookingMaster;
use app\modules\admin\models\SearchBooking;
use app\modules\admin\components\AdminController;

class BookingController extends AdminController {

    public function columns() {
        $viewMsg = 'View';
        $updateMsg = 'Update';
        $deleteMsg = 'Delete';
        $gridColumns = [
            ['class' => 'kartik\grid\SerialColumn'],
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'trackId',
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'user_id',
                'value' => function($data) {
                    return $data->userDetails->first_name . ' ' . $data->userDetails->last_name;
                }
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'booking_type',
                'value' => function($data) {
                    if ($data->booking_type == 1) {
                        $booking_type = "Instant Booking";
                    } elseif ($data->booking_type == 2) {
                        $booking_type = "Before 6 hours";
                    }
                    return $booking_type;
                },
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'request_time',
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'booking_status',
                'value' => function($data) {
                    if ($data->booking_status == 0) {
                        $booking_status = "Pending";
                    } elseif ($data->booking_status == 1) {
                        $booking_status = "Paid";
                    } elseif ($data->booking_status == 2) {
                        $booking_status = "Cancel";
                    }
                    return $booking_status;
                },
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'booking_location_start_id',
                'value' => function($data) {
                    return $data->userDetailsTripLocationStart->location_a_name;
                },
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'booking_location_end_id',
                'value' => function($data) {
                    return $data->userDetailsTripLocationEnd->location_b_name;
                },
            ],
//            [
//                'class' => '\kartik\grid\DataColumn',
//                'attribute' => 'total_distance',
//            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'total_price',
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'added_date',
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
                            return Url::to(['booking/view', 'id' => $model->id]);
                            break;
                        
                    }
                },
                        'template' => '{view}',
                        'viewOptions' => ['title' => $viewMsg, 'data-toggle' => 'tooltip'],
                        'buttons' => [
                            'updateDetails' => function ($url, $model) {
                                return Html::a('<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', Url::to(['users/editdetails', 'id' => $model->id]), [
                                            'title' => Yii::t('yii', 'Edit Details'),
                                            'data-toggle' => 'tooltip'
                                ]);
                            },
                                    'doSuspend' => function ($url, $model) {
                                return $model->status == 1 ? Html::a('<i class="fa fa-ban" aria-hidden="true"></i>', Url::to(['users/dosuspend', 'id' => $model->id]), [
                                            'title' => Yii::t('yii', 'Do Suspended'),
                                            'data-toggle' => 'tooltip'
                                        ]) : '';
                            },
                                    'doActive' => function ($url, $model) {
                                return ($model->status == 2) ? Html::a('<i class="fa fa-check-square-o" aria-hidden="true"></i>', Url::to(['users/doactive', 'id' => $model->id]), [
                                            'title' => Yii::t('yii', 'Do Activate'),
                                            'data-toggle' => 'tooltip'
                                        ]) : '';
                            },
                                ],
                                'updateOptions' => ['title' => $updateMsg, 'data-toggle' => 'tooltip'],
                                'deleteOptions' => ['title' => $deleteMsg, 'data-toggle' => 'tooltip', 'data-confirm' => "Are you sure you want to delete this user?"],
                            ]
        ];
        return $gridColumns;
    }

    public function actionIndex() {
        $this->view->title = $this->getProjectName() . ": View Register Users";

        $model = new SearchBooking;
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

    public function actionEditdetails() {
        if (Yii::$app->request->isAjax) {
            $resp = [];
            $resp['flag'] = false;
            $userId = $_REQUEST['userId'];
            $user = $this->findModel($userId);
            $user->scenario = "admin_update_user";
            if ($user->load(Yii::$app->request->post())) {
                $user->update_date = date("Y-m-d H:i:s");
                if ($user->validate() && $user->save()) {
                    $resp['flag'] = true;
                    $resp['msg'] = "User data successfully updated";
                } else {
                    $resp['errors'] = $user->getErrors();
                }
            }
            echo json_encode($resp);
            exit;
        }
        $id = $_REQUEST["id"];
        $user = $this->findModel($id);
        return $this->render('update', ['model' => $user]);
    }

     public function actionView() {
                        $booking_id= $_REQUEST['id'];
                        $model= \app\modules\admin\models\BookingMaster::findOne($booking_id);
                       return $this->render('view', ['model' => $model]); 
                    }

    protected function findModel($id) {
        if (($model = UserMaster::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
