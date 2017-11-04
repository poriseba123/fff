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
use app\models\MedicineShopMaster;

class MedicineshopController extends AdminController {

    public function column() {
        $viewMsg = 'View';
        $updateMsg = 'Update';
        $gridColumns = [
            ['class' => 'kartik\grid\SerialColumn'],
            [
                'class' => '\kartik\grid\DataColumn',
                'label' => 'Name',
                'attribute' => 'name',
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'label' => 'address',
                'attribute' => 'address',
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'label' => 'open_time',
                'attribute' => 'open_time',
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'label' => 'close_time',
                'attribute' => 'close_time',
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
                    }
                },
                'template' => '{view} {update} {delete}',
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

    public function actionIndex() {
        $searchModel = new MedicineShopMaster;
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

   
    public function actionCreate() {
        $data=[];
        $model = new MedicineShopMaster;
        $model->scenario = "create";
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $model->created_at=date('Y-m-d H:i:s'); 
                $model->save(false);
                Yii::$app->session->setFlash('success', 'created successfully');
                return $this->redirect(["index"]);
            }
        }
        return $this->render("create", ["model" => $model]);
    }
    public function actionCreateajax() {
                        if (Yii::$app->request->isAjax) {
                            $resp = [];
                            $resp['flag'] = false;
                            $doctor_id = $_REQUEST['doctor_id'];
                            $time_error=false;
                            $resp['checkbox'] = true;
                            $time_check=$_POST['dayMaster'];
                            foreach($time_check as $k=>$v){
                                foreach ($_POST['start_time'][$v] as $key => $value) {
                                    if($value==''){
                                        $time_error=true;
                                    }
                                }
                                foreach ($_POST['end_time'][$v] as $key => $value) {
                                    if($value==''){
                                        $time_error=true;
                                    }
                                }
                            }
                            if ($time_error){
                                $resp['checkbox'] = false;
                            }
                            $model= new DoctorChamber();
                            $model->scenario = "create";
                            if ($model->load(Yii::$app->request->post())) {
                                $model->doctor_master_id =$doctor_id;
                                $model->status =1;
                                $model->created_at = date("Y-m-d H:i:s");
                                $model->updated_at = date("Y-m-d H:i:s");
                                if ($model->validate() && $time_error==false) {
                                    if($model->save(false)){
                                       foreach($time_check as $k=>$v){
                                foreach ($_POST['start_time'][$v] as $key => $value) {
                                    $chamber_time=new DoctorChamberTime;
                                    $chamber_time->doctor_chamber_id=$model->id;
                                    $chamber_time->day_master_id=$v;
                                    $chamber_time->start_time=$value;
                                    $chamber_time->end_time=$_POST['end_time'][$v][$key];
                                    $chamber_time->status=1;
                                    $chamber_time->created_at=date('Y-m-d H:i:s');
                                    $chamber_time->save(false);
                                }
                            } 
                                    }
                                    $resp['flag'] = true;
                                    $resp['url'] = Url::to(['doctor/chamberindex', 'id' => $doctor_id]);
                                    $resp['msg'] = "Chamber successfully created";
                                } else {
                                    $resp['errors'] = $model->getErrors();
                                }
                            }
                            echo json_encode($resp);
                            exit;
                        }
                        }
    public function actionUpdateajax() {
                        if (Yii::$app->request->isAjax) {
                            $resp = [];
                            $resp['flag'] = false;
                            $chamber_id= $_REQUEST['chamber_id'];
                            $time_error=false;
                            $resp['checkbox'] = true;
                            $time_check=$_POST['dayMaster'];
                            foreach($time_check as $k=>$v){
                                foreach ($_POST['start_time'][$v] as $key => $value) {
                                    if($value==''){
                                        $time_error=true;
                                    }
                                }
                                foreach ($_POST['end_time'][$v] as $key => $value) {
                                    if($value==''){
                                        $time_error=true;
                                    }
                                }
                            }
                            if ($time_error){
                                $resp['checkbox'] = false;
                            }
                            $model= DoctorChamber::findOne($chamber_id);
                            $model->scenario = "update";
                            if ($model->load(Yii::$app->request->post())) {
                                $model->updated_at = date("Y-m-d H:i:s");
                                if ($model->validate() && $time_error==false) {
                                    if($model->save(false)){
                                        $chamber_time= DoctorChamberTime::find()->where(["doctor_chamber_id"=>$chamber_id])->all();
                                        if(count($chamber_time)>0){
                                            foreach ($chamber_time as $key => $value) {
                                              $times= DoctorChamberTime::findOne($value->id);  
                                              $times->delete();
                                            }
                                        }
                                        
                                       foreach($time_check as $k=>$v){
                                foreach ($_POST['start_time'][$v] as $key => $value) {
                                    $chamber_time=new DoctorChamberTime;
                                    $chamber_time->doctor_chamber_id=$model->id;
                                    $chamber_time->day_master_id=$v;
                                    $chamber_time->start_time=$value;
                                    $chamber_time->end_time=$_POST['end_time'][$v][$key];
                                    $chamber_time->status=1;
                                    $chamber_time->updated_at=date('Y-m-d H:i:s');
                                    $chamber_time->save(false);
                                }
                            } 
                                    }
                                    $resp['flag'] = true;
                                    $resp['url'] = Url::to(['doctor/chamberindex', 'id' => $model->doctor_master_id]);
                                    $resp['msg'] = "Chamber successfully updated";
                                } else {
                                    $resp['errors'] = $model->getErrors();
                                }
                            }
                            echo json_encode($resp);
                            exit;
                        }
                        }
    public function actionUpdate($id) {
        $data=[];
         $model = DoctorChamber::findOne($id);
        $doctor_chamber_time= DoctorChamberTime::find()->where("doctor_chamber_id=:doctor_chamber_id AND status<>:status",[":doctor_chamber_id"=>$id,":status"=>'3'])->all();
        $data['model']=$model;
        $data['doctor_chamber_time']=$doctor_chamber_time;
        $model->scenario = 'update_doctor_chamber';
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->updated_at=date('Y-m-d H:i:s'); 
                $model->save(false);
            Yii::$app->session->setFlash('success', 'updated successfully!');
            return $this->refresh();
        }
        $data['model'] = $model;
        $data['doctor_chamber_time']=$doctor_chamber_time;
        return $this->render('update_chamber', ["data" => $data]);
    }
    public function actionDelete() {
        $chamber_id= $_REQUEST['id'];
        $chamber= DoctorChamber::findOne($chamber_id);
        $chamber->status = 3;
        $chamber->save(false);
        Yii::$app->session->setFlash('success', ' deleted.');
//                        return $this->redirect(['index']);
        return $this->redirect(["index"]);
    }
    public function actionView($id) {
        return $this->render('view', ['model' => $this->findModel($id),
        ]);
    }
    
    
     public function actionGetstates() {
        $type_id=$_REQUEST['id'];
        $doc_specialities= \app\models\States::find()->where("country_id=:country_id",[":country_id"=>$type_id])->all();
        $html="";
        if(count($doc_specialities)>0){
        foreach ($doc_specialities as $key => $value) {
            $html.='<option value="'.$value->id.'">'.$value->name.'</option>';
        }
        }else{
           $html.='<option value="">No Data</option>';  
        }
        return $html;
    }
    public function actionGetcities() {
        $type_id=$_REQUEST['id'];
        $doc_specialities= \app\models\Cities::find()->where("state_id=:state_id",[":state_id"=>$type_id])->all();
        $html="";
        if(count($doc_specialities)>0){
        foreach ($doc_specialities as $key => $value) {
            $html.='<option value="'.$value->id.'">'.$value->name.'</option>';
        }
        }else{
           $html.='<option value="">No Data</option>';  
        }
        return $html;
    }
    protected function findModel($id) {
        if (($model = DoctorSpecialities::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
