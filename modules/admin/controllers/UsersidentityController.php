<?php

namespace app\modules\admin\controllers;

use Yii;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\web\NotFoundHttpException;
use yii\data\Pagination;
use app\modules\admin\models\UserMaster;
use app\models\IdentityDocument;
use app\modules\admin\models\SearchUser;
use app\modules\admin\components\AdminController;

class UsersidentityController extends AdminController {

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
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'identity',
                'value' => function ($model) {
                    $type = \app\models\IdentityDocument::find()->where("user_id=$model->id AND status!=3")->one();
                    if (isset($type) && count($type) > 0 && $type->type == 1) {
                        return "Identification card";
                    } else {
                        return "Passport";
                    }
                }
            ],
//            [
//                'class' => '\kartik\grid\DataColumn',
//                'attribute' => 'Identity',
//                'value' => function ($model) {
//                    if($model->)
//                }
//            ],
            [
                'attribute' => 'identity_document_verified',
                'value' => function($data) {
                    if ($data->identity_document_verified == 2) {
                        $status = "Pending";
                    } elseif ($data->identity_document_verified == 1) {
                        $status = "Approved";
                    } elseif ($data->identity_document_verified == 3) {
                        $status = "Cancelled";
                    }
                    return $status;
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(array('0' => array('id' => '1', 'status' => 'Approved'), '1' => array('id' => '2', 'status' => 'Pending'), '2' => array('id' => '3', 'status' => 'Cancelled')), 'id', 'status'),
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
                            return Url::to(['usersidentity/view', 'id' => $model->userIdentity->id]);
                            break;
                        case "active":
                            return Url::to(['usersidentity/active', 'id' => $model->userIdentity->id]);
                            break;
                        case "inactive":
                            return Url::to(['usersidentity/inactive', 'id' => $model->userIdentity->id]);
                            break;
                        case "update":
                            return Url::to(['usersidentity/update', 'id' => $model->userIdentity->id]);
                            break;
                        case "delete":
                            return Url::to(['usersidentity/delete', 'id' => $model->userIdentity->id]);
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

                        $model = new SearchUser;
                        $dataProvider = $model->searchIdentity(Yii::$app->request->queryParams);
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
                        $identityMaster = IdentityDocument::findOne($id);
                        $user = $this->findModel($identityMaster->user_id);
                        return $this->render('update', ['model' => $user]);
                    }

                    public function actionApproveduseridentity($id) {
                        $user = $this->findModel($id);
                        $user->identity_document_verified = 1;
                        $user->save(false);
                        $userIdentification = \app\models\IdentityDocument::find()->where("user_id=:userId AND status<>:status", [":userId" => $id, ":status" => 3], ["order" => "id desc"])->one();
                        $userIdentification->status = 1;
                        $userIdentification->save(false);
                        Yii::$app->session->setFlash("success", "User Identify Document has been Approved");
                        return $this->redirect(["view", "id" => $id]);
                    }

                    public function actionCanceluseridentity($id) {
                        $user = $this->findModel($id);
                        $user->identity_document_verified = 3;
                        $user->save(false);
                        $userIdentification = \app\models\IdentityDocument::find()->where("user_id=:userId AND status<>:status", [":userId" => $id, ":status" => 3], ["order" => "id desc"])->one();
                        $userIdentification->status = 3;
                        $userIdentification->save(false);
                        Yii::$app->session->setFlash("success", "User Identify Document has been declined");
                        return $this->redirect(["view", "id" => $id]);
                    }

                    protected function findModel($id) {
                        if (($model = UserMaster::findOne($id)) !== null) {
                            return $model;
                        } else {
                            throw new NotFoundHttpException('The requested page does not exist.');
                        }
                    }

                }
                