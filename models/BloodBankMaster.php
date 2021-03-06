<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "blood_bank_master".
 *
 * @property string $id
 * @property string $name
 * @property int $country_id
 * @property int $state_id
 * @property int $city_id
 * @property string $address
 * @property string $latitude
 * @property string $longitude
 * @property string $open_time
 * @property string $close_time
 * @property int $close_day
 * @property string $description
 * @property string $contact_no
 * @property int $status 0=>inactive,1=>active,3=>delete
 * @property string $created_at
 * @property string $updated_at
 */
class BloodBankMaster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $cityrow_count;
    
    public static function tableName()
    {
        return 'blood_bank_master';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','establishment_date', 'country_id', 'state_id', 'city_id','district_id','open_time', 'close_time','close_day','address','description','status'], 'required','on'=>['create','update']],
            [['country_id', 'state_id', 'city_id', 'close_day', 'status'], 'integer'],
            [['description', 'contact_no','pin'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 100],
            [['address'], 'string', 'max' => 200],
            [['latitude', 'longitude'], 'string', 'max' => 50],
            [['open_time', 'close_time'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'country_id' => 'Country ID',
            'state_id' => 'State ID',
            'city_id' => 'City ID',
            'address' => 'Address',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'open_time' => 'Open Time',
            'close_time' => 'Close Time',
            'close_day' => 'Close Day',
            'description' => 'Description',
            'contact_no' => 'Contact No',
            'status' => 'Status',
            'pin' => 'Pin',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
     public function search($params) {
        $query = BloodBankMaster::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => ['defaultOrder' => ['id' => SORT_DESC],
                'attributes' => [
                    'id',
                    'name' => [
                        'asc' => ['name' => SORT_ASC],
                        'desc' => ['name' => SORT_DESC],
                        'label' => 'name',
                        'default' => SORT_DESC
                    ],
                    'address' => [
                        'asc' => ['address' => SORT_ASC],
                        'desc' => ['address' => SORT_DESC],
                        'label' => 'address',
                        'default' => SORT_DESC
                    ],
                    'open_time' => [
                        'asc' => ['open_time' => SORT_ASC],
                        'desc' => ['open_time' => SORT_DESC],
                        'label' => 'open_time',
                        'default' => SORT_DESC
                    ],
                    'close_time' => [
                        'asc' => ['close_time' => SORT_ASC],
                        'desc' => ['close_time' => SORT_DESC],
                        'label' => 'close_time',
                        'default' => SORT_DESC
                    ],
                    'status'
                ]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'name', $this->name])
                ->andFilterWhere(['like', 'address', $this->address])
                ->andFilterWhere(['like', 'open_time', $this->open_time])
                ->andFilterWhere(['like', 'close_time', $this->close_time])
                ->andFilterWhere(['like', 'status', $this->status])
                ->andWhere('status <> \'3\'');

        return $dataProvider;
    }
    public function getCity() {
        return $this->hasOne(Cities::className(), ['id' => 'city_id']);
    }
}
