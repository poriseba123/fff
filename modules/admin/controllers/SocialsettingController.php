<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\web\Controller;
use kartik\grid\GridView;
use app\models\UserDetails;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use app\models\SocialCredentialsSetting;
use app\models\SearchSocialCredentialsSetting;

class SocialsettingController extends AdminController {

    public function columns() {
        $viewMsg = 'View';
        $updateMsg = 'Update';
        $gridColumns = [
            ['class' => 'kartik\grid\SerialColumn'],
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'app_name',
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'app_client_id',
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'sceret_key',
            ],
            [
                'class' => 'kartik\grid\ActionColumn',
                'dropdown' => false,
                'vAlign' => 'middle',
                'urlCreator' => function($action, $model, $key, $index) {
                    switch ($action) {
                        case "view":
                            return Url::to(['socialsetting/view', 'id' => $model->id]);
                            break;
                        case "update":
                            return Url::to(['socialsetting/update', 'id' => $model->id]);
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
                $model = new SearchSocialCredentialsSetting;
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
                                'heading' => '<h3 class="panel-title"><i class="icon-user"></i> Social Setting</h3>',
                                'heading' => '',
                                'type' => 'info',
//                                        'type' => GridView::TYPE_PRIMARY,
//                                'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> Create User', ['create'], ['class' => 'btn btn-success']),
                            ],
                ]);
                return $this->render('index', ['widget' => $widget]);
            }

            public function actionCreate() {
                $model = new UserMaster;
                $user_det = new UserDetails;
                $model->scenario = $user_det->scenario = 'user_create';
                $data['model'] = $model;
                $data['user_det'] = $user_det;
                if ($model->load(Yii::$app->request->post()) && $user_det->load(Yii::$app->request->post())) {
                    $password = $this->rand_string(6);
                    $model_validate = $model->validate();
                    $user_det_validate = $user_det->validate();
                    $user_det->latitude = $_POST['UserDetails']['latitude'];
                    $user_det->longitude = $_POST['UserDetails']['longitude'];
                    if ($model_validate && $user_det_validate) {
                        $full_name = $model->first_name . ' ' . $model->last_name;
//                $model->password = Yii::$app->getSecurity()->generatePasswordHash($password);
                        $model->password = md5($password);
                        $model->active_token = $this->rand_string(10);
                        $model->user_type = 2;
                        $model->created_at = date('Y-m-d H:i:s');
                        $model->status = 0;
                        if ($model->save(false)) {
                            $user_det->latitude = $_POST['UserDetails']['latitude'];
                            $user_det->longitude = $_POST['UserDetails']['longitude'];
                            $user_det->user_id = $model->id;
                            $user_det->save(false);
                            $link = '<a href=' . Yii::$app->urlManager->createAbsoluteUrl(['site/ActiveAccount', 'id' => $model->id, 'token' => $model->active_token]) . '>' . Yii::$app->urlManager->createAbsoluteUrl(['site/ActiveAccount', 'id' => $model->id, 'token' => $model->active_token]) . '</a>';
                            $email_setting = $this->get_email_data('create_user', 'admin', array('VERIFICATION_LINK' => $link, 'NAME' => $full_name, 'EMAIL' => $model->email, 'PASSWORD' => $password));
                            $email_data = [
                                'to' => $model->email,
                                'subject' => 'Successfully Registered',
                                'template' => 'main',
                                'data' => ['message' => $email_setting['body']]
                            ];
                            $this->SendMail($email_data);
                            Yii::$app->session->setFlash('success', 'User created successfully.');
                        }
                        return $this->redirect(Url::toRoute('users/index'));
                    }
                }
                return $this->render('create', $data);
            }

            public function actionView($id) {
                $user_det = UserDetails::find()->where(['user_id' => $id])->one();
                return $this->render('view', [
                            'model' => $this->findModel($id), 'user_det' => $user_det
                ]);
            }

            public function actionUpdate($id) {
                $model = $this->findModel($id);
                $user_det = UserDetails::find()->where(['user_id' => $id])->one();
                $model->scenario = $user_det->scenario = 'user_update';
                $data['model'] = $model;
                $data['user_det'] = $user_det;
                if ($model->load(Yii::$app->request->post()) && $user_det->load(Yii::$app->request->post())) {
                    $model_validate = $model->validate();
                    $user_det_validate = $user_det->validate();
                    $user_det->latitude = $_POST['UserDetails']['latitude'];
                    $user_det->longitude = $_POST['UserDetails']['longitude'];
                    if ($model_validate && $user_det_validate) {
                        $model->updated_at = date('Y-m-d H:i:s');
                        if ($model->save(false)) {
                            $user_det->latitude = $_POST['UserDetails']['latitude'];
                            $user_det->longitude = $_POST['UserDetails']['longitude'];
                            $user_det->updated_at = date('Y-m-d H:i:s');
                            $user_det->user_id = $model->id;
                            $user_det->save(false);
                        }
                        Yii::$app->session->setFlash('success', 'User updated successfully.');
                        return $this->refresh();
                    }
                }
                return $this->render('update', $data);
            }

            protected function findModel($id) {
                if (($model = UserMaster::findOne($id)) !== null) {
                    return $model;
                } else {
                    throw new NotFoundHttpException('The requested page does not exist.');
                }
            }

        }
        