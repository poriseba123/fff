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
class AboutUs extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'about_us';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['youtube_url', 'description'], 'required', 'on' => ['create', 'update']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {

        return [
            'id' => 'ID',
            'youtube_url' => 'Youtube url',
            'description' => 'Description'
        ];
    }

    public function search($params) {
        $query = AboutUs::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => ['defaultOrder' => ['id' => SORT_DESC],
                'attributes' => [
                    'id',
                    'youtube_url' => [
                        'asc' => ['youtube_url' => SORT_ASC],
                        'desc' => ['youtube_url' => SORT_DESC],
                        'label' => 'Youtube url',
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

        $query->andFilterWhere(['like', 'youtube_url', $this->youtube_url])
                ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }

}

?>