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

class NewsletterController extends AdminController {

    public function columns() {
        $viewMsg = 'View';
        $updateMsg = 'Update';
        $deleteMsg = 'Delete';
        $gridColumns = [
            ['class' => 'kartik\grid\SerialColumn'],
            [
                'class' => '\kartik\grid\DataColumn',
                'header' => 'Full Name',
                'attribute' => 'full_name',
                
            ],
              [
                'class' => '\kartik\grid\DataColumn',
                'header' => 'Email Id',
                'attribute' => 'email_id',
                
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'header' => 'Reported Time',
                'attribute' => 'created_at',
            ],
            [
                'attribute' => 'status',
                'value' => function($data) {
                    if ($data->status == 0) {
                        $status = "Unsubscribe";
                    } elseif ($data->status == 1) {
                        $status = "Subscribe";
                    } elseif ($data->status == 3) {
                        $status = "Delete";
                    }
                    return $status;
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(array('0' => array('id' => '0', 'status' => 'Unsubscribe'), '1' => array('id' => '1', 'status' => 'Subscribe')), 'id', 'status'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                    'options' => ['multiple' => false],
                ],
                'filterInputOptions' => ['placeholder' => 'Select']
            ],
            
            [
                'class' => 'kartik\grid\ActionColumn',
                'dropdown' => false,
                'vAlign' => 'middle',
                'urlCreator' => function($action, $model, $key, $index) {
                    switch ($action) {
                        case "view":
                            return Url::to(['report/view', 'id' => $model->id]);
                            break;
                        
                    }
                },
                        'template' => '{view}',
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
                        $this->view->title = $this->getProjectName() . ": Newsletter Management";

                        $model = new ReportMaster;
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
                        $model= ReportMaster::findOne($report_id);
                       return $this->render('view', ['model' => $model]); 
                    }
                    public function actionUpdate() {
                        if(Yii::$app->request->post()){
                            $booking_id= $_REQUEST['id'];
                            $model= \app\modules\admin\models\BookingMaster::findOne($booking_id);
                            $model->refund_status=$_POST['BookingMaster']['refund_status'];
                            $model->updated_date=date('Y-m-d H:i:s');
                            $model->save(false);
                        }else{
                        $booking_id= $_REQUEST['id'];
                        $model= \app\modules\admin\models\BookingMaster::findOne($booking_id);
                        }
                       return $this->render('update', ['model' => $model]); 
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

                    public function actionDosuspend() {
                        $userId = $_REQUEST['id'];
                        $user = $this->findModel($userId);
                        $user->status = 2;
                        $user->save(false);
                        Yii::$app->session->setFlash('success', 'User suspending successfully.');
                        return $this->redirect(['index']);
                    }

                    public function actionDoactive() {
                        $userId = $_REQUEST['id'];
                        $user = $this->findModel($userId);
                        $user->status = 1;
                        $user->save(false);
                        Yii::$app->session->setFlash('success', 'User activation successfully.');
                        return $this->redirect(['index']);
                    }

                    public function actionDelete() {
                        $userId = $_REQUEST['id'];
                        $user = $this->findModel($userId);
                        $user->status = 3;
                        $user->save(false);
                        Yii::$app->session->setFlash('success', 'User has been deleted.');
//                        return $this->redirect(['index']);
                        return true;
                    }

                    public function actionUserdetailsvarify() {
                        if (Yii::$app->request->isAjax) {
                            $resp = [];
                            $resp['flag'] = false;
                            
                            $userId = $_POST['userId'];
                            $verifyType = $_POST['type'];
                            $user = UserMaster::findOne($userId);
                            if ($user) {
                                if ($verifyType == "phoneverify") {
                                    $user->phone_verification = 1;
                                    $user->save(false);
                                    $resp['flag'] = true;
                                    $resp['msg'] = "Phone verified successfully.";
                                } elseif ($verifyType == "emailverify") {
                                    $user->email_varified = 1;
                                    $user->save(false);
                                    $resp['flag'] = true;
                                    $resp['msg'] = "Email verified successfully.";
                                }
                            } else {
                                $resp['msg'] = "Error! Please try again after some time";
                            }
                            echo json_encode($resp);
                            exit;
                        }
                    }

                    protected function findModel($id) {
                        if (($model = \app\modules\admin\models\BookingMaster::findOne($id)) !== null) {
                            return $model;
                        } else {
                            throw new NotFoundHttpException('The requested page does not exist.');
                        }
                    }

                }
                