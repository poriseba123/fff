<?php

namespace app\models;

use Yii;
use app\models\TripLocation;
use app\models\TripMaster;

/**
 * This is the model class for table "booking_master".
 *
 * @property string $id
 * @property string $trackId
 * @property string $user_id
 * @property string $trip_id
 * @property integer $booking_type
 * @property string $request_time
 * @property integer $booking_status
 * @property string $booking_location_start_id
 * @property string $booking_location_end_id
 * @property double $total_distance
 * @property double $total_price
 * @property integer $payment_status
 * @property integer $status
 * @property string $added_date
 * @property string $updated_date
 */
class BookingMaster extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'booking_master';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['user_id', 'trip_id', 'booking_type', 'booking_status', 'booking_location_start_id', 'booking_location_end_id'], 'integer'],
            [['request_time', 'booking_status', 'added_date', 'updated_date'], 'required'],
            [['request_time', 'added_date', 'updated_date'], 'safe'],
            [['total_distance', 'total_price'], 'number'],
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
            'trip_id' => Yii::t('app', 'Trip ID'),
            'booking_type' => Yii::t('app', 'Booking Type'),
            'request_time' => Yii::t('app', 'Request Time'),
            'booking_status' => Yii::t('app', 'Booking Status'),
            'booking_location_start_id' => Yii::t('app', 'Booking Location Start ID'),
            'booking_location_end_id' => Yii::t('app', 'Booking Location End ID'),
            'total_distance' => Yii::t('app', 'Total Distance'),
            'total_price' => Yii::t('app', 'Total Price'),
            'added_date' => Yii::t('app', 'Added Date'),
            'updated_date' => Yii::t('app', 'Updated Date'),
        ];
    }

    public function getTripMasterDetails() {
        return $this->hasOne(TripMaster::className(), ['id' => 'trip_id']);
    }

    public function getUserDetails() {
        return $this->hasOne(UserMaster::className(), ['id' => 'user_id']);
    }

    public function getUserDetailsTripLocationStart() {
        return $this->hasOne(TripLocation::className(), ['id' => 'booking_location_start_id']);
    }

    public function getUserDetailsTripLocationEnd() {
        return $this->hasOne(TripLocation::className(), ['id' => 'booking_location_end_id']);
    }

    public function getTripLocationEnd() {
        return $this->hasOne(TripLocation::className(), ['id' => 'booking_location_end_id'])->onCondition('trip_location.arrival_datetime >= :arrival_datetime', [':arrival_datetime' => date('Y-m-d H:i:s')]);
    }

}
