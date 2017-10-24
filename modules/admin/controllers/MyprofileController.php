<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;
use app\modules\admin\models\UserMaster;
use app\modules\admin\models\PasswordModel;
use app\modules\admin\components\AdminController;

class MyprofileController extends AdminController {

    public function actionIndex() {
        $this->view->title = $this->getProjectName().": Update Profile";
        
        $model = UserMaster::findOne(Yii::$app->user->id);
        $password = new PasswordModel;
        $model->scenario = "admin-update-profile";
        $password->scenario = "admin-change-pass";
        if (Yii::$app->request->isAjax) {
            $imgName = '';
            $resp = [];
            $imgError = 0;
            $resp['flag'] = false;
            $resp['imgErr'] = false;
            if ($model->load(Yii::$app->request->post())) {
                $img = UploadedFile::getInstance($model, 'newImage');
                if (isset($img) && $img->error == 0) {
                    $allow = ['jpg', 'png'];
                    $ext = explode('.', $img->name);
                    if (!in_array(end($ext), $allow)) {
                        $resp['imgErr'] = true;
                        $resp['msg'] = "Invalid Image. Please upload jpg and png image.";
                        $imgError = 1;
                    } else {
                        $model->scenario = "admin-update-profile-img";
                        $imgName = date('Ymd') . '_' . time() . '_' . $img->name;
                        $path = Yii::$app->basePath . '/uploads/profile_pictures/' . $imgName;
                        $img->saveAs($path);
                    }
                } else {
                    $model->scenario = "admin-update-profile";
                }
                if ($imgError == 0) {
                    if ($imgName != '') {
                        $model->image = $imgName;
                    }
                    if ($model->validate()) {
                        if ($model->save()) {
                            $resp['flag'] = true;
                            Yii::$app->session->setFlash('pro-success-msg', 'Profile Successfully Updated.');
                        } else {
                            $resp['error'] = $model->getErrors();
                        }
                    } else {
                        $resp['error'] = $model->getErrors();
                    }
                }
            }

            if ($password->load(Yii::$app->request->post())) {
                if ($password->validate()) {
                    $model->password = Yii::$app->security->generatePasswordHash($password->new_password);
                    $model->save(false);
                    $resp['flag'] = true;
                    $resp['msg'] = "Your password has been changed.";
                } else {
                    $resp['error'] = $password->getErrors();
                }
            }
            echo json_encode($resp);
            exit;
        }
        $data['model'] = $model;
        $data['password'] = $password;
        return $this->render('index', $data);
    }

}
