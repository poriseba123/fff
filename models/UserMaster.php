<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "user_master".
 *
 * @property string $id
 * @property integer $user_type
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $password
 * @property string $mobile
 * @property string $image
 * @property string $activation_token
 * @property string $reset_password_token
 * @property integer $status
 * @property string $added_date
 * @property string $update_date
 */
class UserMaster extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface {

    public $old_password;
    public $new_password;
    public $retype_password;
    public $cnf_email;
    public $cnf_password;
    public $term_condition;
    public $recaptcha;
    public $userimage;
    public $licence_font_image;
    public $licence_back_image;

    const FORONTENT_ACTIVE_STATUS = 1;
    const FORONTENT_INACTIVE_STATUS = 0;
    const FORONTENT_SUSPEND_STATUS = 0;
    const FRONTEND_USER_TYPE = 2;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'user_master';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
//            ================= user registration rules =======================
            [['user_type', 'email', 'first_name', 'last_name', 'gender', 'password', 'cnf_password', 'activation_token', 'status', 'added_date', 'update_date'], 'required', 'on' => ['site-registration']],
            ['retype_password', 'compare', 'compareAttribute' => 'password', 'on' => 'site-registration'],
//            =================== user update profile information ================
            [['first_name', 'last_name', 'email', 'gender', 'mobile', 'phone_code', 'birth_year', 'update_date'], 'required', 'on' => ['update_profile_info']],
            [['first_name', 'last_name', 'email', 'gender', 'mobile', 'phone_code', 'email_code', 'email_varified', 'image', 'birth_year', 'bio', 'update_date'], 'safe', 'on' => ['update_profile_info']],
            [['userimage'], 'file', 'extensions' => 'png, jpg, jpeg, gif', 'on' => ['update_profile_info']],
//            ========================== user change forgot password ================
            [['retype_password', 'new_password'], 'required', 'on' => ['change-for-pass']],
            ['retype_password', 'compare', 'compareAttribute' => 'new_password', 'on' => 'change-for-pass'],
//            ========================== user add vehicle request ================
            [['drive_frontimage', 'drive_backimage', 'driving_id', 'drive_image_verification', 'driving_exp'], 'required', 'on' => ['add_vchicle']],
            [['driving_id', 'drive_image_verification', 'driving_exp'], 'required', 'on' => ['update_vchicle']],
            [['drive_frontimage', 'drive_backimage', 'licence_font_image', 'licence_back_image', 'driving_id', 'drive_image_verification', 'driving_exp'], 'safe', 'on' => ['add_vchicle', 'update_vchicle']],
            [['drive_frontimage', 'drive_backimage', 'licence_font_image', 'licence_back_image', 'driving_id', 'drive_image_verification', 'driving_exp'], 'safe', 'on' => ['add_vchicle']],
            [['licence_font_image', 'licence_back_image'], 'file', 'extensions' => 'png, jpg, jpeg, gif', 'maxSize' => 1024 * 1024 * 2, 'on' => ['add_vchicle', 'update_vchicle']],
//            ===========================
            [['mobile'], 'match', 'pattern' => '/^[0-9]+$/', 'message' => yii::t('app', 'Phone number is invalid')],
            [['mobile'], 'string', 'min' => 10, 'max' => 50, 'on' => ["update_profile_info"]],
            [['new_password', 'retype_password', 'password'], 'string', 'min' => 8, 'max' => 50, 'on' => ['site-registration']],
            [['driving_exp'], 'integer', 'min' => 0, 'max' => 50],
            [['new_password', 'retype_password'], 'string', 'min' => 8, 'max' => 50],
//            [['mobile'], 'match', 'pattern' => '/^[0-9+.()-]*$/', 'message' => 'Phone number is invalid'],
            ['retype_password', 'compare', 'compareAttribute' => 'new_password', 'on' => ['change_password']],
            [['retype_password', 'old_password', 'new_password'], 'required', 'on' => ['change_password']],
            ['old_password', 'findPasswords', 'on' => ['change_password']],
            ['email', 'email'],
            [['password', 'new_password'], 'string', 'min' => 6, 'max' => 256, 'message' => '{attribute} should be at least 6 Character.'],
            [['image'], 'file', 'extensions' => 'jpg, png ,gif', 'mimeTypes' => 'image/jpeg, image/gif, image/png',],
            ['email', 'checkRedistrationEmail', 'on' => ['site-registration']],
//            ================= end user registration rules =======================
//            ================= social registration rules =======================
            [['user_type', 'reg_type', 'google_id', 'first_name', 'last_name', 'google_image', 'email', 'status', 'added_date', 'update_date'], 'required', 'on' => ['google-signup']],
            [['user_type', 'reg_type', 'facebook_id', 'first_name', 'last_name', 'facebook_image', 'email', 'status', 'added_date', 'update_date'], 'required', 'on' => ['facebook-signup']],
//            ================= end google registration rules =======================
            [['user_type', 'first_name', 'last_name', 'email', 'password', 'mobile', 'image', 'activation_token', 'reset_password_token', 'status', 'added_date', 'update_date'], 'safe'],
            [['user_type', 'status'], 'integer'],
            [['added_date', 'update_date'], 'safe'],
            [['first_name', 'last_name', 'email', 'password', 'activation_token', 'reset_password_token'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_type' => Yii::t('app', 'User Type'),
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'email' => Yii::t('app', 'Email'),
            'password' => Yii::t('app', 'Password'),
            'mobile' => Yii::t('app', 'Phone'),
            'gender' => Yii::t('app', 'Gender'),
            'image' => Yii::t('app', 'Photo'),
            'bio' => Yii::t('app', 'Short Bio'),
            'birth_year' => Yii::t('app', 'Year of birth'),
            'Password' => Yii::t('app', 'Password'),
            'cnf_password' => Yii::t('app', 'Confirm Password'),
            'activation_token' => Yii::t('app', 'Active Token'),
            'reset_password_token' => Yii::t('app', 'Reset Password Token'),
            'status' => Yii::t('app', 'Status'),
            'added_date' => Yii::t('app', 'Added Date'),
            'update_date' => Yii::t('app', 'Update Date'),
            'drive_frontimage' => Yii::t('app', 'License Font Image'),
            'drive_backimage' => Yii::t('app', 'License Back Image'),
            'licence_font_image' => Yii::t('app', 'License Font Image'),
            'licence_back_image' => Yii::t('app', 'License Back Image'),
            'driving_id' => Yii::t('app', 'Driving Licence Number'),
            'driving_exp' => Yii::t('app', 'Driving Experience'),
        ];
    }

    public static function findIdentity($id) {
        return self::findOne($id);
    }

    public static function adminFindByEmail($email) {
        return self::findOne(['email' => $email, 'user_type' => 1]);
    }

    public static function findByUsername($username) {
//        return self::findOne(['email' => $username, 'user_type' => self::FRONTEND_USER_TYPE]);
        return self::find()->where("(email=:email OR google_email=:email OR facebook_email=:email) AND user_type=:userType", [':email' => $username, ':userType' => self::FRONTEND_USER_TYPE])->one();
    }

    public static function validateUser($username) {
//        return self::findOne(['email' => $username, 'user_type' => self::FRONTEND_USER_TYPE, 'status' => self::FORONTENT_ACTIVE_STATUS]);
        return self::find()->where("(email=:email OR google_email=:email OR facebook_email=:email) AND user_type=:userType AND status=:status", [':email' => $username, ':userType' => self::FRONTEND_USER_TYPE, ':status' => self::FORONTENT_ACTIVE_STATUS])->one();
    }

    public static function findByGoogleId($gId) {
        return self::findOne(['googleId' => $gId, 'user_type' => self::FRONTEND_USER_TYPE, 'status' => self::FORONTENT_ACTIVE_STATUS]);
    }

    public static function findByFBId($fBId) {
        return self::findOne(['facebook_id' => $fBId, 'user_type' => self::FRONTEND_USER_TYPE, 'status' => self::FORONTENT_ACTIVE_STATUS]);
    }

    public static function findByActiveUsername($username) {
        return self::find()->where("(email=:email OR google_email=:email OR facebook_email=:email) AND user_type=:userType AND status=:status", [':email' => $username, ':userType' => self::FRONTEND_USER_TYPE, ':status' => self::FORONTENT_ACTIVE_STATUS])->one();
//        return self::findOne(['email' => $username, 'user_type' => self::FRONTEND_USER_TYPE, 'status' => self::FORONTENT_ACTIVE_STATUS]);
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
        if (isset($this->auth_key)) {
            return $this->auth_key === $authKey;
        } else {
            return null;
        }
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

    public function checkRedistrationEmail($attribute, $params) {
        if (isset($this->email) && $this->email != '') {
            $email = strtolower($this->email);
            $check = self::find()
                    ->where("email = '$email' and status <> '3'")
                    ->one();
            if (count($check) > 0) {
                $this->addError($attribute, Yii::t('app', 'This Email is already in use.'));
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

    public function getPhoneCode() {
        return $this->hasOne(CountryPhonecodes::className(), ['id' => 'phone_code']);
    }
    
    public function getVehicle() {
        return $this->hasOne(UserVehicle::className(), ['user_id' => 'id']);
    }

}
