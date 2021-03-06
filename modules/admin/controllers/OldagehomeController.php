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
//use app\models\Oldagehome;
use app\models\Oldagehome;
use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;
use Imagine\Image\BoxInterface;

class OldagehomeController extends AdminController {

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
                'attribute' => 'type',
                'value' => function($data) {
                    if ($data->type == 1) {
                        $status = "Govt";
                    } elseif ($data->type == 3) {
                        $status = "Nonprofit";
                    }
                    return $status;
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(array('0' => array('id' => '1', 'type' => 'Govt'), '1' => array('id' => '3', 'type' => 'Nonprofit')), 'id', 'type'),
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
                            return Url::to(['oldagehome/view', 'id' => $model->id]);
                            break;
                        case "update":
                            return Url::to(['oldagehome/update', 'id' => $model->id]);
                            break;
                        case "delete":
                            return Url::to(['oldagehome/delete', 'id' => $model->id]);
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
        $searchModel = new Oldagehome;
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
        $data = [];
        $model = new Oldagehome;
        $model->scenario = "create";
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $model->created_at = date('Y-m-d H:i:s');
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
            $final_arr = [];
            $imgName = '';
            $imgError = 0;
            $resp['imgErr'] = false;
            $resp['flag'] = false;
            $phone_error = false;
            $resp['phone'] = true;
            $phone_check = $_POST['contact_no'];
            $time_error = false;
            $resp['checkbox'] = true;
            $all_postdata_arr = $_POST['Oldagehome'];
            $facility = $all_postdata_arr['facility'];
            foreach ($phone_check as $k => $v) {
                if ($v == '') {
                    $phone_error = true;
                }
            }
            if ($phone_error) {
                $resp['phone'] = false;
            }
            $model = new Oldagehome();
            $model->scenario = "create";
            if ($model->load(Yii::$app->request->post())) {
                $img = UploadedFile::getInstance($model, 'image');
                if (isset($img) && $img->error == 0) {
                    $allow = ['jpg', 'png', 'jpeg'];
                    $ext = explode('.', $img->name);
                    if (!in_array(end($ext), $allow)) {
                        $resp['imgErr'] = true;
                        $resp['msg'] = "Invalid Image. Please upload jpg,jpeg and png image.";
                        $imgError = 1;
                    } else {
                        $imgName = date('Ymd') . '_' . time() . '_' . $img->name;
                        $path = Yii::$app->basePath . '/uploads/oldagehome/original/' . $imgName;
                        $img->saveAs($path);
                        $this->resizeImage('oldagehome', $imgName);
                        $model->image = $imgName;
                    }
                }
                //$model->status =1;
                $model->created_at = date("Y-m-d H:i:s");
                if ($model->validate() && $phone_error == false && $imgError == 0) {
                    $model->contact_no = implode(',', $_POST['contact_no']);
                    $model->save(false);
                    $resp['flag'] = true;
                    $resp['url'] = Url::to(['oldagehome/index']);
                    $resp['msg'] = "Old age home successfully created";
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
            $final_arr = [];
            $oldage_id = $_POST['oldage_id'];
            $resp = [];
            $imgError = 0;
            $resp['imgErr'] = false;
            $resp['flag'] = false;
            $phone_error = false;
            $resp['phone'] = true;
            $phone_check = $_POST['contact_no'];
            $resp['checkbox'] = true;
            $all_postdata_arr = $_POST['Oldagehome'];
            $facility = $all_postdata_arr['facility'];
            foreach ($phone_check as $k => $v) {
                if ($v == '') {
                    $phone_error = true;
                }
            }
            if ($phone_error) {
                $resp['phone'] = false;
            }
            $model = Oldagehome::findOne($oldage_id);
            $model->scenario = "update";
            if ($model->load(Yii::$app->request->post())) {
                $img = UploadedFile::getInstance($model, 'image');
                if (isset($img) && $img->error == 0) {
                    $allow = ['jpg', 'png', 'jpeg'];
                    $ext = explode('.', $img->name);
                    if (!in_array(end($ext), $allow)) {
                        $resp['imgErr'] = true;
                        $resp['msg'] = "Invalid Image. Please upload jpg,jpeg and png image.";
                        $imgError = 1;
                    } else {
                        $imgName = date('Ymd') . '_' . time() . '_' . $img->name;
                        $path = Yii::$app->basePath . '/uploads/oldagehome/original/' . $imgName;
                        $img->saveAs($path);
                        $this->resizeImage('oldagehome', $imgName);
                        $model->image = $imgName;
                    }
                }
                $model->updated_at = date("Y-m-d H:i:s");
                if ($model->validate() && $phone_error == false && $imgError == 0) {
                    $model->contact_no = implode(',', $_POST['contact_no']);
                    $model->save(false);
                    $resp['flag'] = true;
                    $resp['url'] = Url::to(['oldagehome/index']);
                    $resp['msg'] = "Old age home successfully updated";
                } else {
                    $resp['errors'] = $model->getErrors();
                }
            }
            echo json_encode($resp);
            exit;
        }
    }

    public function actionUpdate($id) {
        $data = [];
        $model = Oldagehome::findOne($id);
        $model->scenario = 'update';
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->updated_at = date('Y-m-d H:i:s');
            $model->save(false);
            Yii::$app->session->setFlash('success', 'updated successfully!');
            return $this->refresh();
        }
        return $this->render('update', ["model" => $model]);
    }

    public function actionDelete($id) {
        $chamber = Oldagehome::findOne($id);
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

    protected function findModel($id) {
        if (($model = Oldagehome::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}

?>