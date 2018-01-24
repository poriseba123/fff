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
class MedicalnewsMaster extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public $cityrow_count;

    public static function tableName() {
        return 'medical_news';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['link', 'description', 'status'], 'required', 'on' => ['create', 'update']],
            [['status'], 'integer'],
            [['link', 'description'], 'string'],
            [['description'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'image' => 'Image',
            'link' => 'Link',
            'description' => 'description',
            'status' => 'Status',
        ];
    }

    public function search($params) {
        $query = MedicalnewsMaster::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => ['defaultOrder' => ['id' => SORT_DESC],
                'attributes' => [
                    'id',
                    'description' => [
                        'asc' => ['description' => SORT_ASC],
                        'desc' => ['description' => SORT_DESC],
                        'label' => 'Description',
                        'default' => SORT_DESC
                    ],
                    'status'
                ]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'description', $this->description])
                ->andFilterWhere(['like', 'status', $this->status])
                ->andWhere('status <> \'3\'');

        return $dataProvider;
    }

}

?>