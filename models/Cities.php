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
class Cities extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'cities';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name', 'district_id', 'status'], 'required', 'on' => ['create', 'update']],
            [['district_id', 'status'], 'integer'],
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
            'district_id' => 'District',
            'status' => 'Status'
        ];
    }

    public function search($params) {
        $query = Cities::find();
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
                    'district_id' => [
                        'asc' => ['district_id' => SORT_ASC],
                        'desc' => ['district_id' => SORT_DESC],
                        'label' => 'District',
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
                ->andFilterWhere(['like', 'district_id', $this->district_id])
                ->andFilterWhere(['like', 'status', $this->status])
                ->andWhere('status <> \'3\'');

        return $dataProvider;
    }

}
