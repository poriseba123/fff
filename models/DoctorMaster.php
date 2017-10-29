<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "doctor_master".
 *
 * @property string $id
 * @property int $doctor_type_id doctor_type table id
 * @property int $doctor_specialities_id doctor_specialities table id
 * @property string $first_name
 * @property string $last_name
 * @property string $registration_no
 * @property string $email
 * @property string $mobile_no
 * @property int $email_verified 0=>No,1=>Yes
 * @property string $email_verification_code
 * @property int $mobile_verified 0=>No,1=>Yes
 * @property string $mobile_verification_code
 * @property string $keywords eg. allopathic,surgeon etc
 * @property string $description
 * @property int $gender 0=>Unknown,1=>Male,2=>Female
 * @property int $home_visit 0=>Unknown,1=>Yes,2=>No
 * @property int $approved_by_doctor 0=>No,1=>Yes
 * @property int $status 0=>inactive,1=>active,3=>delete
 * @property string $created_at
 * @property string $updated_at
 */
class DoctorMaster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'doctor_master';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['doctor_type_id', 'doctor_specialities_id', 'created_at', 'updated_at'], 'required'],
            [['first_name','last_name','doctor_type_id', 'doctor_specialities_id','registration_no','email','mobile_no','description','gender','home_visit'], 'required','on'=>'create_doctor'],
            [['doctor_type_id', 'doctor_specialities_id', 'email_verified', 'mobile_verified', 'gender', 'home_visit', 'approved_by_doctor', 'status'], 'integer'],
            [['keywords', 'description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['first_name', 'last_name', 'email'], 'string', 'max' => 255],
            [['registration_no', 'email_verification_code', 'mobile_verification_code'], 'string', 'max' => 30],
            [['mobile_no'], 'string', 'max' => 20],
            [['mobile_no'], 'match', 'pattern' => '/^[0-9]+$/', 'message' => yii::t('app', 'Mobile number is invalid')],
            ['email', 'email'],
            ['email', 'checkEmailCreate', 'on' => ['create_doctor']],
            ['email', 'checkEmailUpdate', 'on' => ['update_doctor']],
            ['registration_no', 'checkRegistrationNoCreate', 'on' => ['create_doctor']],
            ['registration_no', 'checkRegistrationNoUpdate', 'on' => ['update_doctor']],
            
            [['email_verified', 'update_date','gender'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'doctor_type_id' => 'Doctor Type ID',
            'doctor_specialities_id' => 'Doctor Specialities ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'registration_no' => 'Registration No',
            'email' => 'Email',
            'mobile_no' => 'Mobile No',
            'email_verified' => 'Email Verified',
            'email_verification_code' => 'Email Verification Code',
            'mobile_verified' => 'Mobile Verified',
            'mobile_verification_code' => 'Mobile Verification Code',
            'keywords' => 'Keywords',
            'description' => 'Description',
            'gender' => 'Gender',
            'home_visit' => 'Home Visit',
            'approved_by_doctor' => 'Approved By Doctor',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    public function checkEmailCreate($attribute, $params) {
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
    public function checkEmailUpdate($attribute, $params) {
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
    public function checkRegistrationNoCreate($attribute, $params) {
        if (isset($this->registration_no) && $this->registration_no != '') {
            $email = strtolower($this->registration_no);
            $check = self::find()
                    ->where("registration_no = '$email' and status <> '3'")
                    ->one();
            if (count($check) > 0) {
                $this->addError($attribute, Yii::t('app', 'This Registration No is already in use.'));
            }
        }
    }
    public function checkRegistrationNoUpdate($attribute, $params) {
        if (isset($this->registration_no) && $this->registration_no != '') {
            $email = strtolower($this->registration_no);
            $check = self::find()
                    ->where("registration_no = '$email' and id <> '" . Yii::$app->user->id . "' and status <> '3'")
                    ->one();
            if (count($check) > 0) {
                $this->addError($attribute, 'This Registration No is already in use.');
            }
        }
    }
    
     public function search($params) {
        $query = DoctorMaster::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => ['defaultOrder' => ['id' => SORT_DESC],
                'attributes' => [
                    'id',
                    'first_name' => [
                        'asc' => ['first_name' => SORT_ASC],
                        'desc' => ['first_name' => SORT_DESC],
                        'label' => 'first_name',
                        'default' => SORT_DESC
                    ],
                    'registration_no' => [
                        'asc' => ['registration_no' => SORT_ASC],
                        'desc' => ['registration_no' => SORT_DESC],
                        'label' => 'registration_no',
                        'default' => SORT_DESC
                    ],
                    'email' => [
                        'asc' => ['email' => SORT_ASC],
                        'desc' => ['email' => SORT_DESC],
                        'label' => 'email',
                        'default' => SORT_DESC
                    ],
                    'mobile_no' => [
                        'asc' => ['mobile_no' => SORT_ASC],
                        'desc' => ['mobile_no' => SORT_DESC],
                        'label' => 'mobile_no',
                        'default' => SORT_DESC
                    ],
                    'email_verified',
                    'gender',
                    'status'
                ]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'first_name', $this->first_name])
                ->andFilterWhere(['like', 'registration_no', $this->registration_no])
                ->andFilterWhere(['like', 'email', $this->email])
                ->andFilterWhere(['like', 'mobile_no', $this->mobile_no])
                ->andFilterWhere(['like', 'description', $this->description])
                ->andFilterWhere(['like', 'gender', $this->gender])
                ->andFilterWhere(['like', 'status', $this->status])
                ->andWhere('status <> \'3\'');

        return $dataProvider;
    }
}
