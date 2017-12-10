<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;


/**
 * This is the model class for table "ambulance_master".
 *
 * @property string $id
 * @property string $name
 * @property string $vehicle_no
 * @property int $country_id
 * @property int $state_id
 * @property int $city_id
 * @property string $address
 * @property string $latitude
 * @property string $longitude
 * @property int $all_time 0=>No,1=>Yes
 * @property int $ac 0=No,1=yes
 * @property int $oxygen 0=No,1=yes
 * @property string $description
 * @property string $contact_no
 * @property int $status 0=>inactive,1=>active,3=>delete
 * @property string $created_at
 * @property string $updated_at
 */
class AmbulanceMaster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $cityrow_count;
    
    public static function tableName()
    {
        return 'ambulance_master';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'country_id', 'state_id', 'city_id','district_id', 'ac', 'oxygen','lifesupport','all_time','address','description','vehicle_no','status'], 'required','on'=>['create','update']],
            [['country_id', 'state_id', 'city_id', 'all_time', 'ac', 'oxygen', 'lifesupport','status'], 'integer'],
            [['description', 'contact_no'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 100],
            [['vehicle_no'], 'string', 'max' => 30],
            [['address'], 'string', 'max' => 200],
            [['latitude', 'longitude'], 'string', 'max' => 50],
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
            'vehicle_no' => 'Vehicle No',
            'country_id' => 'Country ID',
            'state_id' => 'State ID',
            'city_id' => 'City ID',
            'address' => 'Address',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'all_time' => '24 X 7',
            'ac' => 'Ac',
            'oxygen' => 'Oxygen',
			'lifesupport' =>'Life support',
            'description' => 'Description',
            'contact_no' => 'Contact No',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    
     public function search($params) {
        $query = AmbulanceMaster::find();
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
                    'all_time',
                    'status'
                ]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'name', $this->name])
                ->andFilterWhere(['like', 'address', $this->address])
                ->andFilterWhere(['like', 'all_time', $this->all_time])
                ->andFilterWhere(['like', 'status', $this->status])
                ->andWhere('status <> \'3\'');

        return $dataProvider;
    }
    public function getCity() {
        return $this->hasOne(Cities::className(), ['id' => 'city_id']);
    }
}
