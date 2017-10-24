<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "trip_location".
 *
 * @property string $id
 * @property string $trackId
 * @property string $trip_id
 * @property string $location_a_name
 * @property string $loaction_a_lat
 * @property string $location_a_long
 * @property string $location_b_name
 * @property string $loaction_b_lat
 * @property string $location_b_long
 * @property string $departure_datetime
 * @property string $arrival_datetime
 * @property double $total_distance
 * @property double $total_price
 */
class TripLocation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'trip_location';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['trip_id'], 'integer'],
            [['location_a_lat', 'location_a_long', 'location_b_lat', 'location_b_long'], 'string'],
            [['departure_datetime', 'arrival_datetime'], 'safe'],
            [['total_distance', 'total_price'], 'number'],
            [['trackId'], 'string', 'max' => 50],
            [['location_a_name', 'location_b_name'], 'string', 'max' => 250],
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
            'trip_id' => 'Trip ID',
            'location_a_name' => 'Location A Name',
            'location_a_lat' => 'Location A Lat',
            'location_a_long' => 'Location A Long',
            'location_b_name' => 'Location B Name',
            'location_b_lat' => 'Location B Lat',
            'location_b_long' => 'Location B Long',
            'departure_datetime' => 'Departure Datetime',
            'arrival_datetime' => 'Arrival Datetime',
            'total_distance' => 'Total Distance',
            'total_price' => 'Total Price',
        ];
    }
}
