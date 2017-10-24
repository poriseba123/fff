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
use app\models\BankDetails;

class MoneyController extends FrontendController {

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
        $user_id = Yii::$app->user->id;
        $model = BankDetails::find()->where(['user_id' => $user_id,'status'=>1])->one();
        return $this->render('index', ['model' => $model]);
    }

    public function actionCreatebankdetails() {
        if (Yii::$app->request->isAjax) {
            $resp = [];
            $resp['flag'] = false;
            $user_id = Yii::$app->user->id;
            $id=$_POST['bank_details_id'];
            if($id!=''){
              $bd= BankDetails::find()->where(['user_id' => $user_id,'id'=>$id])->one();
              if(count($bd)>0){
                $bd->owner_name = $_POST['owner_name'];
                $bd->banknote_number = $_POST['banknote_number'];
                $bd->bank_name = $_POST['bank_name'];
                $bd->account_number = $_POST['account_number'];
                $bd->account_type = $_POST['account_type'];
                $bd->status = 1;
                $bd->is_verify = 0;
                $bd->updated_at = date('Y-m-d H:i:s');
                $bd->save(false);
                $resp['flag'] = true;
                $resp['msg'] = 'Informe enviado con éxito. Revisaremos tu información. ¡Gracias por ayudarnos a manterner una comunidad confiable!';   
              }else{
                 $resp['flag'] = false; 
                 $resp['msg'] = 'Algo salió mal'; 
              }
              
            }else{
              $bd= BankDetails::find()->where(['user_id' => $user_id])->one(); 
              if(count($bd)>0){
                 $resp['flag'] = false; 
                 $resp['msg'] = 'Informe enviado con éxito. Revisaremos tu información. ¡Gracias por ayudarnos a manterner una comunidad confiable!';  
              }else{
            $bd = new BankDetails;
            $bd->user_id = $user_id;
            $bd->owner_name = $_POST['owner_name'];
            $bd->banknote_number = $_POST['banknote_number'];
            $bd->bank_name = $_POST['bank_name'];
            $bd->account_number = $_POST['account_number'];
            $bd->account_type = $_POST['account_type'];
            $bd->status = 1;
            $bd->is_verify = 0;
            $bd->created_at = date('Y-m-d H:i:s');
            $bd->updated_at = date('Y-m-d H:i:s');
            $bd->save(false);
            $resp['flag'] = true;
            $resp['msg'] = 'Informe enviado con éxito. Revisaremos tu información. ¡Gracias por ayudarnos a manterner una comunidad confiable!';
              }
            }

            echo json_encode($resp);
            exit;
        }
    }
    

}
