<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Seo;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\web\Controller;
use kartik\grid\GridView;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\console\Application;
use yii\web\NotFoundHttpException;
use app\modules\admin\components\AdminController;
use app\models\DoctorSpecialities;
use app\models\DoctorMaster;
use app\models\DoctorType;
use app\models\DoctorChamber;
use app\models\DoctorChamberTime;

class DoctorController extends AdminController {

    public function column_chamber() {
        $viewMsg = 'View';
        $updateMsg = 'Update';
        $gridColumns = [
            ['class' => 'kartik\grid\SerialColumn'],
            [
                'class' => '\kartik\grid\DataColumn',
                'label' => 'chamber_name',
                'attribute' => 'chamber_name',
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'label' => 'address',
                'attribute' => 'address',
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
                            return Url::to(['doctor/chamberview', 'id' => $model->id]);
                            break;
                        case "update":
                            return Url::to(['doctor/chamberupdate', 'id' => $model->id]);
                            break;
                        case "delete":
                            return Url::to(['doctor/chamberdelete', 'id' => $model->id]);
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
    public function column() {
        $viewMsg = 'View';
        $updateMsg = 'Update';
        $gridColumns = [
            ['class' => 'kartik\grid\SerialColumn'],
            [
                'class' => '\kartik\grid\DataColumn',
                'label' => 'First Name',
                'attribute' => 'first_name',
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'label' => 'Registration No',
                'attribute' => 'registration_no',
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'label' => 'Email',
                'attribute' => 'email',
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'Mobile No',
                'attribute' => 'mobile_no',
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'email_verified',
                'label' => 'Email Verified',
            ],
            [
                'attribute' => 'gender',
                'value' => function($data) {
                    if ($data->gender == 1) {
                        $gender = "Male";
                    } elseif ($data->gender == 2) {
                        $gender = "Female";
                    } else{
                        $gender = "Unknown";
                    }
                    return $gender;
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(array('0' => array('id' => '0', 'gender' => 'Unknown'), '1' => array('id' => '1', 'gender' => 'Male'), '2' => array('id' => '2', 'gender' => 'Female')), 'id', 'gender'),
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
                            return Url::to(['doctor/view', 'id' => $model->id]);
                            break;
                        case "update":
                            return Url::to(['doctor/update', 'id' => $model->id]);
                            break;
                        case "delete":
                            return Url::to(['doctor/delete', 'id' => $model->id]);
                            break;
                        case "chamber":
                            return Url::to(['doctor/chamberindex', 'id' => $model->id]);
                            break;
                    }
                },
                'template' => '{view} {update} {delete} {chamber}',
                        'buttons' => [
                                    'chamber' => function ($url, $model) {
                                return $model->status == 1 ? Html::a('<i class="fa fa-university" aria-hidden="true"></i>', Url::to(['doctor/chamberindex', 'id' => $model->id]), [
                                            'title' => Yii::t('yii', 'Chambers'),
                                            'data-toggle' => 'tooltip'
                                        ]) : '';
                            },
                                ],
                'viewOptions' => ['title' => $viewMsg, 'data-toggle' => 'tooltip'],
                'updateOptions' => ['title' => $updateMsg, 'data-toggle' => 'tooltip'],
            ]
        ];
        return $gridColumns;
    }

    public function actionChamberindex($id) {
        $searchModel = new DoctorChamber;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $widget = GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => $this->column_chamber(),
                    'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
                    'headerRowOptions' => ['class' => 'kartik-sheet-style'],
                    'filterRowOptions' => ['class' => 'kartik-sheet-style'],
                    'beforeHeader' => [
                        [
                            'options' => ['class' => 'skip-export'] // remove this row from export
                        ]
                    ],
                    'toolbar' => [
                        
                        ['content' => Html::a('<i class="glyphicon glyphicon-plus"></i> Add', ['chambercreate'], ['class' => 'btn btn-info']),
                        ],
                        ['content' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset', ['chamberindex'], ['class' => 'btn btn-info']),
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
        return $this->render('chamberindex', ['widget' => $widget]);
    }
    public function actionIndex() {
        $searchModel = new DoctorMaster;
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

    public function actionGetspecialities() {
        $type_id=$_REQUEST['id'];
        $doc_specialities= DoctorSpecialities::find()->where("doctor_type_id=:doctor_type_id AND status<>:status",[":doctor_type_id"=>$type_id,":status"=>3])->all();
        $html="";
        if(count($doc_specialities)>0){
        foreach ($doc_specialities as $key => $value) {
            $html.='<option value="'.$value->id.'">'.$value->speciality.'</option>';
        }
        }else{
           $html.='<option value="">No Data</option>';  
        }
        return $html;
    }
    public function actionChambercreate() {
        $data=[];
        $model = new DoctorMaster;
        $doc_type= DoctorType::find()->where("status<>:status",[":status"=>'3'])->all();
        $data['model']=$model;
        $data['doc_type']=$doc_type;
        $model->scenario = "create_doctor";
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $model->created_at=date('Y-m-d H:i:s'); 
                $model->save(false);
                Yii::$app->session->setFlash('success', 'created successfully');
                return $this->redirect(["index"]);
            }
        }
        return $this->render("create", ["data" => $data]);
    }
     public function actionChamberupdate($id) {
        $data=[];
         $model = DoctorMaster::findOne($id);
        $doc_type= DoctorType::find()->where("status<>:status",[":status"=>'3'])->all();
        $data['model']=$model;
        $data['doc_type']=$doc_type;
        $model->scenario = 'update_doctor';
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->updated_at=date('Y-m-d H:i:s'); 
                $model->save(false);
            Yii::$app->session->setFlash('success', 'updated successfully!');
            return $this->refresh();
        }
        $data['model'] = $model;
        $data['doc_type']=$doc_type;
        return $this->render('update', ["data" => $data]);
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
    public function actionCreate() {
        $data=[];
        $model = new DoctorMaster;
        $doc_type= DoctorType::find()->where("status<>:status",[":status"=>'3'])->all();
        $data['model']=$model;
        $data['doc_type']=$doc_type;
        $model->scenario = "create_doctor";
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $model->created_at=date('Y-m-d H:i:s'); 
                $model->save(false);
                Yii::$app->session->setFlash('success', 'created successfully');
                return $this->redirect(["index"]);
            }
        }
        return $this->render("create", ["data" => $data]);
    }
     public function actionUpdate($id) {
        $data=[];
         $model = DoctorMaster::findOne($id);
        $doc_type= DoctorType::find()->where("status<>:status",[":status"=>'3'])->all();
        $data['model']=$model;
        $data['doc_type']=$doc_type;
        $model->scenario = 'update_doctor';
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->updated_at=date('Y-m-d H:i:s'); 
                $model->save(false);
            Yii::$app->session->setFlash('success', 'updated successfully!');
            return $this->refresh();
        }
        $data['model'] = $model;
        $data['doc_type']=$doc_type;
        return $this->render('update', ["data" => $data]);
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

    public function actionView($id) {
        return $this->render('view', ['model' => $this->findModel($id),
        ]);
    }

    


    protected function findModel($id) {
        if (($model = DoctorSpecialities::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
