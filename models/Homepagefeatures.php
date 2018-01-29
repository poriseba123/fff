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
class Homepagefeatures extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'homepage_features';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['heading', 'fav_icon', 'description'], 'required', 'on' => ['create', 'update']],
            [['heading'], 'unique', 'on' => 'create'],
            [['heading'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {

        return [
            'id' => 'ID',
            'heading' => 'Heading',
            'fav_icon' => 'Icon',
            'description' => 'Description'
        ];
    }

    public function search($params) {
        $query = Homepagefeatures::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => ['defaultOrder' => ['id' => SORT_DESC],
                'attributes' => [
                    'id',
                    'heading' => [
                        'asc' => ['heading' => SORT_ASC],
                        'desc' => ['heading' => SORT_DESC],
                        'label' => 'Heading',
                        'default' => SORT_DESC
                    ],
                    'description' => [
                        'asc' => ['description' => SORT_ASC],
                        'desc' => ['description' => SORT_DESC],
                        'label' => 'Description',
                        'default' => SORT_DESC
                    ]
                ]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'heading', $this->heading])
                ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }

}

?>