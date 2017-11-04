<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Seo;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\Response;
use yii\widgets\ActiveForm;
use kartik\grid\GridView;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\console\Application;
use yii\web\NotFoundHttpException;
use app\modules\admin\components\AdminController;
use app\models\AmbulanceMaster;
use app\models\AmbulanceContact;

class AmbulancemasterController extends AdminController {

    public function column() {
        $viewMsg = 'View';
        $updateMsg = 'Update';
        $gridColumns = [
            ['class' => 'kartik\grid\SerialColumn'],
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'title',
                'label' => 'Title',
                'value' => function ($model) {
                    return ($model->title != '') ? (substr($model->title, 0, 30)) . ((strlen($model->title) > 30) ? ".." : "") : "Not Set";
                }
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'vehiclenumber',
                'label' => 'Vehiclenumber',
            ],
            [
                'attribute' => 'oxygen',
                'value' => function($data) {
                    if ($data->oxygen == 0) {
                        $oxygen = "Not Available";
                    } elseif ($data->oxygen == 1) {
                        $oxygen = "Available";
                    }
                    return $oxygen;
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(array('0' => array('id' => '0', 'oxygen' => 'Not Available'), '1' => array('id' => '1', 'oxygen' => 'Available')), 'id', 'oxygen'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                    'options' => ['multiple' => false],
                ],
                'filterInputOptions' => ['placeholder' => 'Select']
            ], [
                'attribute' => 'all_time',
                'label' => '24X7',
                'value' => function($data) {
                    if ($data->all_time == 0) {
                        $all_time = "Not Available";
                    } elseif ($data->all_time == 1) {
                        $all_time = "Available";
                    }
                    return $all_time;
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(array('0' => array('id' => '0', 'all_time' => 'Not Available'), '1' => array('id' => '1', 'all_time' => 'Available')), 'id', 'all_time'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                    'options' => ['multiple' => false],
                ],
                'filterInputOptions' => ['placeholder' => 'Select']
            ],
            [
                'attribute' => 'ac',
                'value' => function($data) {
                    if ($data->ac == 0) {
                        $ac = "No";
                    } elseif ($data->ac == 1) {
                        $ac = "Yes";
                    }
                    return $ac;
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(array('0' => array('id' => '0', 'ac' => 'No'), '1' => array('id' => '1', 'ac' => 'Yes')), 'id', 'ac'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                    'options' => ['multiple' => false],
                ],
                'filterInputOptions' => ['placeholder' => 'Select']
            ],
            [
                'attribute' => 'status',
                'value' => function($data) {
                    if ($data->status == 0) {
                        $status = "Inactive";
                    } elseif ($data->status == 1) {
                        $status = "Active";
                    }
                    return $status;
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(array('0' => array('id' => '0', 'status' => 'Inactive'), '1' => array('id' => '1', 'status' => 'Active')), 'id', 'status'),
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
                            return Url::to(['ambulancemaster/view', 'id' => $model->id]);
                            break;
                        case "update":
                            return Url::to(['ambulancemaster/update', 'id' => $model->id]);
                            break;
                        case "delete":
                            return Url::to(['ambulancemaster/delete', 'id' => $model->id]);
                            break;
                    }
                },
                'template' => '{view} {update} {delete}',
                'viewOptions' => ['title' => $viewMsg, 'data-toggle' => 'tooltip'],
                'updateOptions' => ['title' => $updateMsg, 'data-toggle' => 'tooltip'],
            ]
        ];
        return $gridColumns;
    }

    public function actionIndex() {
        $searchModel = new AmbulanceMaster();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $widget = GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => $this->column(),
                    'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
                    'headerRowOptions' => ['class' => 'kartik-sheet-style'],
                    'filterRowOptions' => ['class' => 'kartik-sheet-style'],
                    'beforeHeader' => [
                        [
                            'options' => ['class' => 'skip-export'] // remove this row from export
                        ]
                    ],
                    'toolbar' => [
                        ['content' => Html::a('<i class="glyphicon glyphicon-plus"></i> Add', ['create'], ['class' => 'btn btn-info']),
                        ],
                        ['content' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset', ['index'], ['class' => 'btn btn-info']),
                        ]
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
//                        'heading' => '<h3 class="panel-title"><i class="icon-user"></i> Users</h3>',
                        'heading' => '',
                        'type' => 'info',
//                        'type' => GridView::TYPE_PRIMARY,
//                                'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> Add new', ['create'], ['class' => 'btn btn-success']),
                    ],
        ]);
        return $this->render('index', ['widget' => $widget]);
    }

    public function actionGetstates() {
        $type_id = $_REQUEST['id'];
        $doc_specialities = \app\models\States::find()->where("country_id=:country_id", [":country_id" => $type_id])->all();
        $html = "";
        if (count($doc_specialities) > 0) {
            foreach ($doc_specialities as $key => $value) {
                $html .= '<option value="' . $value->id . '">' . $value->name . '</option>';
            }
        } else {
            $html .= '<option value="">No Data</option>';
        }
        return $html;
    }

    public function actionGetcities() {
        $type_id = $_REQUEST['id'];
        $doc_specialities = \app\models\Cities::find()->where("state_id=:state_id", [":state_id" => $type_id])->all();
        $html = "";
        if (count($doc_specialities) > 0) {
            foreach ($doc_specialities as $key => $value) {
                $html .= '<option value="' . $value->id . '">' . $value->name . '</option>';
            }
        } else {
            $html .= '<option value="">No Data</option>';
        }
        return $html;
    }

    public function actionCreate() {
        $model = new AmbulanceMaster;
        $contactmodel = new AmbulanceContact;
        $model->scenario = "create_ambulance";
        $contactmodel->scenario = "create_ambulance";
        $data['model'] = $model;
        $data['contactmodel'] = $contactmodel;
//        if ( $contactmodel->load(Yii::$app->request->post())) {
//            
//        }

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()) && $contactmodel->load(Yii::$app->request->post())) {
            //print_r($contactmodel);
            Yii::$app->response->format = Response::FORMAT_JSON;
            $responcemasterModel = ActiveForm::validate($model);

            $array = (array) $contactmodel->contact_number;
            $array = array_map('trim', $array);

            if ($array[0] == "") {
                $responcecontactmodel = ActiveForm::validate($contactmodel);
                $responce = array_merge($responcemasterModel, $responcecontactmodel);
            } else {

                $responce = $responcemasterModel;
            }
            if (!empty($responce)) {
                return $responce;
            }
            if ($model->validate() && $model->save(false)) {

                $contactmodel->ambulance_id = $model->id;
                $contactArr = $contactmodel->contact_number;
                foreach ($contactArr as $value) {
                    // print_r($value);
                    $contactmodel->setIsNewRecord(true);
                    $contactmodel->id = null;

                    $contactmodel->contact_number = $value;
                    $contactmodel->save(false);
                }
            }
            Yii::$app->session->setFlash('success', 'created successfully');
            return $this->redirect(["index"]);
        }

        return $this->render("create", ["data" => $data]);
    }

    public function actionView($id) {
        $model = AmbulanceMaster::findOne($id);
        $ambulance_contact = AmbulanceContact::find()->where(["ambulance_id" => $id])->all();
        return $this->render('view', ['model' => $model, 'ambulance_contact' => $ambulance_contact]);
    }

    public function actionDelete() {
        $userId = $_REQUEST['id'];
        $user = $this->findModel($userId);
        $user->status = 3;
        $user->save(false);
        Yii::$app->session->setFlash('success', ' deleted.');
//                        return $this->redirect(['index']);
        return $this->redirect(["index"]);
    }

    public function actionUpdate($id) {
        $model = new AmbulanceMaster;
        $contactmodel = new AmbulanceContact;
        $model->scenario = "update_ambulance";
        $contactmodel->scenario = "update_ambulance";
        $model = AmbulanceMaster::findOne($id);
        $contactmodel = AmbulanceContact::find()->where(["ambulance_id" => $id])->all();
        
        
        $data['model'] = $model;
        $data['contactmodel'] = $contactmodel;
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()) && $contactmodel->load(Yii::$app->request->post())) {
            //print_r($contactmodel);
            Yii::$app->response->format = Response::FORMAT_JSON;
            $responcemasterModel = ActiveForm::validate($model);

            $array = (array) $contactmodel->contact_number;
            $array = array_map('trim', $array);

            if ($array[0] == "") {
                $responcecontactmodel = ActiveForm::validate($contactmodel);
                $responce = array_merge($responcemasterModel, $responcecontactmodel);
            } else {

                $responce = $responcemasterModel;
            }
            if (!empty($responce)) {
                return $responce;
            }
            if ($model->validate() && $model->save(false)) {

                $contactmodel->ambulance_id = $model->id;
                $contactArr = $contactmodel->contact_number;
                foreach ($contactArr as $value) {
                    // print_r($value);
                    $contactmodel->setIsNewRecord(true);
                    $contactmodel->id = null;

                    $contactmodel->contact_number = $value;
                    $contactmodel->save(false);
                }
            }
            Yii::$app->session->setFlash('success', 'created successfully');
            return $this->redirect(["index"]);
        }
        //print_r($data);
        //$data['model'] = $model;
        return $this->render('update', ["data" => $data]);
    }

//    protected function findModel($id) {
//        if (($model = AmbulanceMaster::findOne($id)) !== null && ($modelcontact = AmbulanceContact::find()->where(["ambulance_id" => $id]))->all() !== null) {
//            $modelall['model'] = $model;
//            $modelall['modelcontact'] = $modelcontact;
//            return $modelall;
//        } else {
//            throw new NotFoundHttpException('The requested page does not exist.');
//        }
//    }

}
