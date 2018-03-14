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
//use app\models\Homepagesliderlogo;
use app\models\Homepagesliderlogo;
use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;
use Imagine\Image\BoxInterface;

class HomepagelogosliderController extends AdminController {

    public function actionIndex() {
        $data = [];
        $model = Homepagesliderlogo::findOne('1');
        $model->scenario = 'update';
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            //$model->save(false);
            Yii::$app->session->setFlash('success', 'updated successfully!');
            return $this->refresh();
        }
        return $this->render('index', ["model" => $model]);
    }

    public function actionUpdateajax() {
        if (Yii::$app->request->isAjax) {
            $img_id = '1';
            $resp = [];
            $imgError = 0;
            $resp['imgErr'] = false;
            $model = Homepagesliderlogo::findOne($img_id);
            $old_value = $model->getOldAttributes();
            $model->scenario = "update";
            if ($model->load(Yii::$app->request->post())) {
                $img['slider_image1'] = UploadedFile::getInstance($model, 'slider_image1');
                $img['slider_image2'] = UploadedFile::getInstance($model, 'slider_image2');
                $img['slider_image3'] = UploadedFile::getInstance($model, 'slider_image3');
                $img['slider_image4'] = UploadedFile::getInstance($model, 'slider_image4');
                $img['logo_image'] = UploadedFile::getInstance($model, 'logo_image');
                //$img[] = UploadedFile::getInstance($model, 'logo_image');
                if (!empty($img)) {
                    foreach ($img as $key => $value) {
                        //print_r($key);
                        //die();
                        if (!empty($value)) {
                            if (isset($value) && $value->error == 0) {
                                $allow = ['jpg', 'png', 'jpeg'];
                                $ext = explode('.', $value->name);
                                if (!in_array(end($ext), $allow)) {
                                    $resp['imgErr'] = true;
                                    $resp['msg'] = "Invalid Image. Please upload jpg,jpeg and png image.";
                                    $imgError = 1;
                                } else {
                                    $imgName = date('Ymd') . '_' . time() . '_' . $value->name;
                                    $path = Yii::$app->basePath . '/uploads/logoslider/original/' . $imgName;
                                    $value->saveAs($path);
                                    $this->resizeImage('logoslider', $imgName);
                                    $model->$key = $imgName;

                                    //$model->update('Homepagesliderlogo', ['slider_image1' => 'asas'])->execute();
                                }
                            }
                        } else {
                            //print_r($new->getOldAttributes());
                            //die();
                            $model->$key = $old_value[$key];
                        }
                    }
                }


                if ($imgError == 0) {
                    //print_r($model);
                    //die();
                    $model->update(false);
                    $resp['flag'] = true;
                    $resp['url'] = Url::to(['homepagelogoslider/index']);
                    $resp['msg'] = "Successfully updated";
                } else {
                    $resp['errors'] = $model->getErrors();
                }
            }
            echo json_encode($resp);
            exit;
        }
    }

}

?>