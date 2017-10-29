<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "doctor_chamber".
 *
 * @property string $id
 * @property string $doctor_master_id
 * @property string $chamber_name
 * @property string $address
 * @property string $city_id city_master table id
 * @property string $district_id district_master table id
 * @property string $country_id country_master table id
 * @property string $latitude
 * @property string $longitude
 * @property int $status 0=>Inactive,1=>Active,3=>Delete
 * @property string $created_at
 * @property string $updated_at
 */
class DoctorChamber extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'doctor_chamber';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['doctor_master_id'], 'required'],
            [['doctor_master_id', 'city_id', 'district_id', 'country_id', 'status'], 'integer'],
            [['address'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['chamber_name'], 'string', 'max' => 255],
            [['latitude', 'longitude'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'doctor_master_id' => 'Doctor Master ID',
            'chamber_name' => 'Chamber Name',
            'address' => 'Address',
            'city_id' => 'City ID',
            'district_id' => 'District ID',
            'country_id' => 'Country ID',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    public function search($params) {
        $id=(isset($_REQUEST['id']) && $_REQUEST['id']!='')?$_REQUEST['id']:'';
//        $query = DoctorMaster::find();
        $query = DoctorChamber::find()->where(["doctor_master_id"=>$id]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => ['defaultOrder' => ['id' => SORT_DESC],
                'attributes' => [
                    'id',
                    'chamber_name' => [
                        'asc' => ['chamber_name' => SORT_ASC],
                        'desc' => ['chamber_name' => SORT_DESC],
                        'label' => 'chamber_name',
                        'default' => SORT_DESC
                    ],
                    'address' => [
                        'asc' => ['address' => SORT_ASC],
                        'desc' => ['address' => SORT_DESC],
                        'label' => 'address',
                        'default' => SORT_DESC
                    ],
                    'status'
                ]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'chamber_name', $this->chamber_name])
                ->andFilterWhere(['like', 'address', $this->address])
                ->andFilterWhere(['like', 'status', $this->status])
                ->andWhere('status <> \'3\'');

        return $dataProvider;
    }
}
