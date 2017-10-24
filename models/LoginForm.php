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
class LoginForm extends Model {

    public $email;
    public $password;
    public $rememberMe = false;
    private $_user = false;

    /**
     * @return array the validation rules.
     */
    public function rules() {
        return [
            // username and password are both required
            [['email', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    public function attributeLabels() {
        return [
            'email' => Yii::t('app', 'Email'),
            'password' => Yii::t('app', 'Password'),
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params) {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if ($user && !$user->validatePassword($this->password)) {
                $this->addError($attribute, Yii::t('app', 'Incorrect email or password.'));
            } elseif (!$user) {
                $findUser = UserMaster::find()->where("(email=:email OR google_email=:email OR facebook_email=:email) AND user_type=:user_type AND status!=:status", [':email' => $this->email, ':user_type' => 2, ":status" => 3])->one();
                if (count($findUser) == 1) {
                    if ($findUser->status == 2) {
                        $this->addError($attribute, Yii::t('app', 'Your account is suspended now. Please contact to site administrator.'));
                    } elseif ($findUser->status == 0) {
                        $this->addError($attribute, Yii::t('app', 'We have already send a email verification email. Please firstly verify your email address.'));
                    }
                } else {
                    $this->addError($attribute, Yii::t('app', 'Incorrect email or password.'));
                }
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login() {
        if ($this->validate()) {
            if ($this->getUser() != null) {
                return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
            } else {
                return false;
            }
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser() {
        if ($this->_user === false) {
            $this->_user = UserMaster::validateUser($this->email);
        }
        return $this->_user;
    }

}
