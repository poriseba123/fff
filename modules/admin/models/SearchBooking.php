<?php

namespace app\modules\admin\models;

use Yii;
use yii\data\ActiveDataProvider;

class SearchBooking extends BookingMaster {

    public $full_name;

    public function rules() {
        return [
//            [['user_id', 'trip_id', 'booking_type', 'booking_status', 'booking_location_start_id', 'booking_location_end_id', 'payment_status', 'status'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'trackId' => Yii::t('app', 'Track ID'),
            'user_id' => Yii::t('app', 'User'),
            'trip_id' => Yii::t('app', 'Trip ID'),
            'booking_type' => Yii::t('app', 'Booking Type'),
            'request_time' => Yii::t('app', 'Request Time'),
            'booking_status' => Yii::t('app', 'Booking Status'),
            'booking_location_start_id' => Yii::t('app', 'Booking Location Start'),
            'booking_location_end_id' => Yii::t('app', 'Booking Location End'),
            'total_distance' => Yii::t('app', 'Total Distance'),
            'total_price' => Yii::t('app', 'Total Price'),
            'added_date' => Yii::t('app', 'Added Date'),
        ];
    }

    public function search($params) {
        $query = BookingMaster::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => ['defaultOrder' => ['id' => SORT_DESC],
//                'attributes' => [
//                    'id',
//                    'full_name' => [
//                        'asc' => ['first_name' => SORT_ASC, 'last_name' => SORT_ASC],
//                        'desc' => ['first_name' => SORT_DESC, 'last_name' => SORT_DESC],
//                        'label' => 'Full Name',
//                        'default' => SORT_DESC
//                    ],
//                    'email' => [
//                        'asc' => ['email' => SORT_ASC],
//                        'desc' => ['email' => SORT_DESC],
//                        'label' => 'Email Address',
//                        'default' => SORT_DESC
//                    ],
//                    'phone' => [
//                        'asc' => ['phone' => SORT_ASC],
//                        'desc' => ['phone' => SORT_DESC],
//                        'label' => 'Phone No.',
//                        'default' => SORT_DESC
//                    ],
//                    'added_date' => [
//                        'asc' => ['added_date' => SORT_ASC],
//                        'desc' => ['added_date' => SORT_DESC],
//                        'label' => 'Registration Date',
//                        'default' => SORT_DESC
//                    ],
//                    'status'
//                ]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        return $dataProvider;
    }

}
