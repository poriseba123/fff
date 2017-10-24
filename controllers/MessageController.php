<?php

namespace app\controllers;

use Yii;
use yii\web\UploadedFile;
use app\models\UserMaster;
use app\models\IdentityDocument;
use yii\filters\VerbFilter;
use app\models\PasswordModel;
use yii\filters\AccessControl;
use app\components\FrontendController;
use app\models\RatingMaster;
use app\models\BookingMaster;
use app\models\TripMaster;
use app\models\MessageMaster;
use app\models\MessageReportPoint;
use app\models\MessageReport;

class MessageController extends FrontendController {

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

    public function actionIndex() {
        $to_id = Yii::$app->user->id;
        $model = MessageMaster::find()->where(['to_id' => $to_id, 'status' => 1])->groupBy('from_id')->orderBy('created_at desc')->all();
        return $this->render('index', ['model' => $model]);
    }

    public function actionAllmessages($id = '') {
        $to_id = Yii::$app->user->id;
        $from_id = $id;
        $message_to = $id;
        $model = MessageMaster::find()->where("to_id = '$to_id' AND from_id = '$from_id'")->orWhere("to_id = '$from_id' AND from_id = '$to_id'")->andWhere(['status' => 1])->orderBy('created_at desc')->all();
        return $this->render('all_messages', ['model' => $model, 'message_to' => $message_to]);
    }

    public function actionSubmitmessage() {
        if (Yii::$app->request->isAjax) {
            $resp = [];
            $resp['flag'] = false;
            $from_id = Yii::$app->user->id;
            $to_id = $_POST['to_id'];
            $message = $_POST['message'];
            $mm = new MessageMaster;
            $mm->from_id = $from_id;
            $mm->to_id = $to_id;
            $mm->message = $message;
            $mm->status = 1;
            $mm->created_at = date('Y-m-d H:i:s');
            $mm->updated_at = date('Y-m-d H:i:s');
            $mm->save(false);
            $resp['flag'] = true;
            $resp['msg'] = 'Mensaje enviado con éxito';

            echo json_encode($resp);
            exit;
        }
    }
    public function actionReportmessagestep1() {
        if (Yii::$app->request->isAjax) {
            $resp = [];
            $resp['flag'] = false;
            $msg_id=$_POST['msg_id'];
            $main_reason=$_POST['main_reason'];
            $sub_reason=$_POST['sub_reason'];
            $msg=$_POST['msg'];
            $user_id= Yii::$app->user->id;
            $model=new \app\models\MessageReport;
            $model->message_id=$msg_id;
            $model->user_id=$user_id;
            $model->step1=$main_reason;
            $model->step2=$sub_reason;
            $model->step3='';
            $model->step4='';
            $model->message=$msg;
            $model->created_at=date('Y-m-d H:i:s');
            $model->updated_at=date('Y-m-d H:i:s');
            $model->save(false);
            $resp['flag'] = true;
            $resp['msg'] = 'informe enviado con éxito';
            echo json_encode($resp);
            exit;
        }
    }
    public function actionReportmessagestep13333333333() {
        if (Yii::$app->request->isAjax) {
//            echo "<pre>";
//            print_r($_POST);
//            exit;
            $resp = [];
            $resp['flag'] = false;
            $msg_id=$_POST['msg_id'];
            $user_id= Yii::$app->user->id;
            $step1=$_POST['step1'];
            $step2=$_POST['step2'];
            $step3=$_POST['step3'];
            $step4=$_POST['step4'];
            $msg=$_POST['msg'];
            $model=new \app\models\MessageReport;
            $model->message_id=$msg_id;
            $model->user_id=$user_id;
            $model->step1=$step1;
            $model->step2=$step2;
            $model->step3=$step3;
            $model->step4=$step4;
            $model->message=$msg;
            $model->created_at=date('Y-m-d H:i:s');
            $model->updated_at=date('Y-m-d H:i:s');
            $model->save(false);
            $resp['flag'] = true;
            $resp['msg'] = 'informe enviado con éxito';
            echo json_encode($resp);
            exit;
        }
    }

}
