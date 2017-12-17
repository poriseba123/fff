<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "states".
 *
 * @property int $id
 * @property string $name
 * @property int $country_id
 */
class States extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'states';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','country_id','status'], 'required','on'=>['create','update']],
            [['country_id'], 'integer'],
			[['name'], 'unique'],
            [['name'], 'string', 'max' => 30],
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
            'country_id' => 'Country',
        ];
    }
	 public function search($params) {
        $query = States::find();
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
                   'country_id' => [
                        'asc' => ['country_id' => SORT_ASC],
                        'desc' => ['country_id' => SORT_DESC],
                        'label' => 'Country ',
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
                ->andFilterWhere(['like', 'country_id', $this->country_id])
				->andFilterWhere(['like', 'status', $this->status])
                ->andWhere('status <> \'3\'');

        return $dataProvider;
    }
}
