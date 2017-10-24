<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "rating_master".
 *
 * @property string $id
 * @property string $trackId
 * @property string $user_id
 * @property string $driver_id
 * @property string $booking_id
 * @property double $rating
 * @property string $review
 * @property integer $status
 * @property string $added_date
 * @property string $updated_date
 */
class RatingMaster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rating_master';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'driver_id', 'booking_id', 'status'], 'integer'],
            [['rating'], 'number'],
            [['review'], 'string'],
            [['added_date', 'updated_date'], 'required'],
            [['added_date', 'updated_date','trip_id'], 'safe'],
            [['trackId'], 'string', 'max' => 50],
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
            'driver_id' => 'Driver ID',
            'booking_id' => 'Booking ID',
            'rating' => 'Rating',
            'review' => 'Review',
            'status' => 'Status',
            'added_date' => 'Added Date',
            'updated_date' => 'Updated Date',
        ];
    }
    public function getUserDetails() {
        return $this->hasOne(UserMaster::className(), ['id' => 'user_id']);
    }
    public function getDriverDetails() {
        return $this->hasOne(UserMaster::className(), ['id' => 'driver_id']);
    }
     public function getTripMasterDetails() {
        return $this->hasOne(TripMaster::className(), ['id' => 'driver_id']);
    }
     public function getBookingDetails() {
        return $this->hasOne(BookingMaster::className(), ['id' => 'booking_id']);
    }
     public function search($params) {
        $query = RatingMaster::find()->Where("status = 0 OR status = 1");
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => ['defaultOrder' => ['id' => SORT_DESC],
                'attributes' => [
                    'id','status'
                ]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        

        return $dataProvider;
    }
}
