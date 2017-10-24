<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "trip_master".
 *
 * @property string $id
 * @property string $trackId
 * @property string $user_id
 * @property string $title
 * @property string $start_time
 * @property string $starting_location
 * @property string $end_location
 * @property double $total_distance
 * @property integer $increase_parcent
 * @property double $total_cost
 * @property string $total_seat
 * @property string $seat_available
 * @property integer $booking_status
 * @property integer $status
 * @property string $added_date
 * @property string $updated_date
 */
class TripMaster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'trip_master';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'increase_parcent', 'total_seat', 'seat_available', 'booking_status', 'status'], 'integer'],
            [['start_time', 'added_date', 'updated_date'], 'safe'],
            [['total_distance', 'total_cost'], 'number'],
            [['added_date', 'updated_date'], 'required'],
            [['trackId'], 'string', 'max' => 50],
            [['title', 'starting_location', 'end_location'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'trackId' => 'Track ID',
            'user_id' => 'User ID',
            'title' => 'Title',
            'start_time' => 'Start Time',
            'starting_location' => 'Starting Location',
            'end_location' => 'End Location',
            'total_distance' => 'Total Distance',
            'increase_parcent' => 'Increase Parcent',
            'total_cost' => 'Total Cost',
            'total_seat' => 'Total Seat',
            'seat_available' => 'Seat Available',
            'booking_status' => 'Booking Status',
            'status' => 'Status',
            'added_date' => 'Added Date',
            'updated_date' => 'Updated Date',
        ];
    }
    public function getUserDetails() {
        return $this->hasOne(UserMaster::className(), ['id' => 'user_id']);
    }
}
