<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\UserMaster;

class PasswordModel extends Model {

    public $old_password;
    public $new_password;
    public $retype_password;

    public function rules() {
        return [
            [['old_password', 'new_password', 'retype_password'], 'required', 'on' => ['change-pass']],
            ['old_password', 'checkCurrentPass', 'on' => 'change-pass'],
            ['new_password', 'checkNewPass', 'on' => 'change-pass'],
            ['retype_password', 'compare', 'compareAttribute' => 'new_password', 'on' => 'change-pass'],
            [['new_password', 'retype_password'], 'string', 'min' => 8, 'max' => 50],
        ];
    }

    public function attributeLabels() {
        return [
            'old_password' => Yii::t('app', 'Current Password'),
            'new_password' => Yii::t('app', 'New Password'),
            'retype_password' => Yii::t('app', 'Retype Password'),
        ];
    }

    public function checkCurrentPass($attribute, $params) {
        $user = UserMaster::find()->where(['id' => Yii::$app->user->id])->one();
        $password = $user->password;
        if (Yii::$app->getSecurity()->validatePassword($this->old_password, $password) != 1)
            $this->addError($attribute, Yii::t('app', 'Current password is incorrect.'));
    }
    
    public function checkNewPass($attribute, $params) {
        $user = UserMaster::find()->where(['id' => Yii::$app->user->id])->one();
        $password = $user->password;
        if (Yii::$app->getSecurity()->validatePassword($this->new_password, $password) == 1){
            $this->addError($attribute, Yii::t('app', "Current password and New Password can't be same."));
        }
    }

}
