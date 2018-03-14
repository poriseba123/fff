<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\web\Controller;
use kartik\grid\GridView;
use app\models\ContactUs;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use app\modules\admin\models\SearchEmail;
use app\modules\admin\components\AdminController;

class FeedbackController extends AdminController {

    public function columns() {
        $viewMsg = 'View';
        $updateMsg = 'Update';
        $deleteMsg = 'Delete';
        $gridColumns = [
            ['class' => 'kartik\grid\SerialColumn'],
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'name',
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'email',
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'subject',
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'submit_date',
                'filterType' => false,
                'pageSummary' => true,
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'reply_date',
                'filterType' => false,
                'pageSummary' => true,
            ],
            [
                'attribute' => 'status',
                'value' => function($data) {
                    if ($data->status == 0) {
                        $status = "Not Seen";
                    } elseif ($data->status == 1) {
                        $status = "Seen";
                    } else {
                        $status = "Replyed";
                    }
                    return $status;
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(array('0' => array('id' => '0', 'status' => 'Not Seen'), '1' => array('id' => '1', 'status' => 'Seen'), '2' => array('id' => '2', 'status' => 'Replyed')), 'id', 'status'),
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
                            return Url::to(['feedback/view', 'id' => $model->id]);
                            break;
                        case "delete":
                            return Url::to(['feedback/delete', 'id' => $model->id]);
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
        $model = new ContactUs();
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
        $model = ContactUs::findOne($id);

        $model->scenario = "update";
        if ($model->load(Yii::$app->request->post())) {
//            $model->submit_date = date('Y-m-d H:i:s');

            if ($model->validate() && $model->save()) {
                $name = $_POST['ContactUs']['name'];
                $email = $_POST['ContactUs']['email'];
                $message = $_POST['ContactUs']['reply_message'];

                $email_setting = $this->get_email_data('feedback_email', array('FULL_NAME' => $name,
                    'PROJECT_NAME' => 'poriseba.com',
                    'EMAIL' => $email,
                    'LINK' => 'http://poriseba.com',
                    'FEEDBACK' => $message
                ));
//                print_r($email_setting);

                $email_data = [
                    'to' => $email,
                    'subject' => $email_setting['subject'],
                    'template' => 'contact_email',
                    'body' => $email_setting['body']
                ];
                $this->SendMail($email_data);
                $resp['flag'] = true;
                $model->status = 2;
                $model->save();
                Yii::$app->session->setFlash('success-msg', 'Feedback email send successfully.');
                return $this->refresh();
            }
        } else {
            if ($model->status == 0) {
                $model->status = 1;
                $model->save();
            }
        }
        return $this->render('view', ['model' => $model]);
    }

    public function actionDelete($id) {
        $model = ContactUs::findOne($id);
        $model->status = '3';
        $model->save(false);
        Yii::$app->session->setFlash('success-msg', 'Email content are successfully updated');
        return $this->redirect(['index']);
    }

}

?>