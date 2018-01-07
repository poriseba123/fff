<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "eye_bank_master".
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
class HospitalNursingMaster extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public $cityrow_count;

    public static function tableName() {
        return 'nursinghome_master';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name', 'country_id', 'state_id', 'district_id', 'city_id', 'address', 'status', 'type'], 'required', 'on' => ['create', 'update']],
            [['country_id', 'state_id', 'city_id', 'emergency', 'status', 'ot', 'life_support', 'ambulance', 'medicine_shop', 'payment_otherthancash', 'outdore', 'type'], 'integer'],
            [['description', 'contact_no', 'outdore_time','name', 'pin', 'image', 'typeof_ward'], 'string'],
            [['created_at', 'updated_at', 'establishment_date','facility'], 'safe'],
            [['name'], 'string', 'max' => 100],
            [['address'], 'string', 'max' => 200],
            [['latitude', 'longitude'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'type' => 'Hospital Type',
            'country_id' => 'Country ID',
            'state_id' => 'State ID',
            'district_id' => 'District ID',
            'city_id' => 'City ID',
            'address' => 'Address',
            'pin' => 'Pin',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'open_time' => 'Open Time',
            'emergency' => 'Emergency',
            'ot' => 'Operation theater',
            'life_support' => 'Life supportsystem',
            'ambulance' => 'Own ambulance',
            'description' => 'Description',
            'contact_no' => 'Contact No',
            'image' => 'Image',
            'medicine_shop' => 'Medicine shop',
            'payment_otherthancash' => 'Payment accepted other than cash',
            'facility' => 'Facility',
            'establishment_date' => 'Establishment Date',
            'outdore' => 'Outdore',
            'outdore_time' => 'Outdore time',
            'typeof_ward' => 'Type of ward',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function search($params) {
        $query = HospitalNursingMaster::find();
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
                    'type',
                    'status'
                ]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'name', $this->name])
                ->andFilterWhere(['like', 'address', $this->address])
                ->andFilterWhere(['like', 'type', $this->type])
                ->andFilterWhere(['like', 'status', $this->status])
                ->andWhere('status <> \'3\'');

        return $dataProvider;
    }

    public function getCity() {
        return $this->hasOne(Cities::className(), ['id' => 'city_id']);
    }

}

?>