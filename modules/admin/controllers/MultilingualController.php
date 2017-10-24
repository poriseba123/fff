<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\helpers\Url;
use yii\helpers\Html;
use app\models\Message;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\SourceMessage;
use yii\web\NotFoundHttpException;
use app\modules\admin\models\SearchSourceMessage;
use app\modules\admin\components\AdminController;

class MultilingualController extends AdminController {

    public function columns() {
        $viewMsg = 'View';
        $updateMsg = 'Update';
        $deleteMsg = 'Delete';
        $gridColumns = [
            [
                'class' => 'kartik\grid\SerialColumn'
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'message',
            ],
            [
                'class' => 'kartik\grid\ActionColumn',
                'dropdown' => false,
                'vAlign' => 'middle',
                'urlCreator' => function($action, $model, $key, $index) {
                    switch ($action) {
                        case "view":
                            return Url::to(['emails/view', 'id' => $model->id]);
                        case "update":
                            return Url::to(['multilingual/update', 'id' => $model->id]);
                        case "delete":
                            return Url::to(['emails/delete', 'id' => $model->id]);
                    }
                },
                        'template' => '{update}',
                        'viewOptions' => ['title' => $viewMsg, 'data-toggle' => 'tooltip'],
                        'deleteOptions' => ['title' => $deleteMsg, 'data-toggle' => 'tooltip', 'data-confirm' => "Are you sure you want to delete this user?"],
                    ]
                ];
                return $gridColumns;
            }

            public function actionIndex() {
                $model = new SearchSourceMessage();
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
                                'heading' => '<h3 class="panel-title"><i class="icon-email"></i> Manage Multilingal Messages</h3>',
                                'heading' => '',
                                'type' => 'info',
//                                        'type' => GridView::TYPE_PRIMARY,
//                                'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> Create User', ['create'], ['class' => 'btn btn-success']),
                            ],
                ]);
                return $this->render('index', ['widget' => $widget]);
            }

            public function actionUpdate($id) {
                $models = Message::findAll($id);
                $modelSourceMessage = SourceMessage::findOne($id);

                foreach ($models as $value) {
                    if ($value->language == 'en') {
                        $model_en = $value;
                        $model_en->translation_en = $value->translation;
                        $model_en->scenario = "update";
                    } elseif ($value->language == 'es') {
                        $model_es = $value;
                        $model_es->translation_es = $value->translation;
                        $model_es->scenario = "update";
                    }
                }

                if (isset($model_en)) {
                    $model['en'] = [];
                    array_push($model['en'], $model_en);
                    $model['en'] = $model['en'][0];
                } else {
                    $model_en = new Message();
                    $model_en->id = $id;
                    $model_en->language = 'en';
                    $model_en->save();

                    $model_en->translation_en = '';
                    $model_en->scenario = "update";

                    $model['en'] = [];
                    array_push($model['en'], $model_en);
                    $model['en'] = $model['en'][0];
                }
                if (isset($model_es)) {
                    $model['es'] = [];
                    array_push($model['es'], $model_es);
                    $model['es'] = $model['es'][0];
                } else {
                    $model_es = new Message();
                    $model_es->id = $id;
                    $model_es->language = 'es';
                    $model_es->save();

                    $model_es->translation_es = '';
                    $model_es->scenario = "update";

                    $model['es'] = [];
                    array_push($model['es'], $model_es);
                    $model['es'] = $model['es'][0];
                }

                if (isset($_POST['Message'])) {
                    if (isset($_POST['Message']['translation_en'])) {
                        $model_update = Message::find()->where(['id' => $model['en']->id, 'language' => 'en'])->one();
                        $model_update->translation = $_POST['Message']['translation_en'];
                        $model_update->save();
                    }
                    if (isset($_POST['Message']['translation_es'])) {
                        $model_update = Message::find()->where(['id' => $model['es']->id, 'language' => 'es'])->one();
                        $model_update->translation = $_POST['Message']['translation_es'];
                        $model_update->save();
                    }
                    Yii::$app->session->setFlash('success-msg', "Message updated successfully");
                    return $this->refresh();
                }

                return $this->render('update', ['model' => $model, 'modelSourceMessage' => $modelSourceMessage]);
            }

        }
        