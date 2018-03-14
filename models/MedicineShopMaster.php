<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;
use app\models\Cities;

/**
 * This is the model class for table "medicine_shop_master".
 *
 * @property string $id
 * @property string $name
 * @property int $category_id
 * @property int $country_id
 * @property int $state_id
 * @property int $city_id
 * @property string $address
 * @property string $latitude
 * @property string $longitude
 * @property string $open_time
 * @property string $close_time
 * @property string $contact_no
 * @property int $status 0=>inactive,1=>active,3=>delete
 * @property string $created_at
 * @property string $updated_at
 */
class MedicineShopMaster extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public $cityrow_count;

    public static function tableName() {
        return 'medicine_shop_master';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name', 'category_id', 'country_id', 'district_id', 'state_id', 'city_id', 'close_day', 'address', 'status'], 'required', 'on' => ['create', 'update']],
            [['category_id', 'country_id', 'state_id', 'city_id', 'status'], 'integer'],
            [['contact_no', 'pin'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 100],
            [['name', 'address'], 'unique'],
            [['address'], 'string', 'max' => 200],
            [['latitude', 'longitude'], 'string', 'max' => 50],
            [['open_time', 'close_time'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'category_id' => 'Category ID',
            'country_id' => 'Country ID',
            'state_id' => 'State ID',
            'city_id' => 'City ID',
            'address' => 'Address',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'open_time' => 'Open Time',
            'close_time' => 'Close Time',
            'contact_no' => 'Contact No',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'pin' => 'Pin',
        ];
    }

    public function search($params) {
        $query = MedicineShopMaster::find();
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
                    'category_id' => [
                        'asc' => ['category_id' => SORT_ASC],
                        'desc' => ['category_id' => SORT_DESC],
                        'label' => 'Category',
                        'default' => SORT_DESC
                    ],
                    'city_id' => [
                        'asc' => ['city_id' => SORT_ASC],
                        'desc' => ['city_id' => SORT_DESC],
                        'label' => 'City',
                        'default' => SORT_DESC
                    ],
                    'status',
                ]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'name', $this->name])
                ->andFilterWhere(['like', 'address', $this->address])
                ->andFilterWhere(['like', 'category_id', $this->category_id])
                ->andFilterWhere(['like', 'city_id', $this->city_id])
                ->andFilterWhere(['like', 'status', $this->status])
                ->andWhere('status <> \'3\'');

        return $dataProvider;
    }

    public function getCity() {
        return $this->hasOne(Cities::className(), ['id' => 'city_id']);
    }

}
