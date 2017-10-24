<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class SocialLoginForm extends Model {

    public $googleId;
    public $fbId;
    public $loginType;
    public $rememberMe = true;
    private $_user = false;

    /**
     * @return array the validation rules.
     */
    public function rules() {
        return [
            // username and password are both required
            [['googleId', 'loginType'], 'required', 'on' => 'google-login'],
            [['fbId', 'loginType'], 'required', 'on' => 'facebook-login'],
                // rememberMe must be a boolean value
                // password is validated by validatePassword()
        ];
    }

    public function login() {

        if ($this->validate()) {
            if ($this->getFBUser() != null || $this->getGoogleUser() != null) {
                if ($this->loginType == 3) { // google login
                    return Yii::$app->user->login($this->getGoogleUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
                } else {  // facebook login
                    return Yii::$app->user->login($this->getFBUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
                }
            }else{
                return false;
            }
        }
        return false;
    }

    public function getGoogleUser() {
        if ($this->_user === false) {
            $this->_user = UserMaster::findByGoogleId($this->googleId);
        }
        return $this->_user;
    }

    public function getFBUser() {
        if ($this->_user === false) {
            $this->_user = UserMaster::findByFBId($this->fbId);
        }
        return $this->_user;
    }

}
