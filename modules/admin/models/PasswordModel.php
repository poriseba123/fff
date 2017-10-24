<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use app\modules\admin\models\UserMaster;

class PasswordModel extends Model {

    public $old_password;
    public $new_password;
    public $retype_password;

    public function rules() {
        return [
            [['old_password', 'new_password', 'retype_password'], 'required', 'on' => ['admin-change-pass']],
            ['old_password', 'checkCurrentPass', 'on' => 'admin-change-pass'],
            ['new_password', 'checkNewPass', 'on' => 'admin-change-pass'],
            ['retype_password', 'compare', 'compareAttribute' => 'new_password', 'on' => 'admin-change-pass'],
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
