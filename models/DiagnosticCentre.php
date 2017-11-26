<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "diagnostic_centre".
 *
 * @property string $id
 * @property string $name
 * @property int $country_id
 * @property int $state_id
 * @property int $district_id
 * @property int $city_id
 * @property string $address
 * @property string $latitude
 * @property string $longitude
 * @property string $open_time
 * @property string $close_time
 * @property int $close_day
 * @property string $contact_no
 * @property string $facilities implode with comma ids from facility table
 * @property string $others facilities are not present
 * @property int $e_report 0=No,1=yes
 * @property string $website
 * @property int $home_collection 0=No,1=yes
 * @property int $status 0=>inactive,1=>active,3=>delete
 * @property string $created_at
 * @property string $updated_at
 */
class DiagnosticCentre extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'diagnostic_centre';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','country_id','district_id', 'state_id', 'city_id','open_time', 'close_time','close_day','address'], 'required','on'=>['create','update']],
//            [['country_id', 'state_id', 'district_id', 'city_id', 'others'], 'required'],
            [['country_id', 'state_id', 'district_id', 'city_id', 'close_day', 'e_report', 'home_collection', 'status'], 'integer'],
            [['contact_no', 'facilities', 'others'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'address'], 'string', 'max' => 200],
            [['latitude', 'longitude'], 'string', 'max' => 50],
            [['open_time', 'close_time'], 'string', 'max' => 20],
            [['website'], 'string', 'max' => 100],
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
            'district_id' => 'District ID',
            'city_id' => 'City ID',
            'address' => 'Address',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'open_time' => 'Open Time',
            'close_time' => 'Close Time',
            'close_day' => 'Close Day',
            'contact_no' => 'Contact No',
            'facilities' => 'Facilities',
            'others' => 'Others',
            'e_report' => 'E Report',
            'website' => 'Website',
            'home_collection' => 'Home Collection',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    public function search($params) {
        $query = DiagnosticCentre::find();
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
}