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
use app\models\MessageReport;
use app\models\MessageMaster;

class MessagereportController extends AdminController {

    public function columns() {
        $viewMsg = 'View';
        $updateMsg = 'Update';
        $deleteMsg = 'Delete';
        $gridColumns = [
            ['class' => 'kartik\grid\SerialColumn'],
            [
                'class' => '\kartik\grid\DataColumn',
                'header' => 'Message Receiver',
                'attribute' => 'user_id',
                'value' => function($data) {
                    return $data->whoReport->first_name.' '.$data->whoReport->last_name;
                },
                
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'header' => 'Message Sender',
                'attribute' => 'message_sender',
                'value' => function($data) {
                    return $data->messagerel->fromUserDetails->first_name.' '.$data->messagerel->fromUserDetails->last_name;
                },
                
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'header' => 'Message',
                'attribute' => 'actual_message',
                'value' => function($data) {
                    return $data->messagerel->message;
                },
                
            ],
              [
                'class' => '\kartik\grid\DataColumn',
                'header' => 'Reason 1',
                'attribute' => 'step1',
                
            ],
              [
                'class' => '\kartik\grid\DataColumn',
                'header' => 'Reason 2',
                'attribute' => 'step2',
                
            ],
              [
                'class' => '\kartik\grid\DataColumn',
                'header' => 'Comment',
                'attribute' => 'message',
                
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'header' => 'Reported Time',
                'attribute' => 'created_at',
            ],
            
            [
                'class' => 'kartik\grid\ActionColumn',
                'dropdown' => false,
                'vAlign' => 'middle',
                'urlCreator' => function($action, $model, $key, $index) {
                    switch ($action) {
                        case "view":
                            return Url::to(['messagereport/view', 'id' => $model->id]);
                            break;
                        case "delete":
                            return Url::to(['messagereport/delete', 'id' => $model->id]);
                            break;
                        
                    }
                },
                        'template' => '{delete}',
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
                        $this->view->title = $this->getProjectName() . ": Message Report";

                        $model = new MessageReport;
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
                        $Id = $_REQUEST['id'];
                        $model= MessageReport::findOne($Id);
                        $model->status=3;
                        $model->save(false);
                        $message= MessageMaster::findOne($model->message_id);
                        if(count($message)>0){
                          $message->status=3;  
                          $message->save(false);  
                        }
                        Yii::$app->session->setFlash('success', 'Message has been deleted.');
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
                