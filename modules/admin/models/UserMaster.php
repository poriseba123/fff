<?php

namespace app\modules\admin\models;

use Yii;
use yii\data\ActiveDataProvider;
use app\models\UserVehicle;

class UserMaster extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface {

    public $old_password;
    public $new_password;
    public $retype_password;
    public $cnf_email;
    public $cnf_password;
    public $term_condition;
    public $recaptcha;
    public $newImage;

    const FORONTENT_ACTIVE_STATUS = 1;
    const FORONTENT_INACTIVE_STATUS = 0;
    const FORONTENT_SUSPEND_STATUS = 0;
    const FRONTEND_USER_TYPE = 2;

    public static function tableName() {
        return 'user_master';
    }

    public function rules() {
        return [
//            ================ update user profile ==================
            [['first_name', 'last_name', 'email','phone_code', 'phone', 'update_date', 'status'], 'required', 'on' => ['admin_update_user']],
//            ================ end update user profile ==================
//            ================= admin profile update ======================
            [['first_name', 'last_name', 'email', 'phone'], 'required', 'on' => ['admin-update-profile']],
            [['first_name', 'last_name', 'email', 'phone', 'image'], 'required', 'on' => ['admin-update-profile-img']],
//            ================= end admin profile update ======================
//            ================= admin forget password update ======================
            [['new_password', 'retype_password'], 'required', 'on' => ['admin-reset-password']],
            ['retype_password', 'compare', 'compareAttribute' => 'new_password', 'on' => 'admin-reset-password'],
//            ================= end admin forget password update ======================
//            ================= validation rules ======================
            [['phone'], 'match', 'pattern' => '/^[0-9]+$/', 'message' => 'Phone number is invalid'],
//            [['phone'], 'match', 'pattern' => '/^[0-9]{10}+$/', 'message' => 'Phone number is invalid'],
//            [['phone'], 'match', 'pattern' => '/^[0-9+.()-]*$/', 'message' => 'Phone number is invalid'],
            [['phone'], 'string', 'min' => 10, 'max' => 50],
            ['email', 'email', 'on' => ['admin-update-profile, admin-update-profile-img']],
            ['email', 'checkMailIdUpdate', 'on' => ['admin-update-profile, admin-update-profile-img']],
            [['first_name', 'last_name', 'email', 'phone', 'newImage'], 'safe', 'on' => ['admin-update-profile, admin-update-profile-img']],
            [['newImage'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg', 'message' => 'Please choose png, jpg and jpeg Images.', 'on' => 'admin-update-profile-img']
//            ================= end validation rule ======================
        ];
    }

    public function checkMailId($attribute, $params) {
        if (!$this->hasErrors()) {
            $findEmail = self::find()
                    ->where('email =:email AND status !=:status', array(':email' => $this->email, ':status' => 3))
                    ->one();
            if (count($findEmail) > 0) {
                $this->addError($attribute, 'Incorrect username or password.');
                $this->addError($attribute, $attribute . ' address "' . $this->email . '" has already been taken.');
            }
        }
    }

    public function checkMailIdUpdate($attribute, $params) {
        if (!$this->hasErrors()) {
            $findEmail = self::find()
                    ->where('id !=:id AND email =:email AND status !=:status', array(':id' => Yii::$app->user->id, ':email' => $this->email, ':status' => 3))
                    ->one();
            if (count($findEmail) > 0) {
                $this->addError($attribute, $attribute . ' address "' . $this->email . '" has already been taken.');
            }
        }
    }

    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_type' => Yii::t('app', 'User Type'),
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'email' => Yii::t('app', 'Email Id'),
            'facebook_email' => Yii::t('app', 'Facebook Email Id'),
            'password' => Yii::t('app', 'Password'),
            'phone' => Yii::t('app', 'Contact No.'),
            'country' => Yii::t('app', 'Country'),
            'state' => Yii::t('app', 'State'),
            'zip' => Yii::t('app', 'Zip'),
            'image' => Yii::t('app', 'Image'),
            'active_token' => Yii::t('app', 'Active Token'),
            'reset_password_token' => Yii::t('app', 'Reset Password Token'),
            'status' => Yii::t('app', 'Status'),
            'added_date' => Yii::t('app', 'Registration Date'),
            'update_date' => Yii::t('app', 'Update Date'),
        ];
    }

    public static function findIdentity($id) {
        return self::findOne($id);
    }

    public static function adminFindByEmail($email) {
        return self::findOne(['email' => $email, 'user_type' => 1, 'status' => 1]);
    }

    public static function findByUsername($username) {
        return self::findOne(['email' => $username, 'user_type' => self::FRONTEND_USER_TYPE]);
    }

    public static function validateUser($username) {
        return self::findOne(['email' => $username, 'user_type' => self::FRONTEND_USER_TYPE, 'status' => self::FORONTENT_ACTIVE_STATUS]);
    }

    public static function findByGoogleId($gId) {
        return self::findOne(['g_id' => $gId, 'user_type' => self::FRONTEND_USER_TYPE, 'status' => self::FORONTENT_ACTIVE_STATUS]);
    }

    public static function findByFBId($fBId) {
        return self::findOne(['fb_id' => $fBId, 'user_type' => self::FRONTEND_USER_TYPE, 'status' => self::FORONTENT_ACTIVE_STATUS]);
    }

    public static function findByActiveUsername($username) {
        return self::findOne(['email' => $username, 'user_type' => self::FRONTEND_USER_TYPE, 'status' => self::FORONTENT_ACTIVE_STATUS]);
    }

    public static function findForgetPassUser($token) {
        return self::findOne(['reset_password_token' => $token, 'user_type' => self::FRONTEND_USER_TYPE, 'status' => self::FORONTENT_ACTIVE_STATUS]);
    }

    public static function findIdentityByAccessToken($token, $type = null) {
        throw new \yii\base\NotSupportedException();
    }

    public function getId() {
        return $this->id;
    }

    public function getAuthKey() {
        if (isset($this->auth_key)) {
            return $this->auth_key;
        } else {
            return null;
        }
    }

    public function validateAuthKey($authKey) {
        return $this->auth_key === $authKey;
    }

    public function validatePassword($password) {
        return Yii::$app->getSecurity()->ValidatePassword($password, $this->password);
    }

    public function frontendvalidatePassword($password) {
        return Yii::$app->getSecurity()->frontendValidatePassword($password, $this->password);
    }

    public function findPasswords($attribute, $params) {
        $user = UserMaster::find()->where(['id' => Yii::$app->user->id])->one();
        $password = $user->password;
        if (Yii::$app->getSecurity()->validatePassword($this->old_password, $password) != 1)
            $this->addError($attribute, 'Old Password is incorrect.');
    }

    public function checkEmail($attribute, $params) {
        if (isset($this->email) && $this->email != '') {
            $email = strtolower($this->email);
            $check = self::find()
                    ->where("email = '$email' and status <> '3'")
                    ->one();
            if (count($check) > 0) {
                $this->addError('email', 'This Email is already in use.');
            }
        }
    }

    public function checkMail($attribute, $params) {
        if (isset($this->email) && $this->email != '') {
            $email = strtolower($this->email);
            $check = self::find()
                    ->where("email = '$email' and id <> '" . Yii::$app->user->id . "' and status <> '3'")
                    ->one();
            if (count($check) > 0) {
                $this->addError('email', 'This Email is not available.');
            }
        }
    }

    public function checkCurrentPass($attribute, $params) {
        if (isset($this->old_password) && $this->old_password != '') {
            $check = self::find()
                    ->where("password = '" . md5($this->old_password) . "' and id = '" . Yii::$app->user->id . "' and status <> '3'")
                    ->one();
            if (count($check) == 0) {
                $this->addError($attribute, 'Current password does not match.');
            }
        }
    }
    
    public function getVehicle() {
        return $this->hasOne(UserVehicle::className(), ['user_id' => 'id']);
    }
    
    public function getUserIdentity() {
        return $this->hasOne(\app\models\IdentityDocument::className(), ["user_id" => "id"])
                        ->orderBy('id desc');
    }

}
