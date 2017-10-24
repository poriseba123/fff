<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\data\Pagination;
use kartik\grid\GridView;
use app\models\UserVehicle;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use app\modules\admin\models\UserMaster;
use app\modules\admin\models\SearchDriverRequest;
use app\modules\admin\components\AdminController;

class DriverrequestController extends AdminController {

    public function columns() {
        $viewMsg = 'View';
        $updateMsg = 'Update';
        $deleteMsg = 'Delete';
        $gridColumns = [
            ['class' => 'kartik\grid\SerialColumn'],
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'full_name',
                'value' => function ($model) {
                    return $model->userDetails->first_name . ' ' . $model->userDetails->last_name;
                }
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'vehicle_brand',
                'value' => function ($model) {
                    return $model->vBrand->brand;
                }
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'vehicle_model',
                'value' => function ($model) {
                    return $model->vModel->model_no;
                }
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'vehicle_color',
                'value' => function ($model) {
                    return $model->vColor->color_name_es;
                }
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'label' => "Requested Date",
                'attribute' => 'added_date',
                'filterType' => false,
                'pageSummary' => true,
            ],
            [
                'attribute' => 'status',
                'value' => function($data) {
                    if ($data->status == 0) {
                        $status = "Pending";
                    } elseif ($data->status == 1) {
                        $status = "Approved";
                    } elseif ($data->status == 2) {
                        $status = "Canceled";
                    }
                    return $status;
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(array('0' => array('id' => '0', 'status' => 'Pending'), '1' => array('id' => '1', 'status' => 'Approved'), '2' => array('id' => '2', 'status' => 'Canceled')), 'id', 'status'),
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
                            return Url::to(['driverrequest/view', 'id' => $model->id]);
                            break;
                        case "active":
                            return Url::to(['driverrequest/active', 'id' => $model->id]);
                            break;
                        case "inactive":
                            return Url::to(['driverrequest/inactive', 'id' => $model->id]);
                            break;
                        case "update":
                            return Url::to(['driverrequest/update', 'id' => $model->id]);
                            break;
                        case "delete":
                            return Url::to(['driverrequest/delete', 'id' => $model->id]);
                            break;
                    }
                },
                        'template' => '{view}',
                        'viewOptions' => ['title' => $viewMsg, 'data-toggle' => 'tooltip'],
                        'updateOptions' => ['title' => $updateMsg, 'data-toggle' => 'tooltip'],
                        'deleteOptions' => ['title' => $deleteMsg, 'data-toggle' => 'tooltip', 'data-confirm' => "Are you sure you want to delete this user?"],
                    ]
                ];
                return $gridColumns;
            }

            public function actionIndex() {
                $this->view->title = $this->getProjectName() . ": View Driver Request";

                $model = new SearchDriverRequest;
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

            public function actionView($id) {
                $model = $this->findModel($id);
                $user = UserMaster::findOne($model->user_id);
                return $this->render("update", ['model' => $model, 'user' => $user]);
            }

            public function actionAcceptdriverlicence() {
                if (Yii::$app->request->isAjax) {
                    $resp = [];
                    $resp['flag'] = false;
                    $userId = $_REQUEST['userId'];
                    $type = $_REQUEST['type'];
                    $cause = isset($_REQUEST['causeOfDLCCancellation']) ? $_REQUEST['causeOfDLCCancellation'] : "";
                    $findUser = UserMaster::findOne($userId);
                    if ($findUser) {
                        if ($type == "not-accepted") {
                            if ($cause != "") {
                                $findUser->drive_image_verification = 2;
                                $findUser->driving_cancle_cause = $cause;
                                $findUser->save(false);
                                $resp['flag'] = true;
                                $resp['msg'] = "Driving Licence has been declined";
                            } else {
                                $resp['causemsg'] = "Cause of Cancellation can not be blank";
                            }
                        } elseif ($type == "accepted") {
                            $findUser->drive_image_verification = 1;
                            $findUser->save(false);
                            $resp['flag'] = true;
                            $resp['msg'] = "Driving Licence has been approved";
                        }
                    } else {
                        $resp['msg'] = "Error! Please try again after some times";
                    }
                    echo json_encode($resp);
                    exit;
                }
            }

            public function actionAcceptvehicle() {
                if (Yii::$app->request->isAjax) {
                    $resp = [];
                    $resp['flag'] = false;
                    $targetId = $_REQUEST['targetId'];
                    $type = $_REQUEST['type'];
                    $cause = isset($_REQUEST['causeOfVehicleCancellation']) ? $_REQUEST['causeOfVehicleCancellation'] : "";

                    $findVehicle = UserVehicle::findOne($targetId);
                    if ($findVehicle) {
                        $user = UserMaster::findOne($findVehicle->user_id);
                        if ($type == "not-accepted") {
                            if ($cause != "") {
                                $findVehicle->status = 2;
                                $user->drive_image_verification = 2;
                                $findVehicle->cancelation_cause = $cause;
                                $findVehicle->save(false);
                                $user->save(false);
                                //======================= send request cancellation email =========================
                                $linkLogin = Yii::$app->urlManager->createAbsoluteUrl(["site/login"]);
                                $wellcome_email = $this->get_email_data('canceled_vehicle_req', array('LINK' => $linkLogin, 'FULL_NAME' => $user->first_name, 'PROJECT_NAME' => $this->getProjectName(), 'CANCELLATION_CAUSE' => $findVehicle->cancelation_cause));
                                $wellcome_email_data = [
                                    'to' => $user->email,
                                    'subject' => $wellcome_email['subject'],
                                    'template' => 'forget_pass',
                                    'body' => $wellcome_email['body']
                                ];
                                $this->SendMail($wellcome_email_data);
//                                =================
                                $resp['flag'] = true;
                                $resp['msg'] = "Vehicle has been declined";
                            } else {
                                $resp['causemsg'] = "Cause of Cancellation can not be blank";
                            }
                        } elseif ($type == "accepted") {
                            $user->drive_image_verification = 1;
                            $findVehicle->status = 1;
                            $findVehicle->save(false);
                            $user->save(false);
                            //======================= send request approved email =========================
                            $linkLogin = Yii::$app->urlManager->createAbsoluteUrl(["site/login"]);
                            $wellcome_email = $this->get_email_data('approved_vehicle_req', array('LINK' => $linkLogin, 'FULL_NAME' => $user->first_name, 'PROJECT_NAME' => $this->getProjectName()));
                            $wellcome_email_data = [
                                'to' => $user->email,
                                'subject' => $wellcome_email['subject'],
                                'template' => 'forget_pass',
                                'body' => $wellcome_email['body']
                            ];
                            $this->SendMail($wellcome_email_data);
//                                =================
                            $resp['flag'] = true;
                            $resp['msg'] = "Vehicle has been approved";
                        }
                    } else {
                        $resp['msg'] = "Error! Please try again after some times";
                    }
                    echo json_encode($resp);
                    exit;
                }
            }

            protected function findModel($id) {
                if (($model = UserVehicle::findOne($id)) !== null) {
                    return $model;
                } else {
                    throw new NotFoundHttpException('The requested page does not exist.');
                }
            }

        }
        