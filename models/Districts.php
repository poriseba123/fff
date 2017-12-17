<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "districts".
 *
 * @property string $id
 * @property string $name
 * @property string $state_id
 */
class Districts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'districts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','state_id','status'], 'required','on'=>['create','update']],
            [['state_id'], 'integer'],
			[['name'], 'unique'],
            [['name'], 'string', 'max' => 100],
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
            'state_id' => 'State',
        ];
    }
	
		 public function search($params) {
        $query = Districts::find();
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
                   'state_id' => [
                        'asc' => ['state_id' => SORT_ASC],
                        'desc' => ['state_id' => SORT_DESC],
                        'label' => 'State',
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
                ->andFilterWhere(['like', 'state_id', $this->state_id])
				->andFilterWhere(['like', 'status', $this->status])
                ->andWhere('status <> \'3\'');

        return $dataProvider;
    }
}
