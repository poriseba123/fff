<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\UploadedFile;
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
use app\models\Cities;

use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;
use Imagine\Image\BoxInterface;

class CityController extends AdminController {

					
    public function column() {
		
        $viewMsg = 'View';
        $updateMsg = 'Update';
		$rowsall=[];
		$district_list = \app\models\Districts::find()->select('name, id')->where('status <> \'3\'')->all();
					 foreach($district_list as $model){
					  $rowsall[] = array_filter($model->attributes);
				   }
				   
        $gridColumns = [
            ['class' => 'kartik\grid\SerialColumn'],
            [
                'class' => '\kartik\grid\DataColumn',
                'label' => 'Name',
                'attribute' => 'name',
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'label' => 'District',
                'attribute' => 'district_id',
				'value' => function($data){
					 $country_list = \app\models\Districts::find()->select('name, id')->where(["id" => $data->district_id])->all();
					 foreach($country_list as $model){
					  $rows[] = array_filter($model->attributes);
				   }
					 $listData = ArrayHelper::map($rows, 'id', 'name');
					
					 return $listData[$data->district_id];
				},
				'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map($rowsall, 'id', 'name'),
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
                            return Url::to(['city/view', 'id' => $model->id]);
                            break;
                        case "update":
                            return Url::to(['city/update', 'id' => $model->id]);
                            break;
                        case "delete":
                            return Url::to(['city/delete', 'id' => $model->id]);
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
        $searchModel = new Cities;
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
        $model = new Cities;
        $model->scenario = "create";
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                
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
							$model= new Cities();
                            $model->scenario = "create";
                            if ($model->load(Yii::$app->request->post())) {
								if ($model->validate()) {
                                    $model->save(false);
                                    $resp['flag'] = true;
                                    $resp['url'] = Url::to(['city/index']);
                                    $resp['msg'] = "City successfully created";
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
                            $city_id=$_POST['city_id'];
                            $resp = [];
							$resp['flag'] = false;
							$model= Cities::findOne($city_id);
                            $model->scenario = "update";
                            if ($model->load(Yii::$app->request->post())) {
								if ($model->validate()) {
                                    $model->save(false);
                                    $resp['flag'] = true;
                                    $resp['url'] = Url::to(['city/index']);
                                    $resp['msg'] = "City successfully updated";
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
         $model = Cities::findOne($id);
        $model->scenario = 'update';
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save(false);
            Yii::$app->session->setFlash('success', 'updated successfully!');
            return $this->refresh();
        }
        return $this->render('update', ["model" => $model]);
    }
    public function actionDelete($id) {
        $chamber= Cities::findOne($id);
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

    protected function findModel($id) {
        if (($model = Cities::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
