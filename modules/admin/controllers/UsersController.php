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

class UsersController extends AdminController {

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
                    return $model->first_name . ' ' . $model->last_name;
                }
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'email',
            ],
//            [
//                'class' => '\kartik\grid\DataColumn',
//                'attribute' => 'phone',
//            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'added_date',
                'filterType' => false,
                'pageSummary' => true,
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'header' => 'Driver/User',
                'attribute' => 'id',
                'value' => function($data) {
                    if (isset($data->vehicle) && $data->vehicle->status!=3) {
                        $status = "Driver";
                    } else {
                        $status = "User";
                    } 
                    return $status;
                },
                'filterType' => false,
                'pageSummary' => true,
            ],
            [
                'attribute' => 'status',
                'value' => function($data) {
                    if ($data->status == 0) {
                        $status = "Inactive";
                    } elseif ($data->status == 1) {
                        $status = "Active";
                    } elseif ($data->status == 2) {
                        $status = "Suspend";
                    }
                    return $status;
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(array('0' => array('id' => '0', 'status' => 'Inactive'), '1' => array('id' => '1', 'status' => 'Active'), '2' => array('id' => '2', 'status' => 'Suspended')), 'id', 'status'),
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
                            return Url::to(['users/view', 'id' => $model->id]);
                            break;
                        case "active":
                            return Url::to(['users/active', 'id' => $model->id]);
                            break;
                        case "inactive":
                            return Url::to(['users/inactive', 'id' => $model->id]);
                            break;
                        case "update":
                            return Url::to(['users/update', 'id' => $model->id]);
                            break;
                        case "delete":
                            return Url::to(['users/delete', 'id' => $model->id]);
                            break;
                    }
                },
                        'template' => '{updateDetails} {doActive} {doSuspend} {delete}',
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

                        $model = new SearchUser;
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
                        if (($model = UserMaster::findOne($id)) !== null) {
                            return $model;
                        } else {
                            throw new NotFoundHttpException('The requested page does not exist.');
                        }
                    }

                }
                