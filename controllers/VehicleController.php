<?php

namespace app\controllers;

use Yii;
use yii\web\UploadedFile;
use app\models\UserMaster;
use app\models\UserVehicle;
use app\models\VehicleBrand;
use app\models\VehicleModel;
use app\models\VehicleColor;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\components\FrontendController;

class VehicleController extends FrontendController {
    
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                // ...
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionAddvehicle() {
        $userId = Yii::$app->user->id;
        $user = UserMaster::findOne($userId);

        $model = UserVehicle::find()
                ->where("user_id=:userId AND status != :status", [':userId' => $userId, ":status" => 3])
                ->orderBy("id DESC")
                ->one();

        if (Yii::$app->request->isAjax) {
            $resp = [];
            $resp['flag'] = false;
            $resp['imageError'] = false;
            if (count($model) == 0) {
                $model = new UserVehicle;
                $model->scenario = "add_vchicle";
            }else{
                $model->scenario = "update_vchicle";
            }

            $user->scenario = "update_vchicle";

            $model->load(Yii::$app->request->post());
            $user->load(Yii::$app->request->post());
            $model->trackId = $this->getVehicleTrackId();
            $model->cancelation_cause = "";
            $model->status = 0;
            $model->added_date = date("Y-m-d H:i:s");
            $model->updated_date = date("Y-m-d H:i:s");
            $user->update_date = date("Y-m-d H:i:s");
            $user->drive_image_verification = 0;
            $user->driving_cancle_cause = "";
            
//            $user->licence_font_image = UploadedFile::getInstance($user, 'licence_font_image');
//            $user->licence_back_image = UploadedFile::getInstance($user, 'licence_back_image');
//            if (isset($user->licence_font_image)) {
//                $user->drive_frontimage = date("ymdhis") . "_" . $user->licence_font_image->name;
//            }
//            if (isset($user->licence_back_image)) {
//                $user->drive_backimage = date("ymdhis") . "_" . $user->licence_back_image->name;
//            }
            
            $model->vehicleImg = UploadedFile::getInstance($model, 'vehicleImg');
            if (isset($model->vehicleImg)) {
                $model->car_img = date("ymdhis") . "_" . $model->vehicleImg->name;
            }

            $userValidate = $user->validate();
            $vchicleValidate = $model->validate();
            if ($userValidate && $vchicleValidate) {
//                $path = Yii::$app->basePath . '/uploads/driving_licence/';
//                if (isset($user->licence_font_image)) {
//                    $user->licence_font_image->saveAs($path . '/' . $user->drive_frontimage);
//                }
//                if (isset($user->licence_back_image)) {
//                    $user->licence_back_image->saveAs($path . '/' . $user->drive_backimage);
//                }
                
                $path = Yii::$app->basePath . '/uploads/vehicle_pictures/';
                if (isset($model->vehicleImg)) {
                    $model->vehicleImg->saveAs($path . '/' . $model->car_img);
                }
                
                $user->save(false);
                $model->save(false);
                if($model->vehicleImg!=''){
                    $email_setting['body']="El usuario ".$user->first_name." ".$user->last_name." registró su foto de auto. Porfavorverificala.";
                    $email_setting['subject']="Imagen del coche guardada";
                    $email_data = [
                        'to' => 'verificaciones@poriseba.co',
                        'subject' => $email_setting['subject'],
                        'template' => 'forget_pass',
                        'body' => $email_setting['body']
                    ];
                    $this->SendMail($email_data);
                }
                
                $resp['flag'] = true;
                $resp['msg'] = Yii::t('app', 'Your Vehicle request has been sent. Please wait for admin approval.');
            } else {
                $resp['errors'] = $user->getErrors();
                $resp['vehicleErrors'] = $model->getErrors();
            }
            echo json_encode($resp);
            exit;
        }

        $vehicleBrand = VehicleBrand::find()->where('status=:status', [':status' => 1])->all();
        $vehicleColor = VehicleColor::find()->where('status=:status', [':status' => 1])->all();


        $data['user'] = $user;
        $data['findVehicle'] = $model;
        $data['vehicleBrand'] = $vehicleBrand;
        $data['vehicleColor'] = $vehicleColor;
        return $this->render("vehicle_request_form", $data);
    }
    
    public function actionEditvehicle() {
        $userId = Yii::$app->user->id;
        $user = UserMaster::findOne($userId);

        $model = UserVehicle::find()
                ->where("user_id=:userId AND status != :status", [':userId' => $userId, ":status" => 3])
                ->orderBy("id DESC")
                ->one();

        if (Yii::$app->request->isAjax) {
            $resp = [];
            $resp['flag'] = false;
            $resp['imageError'] = false;
            if (count($model) == 0) {
                $model = new UserVehicle;
                $model->scenario = "add_vchicle";
            }else{
                $model->scenario = "update_vchicle";
            }

            $user->scenario = "update_vchicle";

            $model->load(Yii::$app->request->post());
            $user->load(Yii::$app->request->post());
            $model->trackId = $this->getVehicleTrackId();
            $model->cancelation_cause = "";
            $model->status = 0;
            $model->added_date = date("Y-m-d H:i:s");
            $model->updated_date = date("Y-m-d H:i:s");
            $user->update_date = date("Y-m-d H:i:s");
            $user->drive_image_verification = 0;
            $user->driving_cancle_cause = "";
            
            
            $model->vehicleImg = UploadedFile::getInstance($model, 'vehicleImg');
            if (isset($model->vehicleImg)) {
                $model->car_img = date("ymdhis") . "_" . $model->vehicleImg->name;
            }

            $userValidate = $user->validate();
            $vchicleValidate = $model->validate();
            if ($userValidate && $vchicleValidate) {
                
                $path = Yii::$app->basePath . '/uploads/vehicle_pictures/';
                if (isset($model->vehicleImg)) {
                    $model->vehicleImg->saveAs($path . '/' . $model->car_img);
                }
                
                
                $user->save(false);
                $model->save(false);
                $resp['flag'] = true;
                 if($model->vehicleImg!=''){
                    $email_setting['body']="El usuario ".$user->first_name." ".$user->last_name." registró su foto de auto. Porfavorverificala.";
                    $email_setting['subject']="Imagen del coche guardada";
                    $email_data = [
                        'to' => 'verificaciones@poriseba.co',
                        'subject' => $email_setting['subject'],
                        'template' => 'forget_pass',
                        'body' => $email_setting['body']
                    ];
                    $this->SendMail($email_data);
                }
                
                $resp['msg'] = Yii::t('app', 'Your Vehicle request has been sent. Please wait for admin approval.');
                $resp['redirectUrl'] = Yii::$app->urlManager->createUrl("vehicle/addvehicle");
            } else {
                $resp['errors'] = $user->getErrors();
                $resp['vehicleErrors'] = $model->getErrors();
            }
            echo json_encode($resp);
            exit;
        }

        $vehicleBrand = VehicleBrand::find()->where('status=:status', [':status' => 1])->all();
        $vehicleColor = VehicleColor::find()->where('status=:status', [':status' => 1])->all();


        $data['user'] = $user;
        $data['findVehicle'] = $model;
        $data['vehicleBrand'] = $vehicleBrand;
        $data['vehicleColor'] = $vehicleColor;
        return $this->render("edit_vehicle_form", $data);
    }

    public function actionGetvehiclemodellist() {
        if (Yii::$app->request->isAjax) {
            $vBrandId = $_POST['vBrandId'];

            $findModel = VehicleModel::find()->where('brand_id=:brand_id AND status=:status', [':brand_id' => $vBrandId, ':status' => 1])->all();
            $html = "";
            if (count($findModel) > 0) {
                foreach ($findModel as $v => $k) {
                    $html .= '<option value="' . $k->id . '">' . $k->model_no . '</option>';
                }
            }
            echo json_encode($html);
        }
    }

    public function actionGetvehiclecolor() {
        if (Yii::$app->request->isAjax) {
            $vColor = $_POST['vColorId'];

            $findColor = VehicleColor::findOne($vColor);
            echo json_encode($findColor->color_code);
        }
    }

}
