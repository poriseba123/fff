<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_vehicle".
 *
 * @property string $id
 * @property string $trackId
 * @property string $user_id
 * @property string $car_brand
 * @property string $car_model
 * @property string $color
 * @property string $plate_number
 * @property integer $status
 * @property string $cancelation_cause
 * @property string $added_date
 * @property string $updated_date
 */
class UserVehicle extends \yii\db\ActiveRecord {

    public $vehicleImg;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'user_vehicle';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['trackId', 'user_id', 'car_brand', 'car_model', 'color', 'plate_number', 'car_img', 'status', 'added_date', 'updated_date'], 'required', 'on' => ['add_vchicle']],
            [['trackId', 'user_id', 'car_brand', 'car_model', 'color', 'plate_number', 'car_img', 'updated_date'], 'required', 'on' => ['update_vchicle']],
            [['trackId', 'user_id', 'car_brand', 'car_model', 'color', 'plate_number', 'car_img', "vehicleImg", 'status', 'added_date', 'updated_date'], 'safe', 'on' => ['add_vchicle']],
            [['vehicleImg'], 'file', 'extensions' => 'png, jpg, jpeg, gif', 'maxSize' => 1024 * 1024 * 2, 'on' => ['add_vchicle', 'update_vchicle']],
            [['user_id', 'car_brand', 'car_model', 'color', 'status'], 'integer'],
            [['cancelation_cause'], 'string'],
            [['added_date', 'updated_date'], 'safe'],
            [['plate_number'], 'string', 'min' => 6, 'max' => 6],
            [['trackId'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'trackId' => Yii::t('app', 'Track ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'car_brand' => Yii::t('app', 'Vehicle Brand'),
            'car_model' => Yii::t('app', 'Vehicle Model'),
            'color' => Yii::t('app', 'Color'),
            'plate_number' => Yii::t('app', 'Plate Number'),
            'car_img' => Yii::t('app', 'Vehicle Image'),
            'status' => Yii::t('app', 'Status'),
            'cancelation_cause' => Yii::t('app', 'Cancelation Cause'),
            'added_date' => Yii::t('app', 'Added Date'),
            'updated_date' => Yii::t('app', 'Updated Date'),
        ];
    }

    public function getUserDetails() {
        return $this->hasOne(UserMaster::className(), ['id' => 'user_id']);
    }

    public function getVBrand() {
        return $this->hasOne(VehicleBrand::className(), ['id' => 'car_brand']);
    }

    public function getVModel() {
        return $this->hasOne(VehicleModel::className(), ['id' => 'car_model']);
    }

    public function getVColor() {
        return $this->hasOne(VehicleColor::className(), ['id' => 'color']);
    }

}
