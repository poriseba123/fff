<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "cities".
 *
 * @property int $id
 * @property string $name
 * @property int $state_id
 */
class Hospitalfacility extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'hospital_facility';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name','status'], 'required', 'on' => ['create', 'update']],
            [['status'], 'integer'],
            [['name'], 'unique'],
            [['name'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {

        return [
            'id' => 'ID',
            'name' => 'Name',
            'status' => 'Status'
        ];
    }

    public function search($params) {
        $query = Hospitalfacility::find();
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
                    'status'
                ]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'name', $this->name])
                ->andFilterWhere(['like', 'status', $this->status])
                ->andWhere('status <> \'3\'');

        return $dataProvider;
    }

}
