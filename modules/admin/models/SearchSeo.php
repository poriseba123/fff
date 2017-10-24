<?php

namespace app\modules\admin\models;

use Yii;
use yii\data\ActiveDataProvider;
use app\models\Seo;

class SearchSeo extends Seo {

    public function rules() {
        return [
            [['module', 'title', 'route','description', 'keyword', 'updated_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'route' => 'Route',
            'title' => 'Title',
            'description' => 'Description',
            'keyword' => 'Keyword',
            'updated_at' => 'Last Updated',
        ];
    }

    public function search($params) {
        $query = Seo::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => ['defaultOrder' => ['id' => SORT_DESC],
                'attributes' => [
                    'id',
                    'route' => [
                        'asc' => ['route' => SORT_ASC],
                        'desc' => ['route' => SORT_DESC],
                        'label' => 'Route',
                        'default' => SORT_DESC
                    ],
                    'title' => [
                        'asc' => ['title' => SORT_ASC],
                        'desc' => ['title' => SORT_DESC],
                        'label' => 'Title',
                        'default' => SORT_DESC
                    ],
                    'keyword' => [
                        'asc' => ['keyword' => SORT_ASC],
                        'desc' => ['keyword' => SORT_DESC],
                        'label' => 'Keyword',
                        'default' => SORT_DESC
                    ],
                    'description' => [
                        'asc' => ['description' => SORT_ASC],
                        'desc' => ['description' => SORT_DESC],
                        'label' => 'Description',
                        'default' => SORT_DESC
                    ],
                    'updated_at' => [
                        'asc' => ['updated_at' => SORT_ASC],
                        'desc' => ['updated_at' => SORT_DESC],
                        'label' => 'Last Updated',
                        'default' => SORT_DESC
                    ],
                    'status'
                ]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'route', $this->route])
                ->andFilterWhere(['like', 'title', $this->title])
                ->andFilterWhere(['like', 'description', $this->description])
                ->andFilterWhere(['like', 'updated_at', $this->updated_at])
                ->andFilterWhere(['like', 'keyword', $this->keyword]);

        return $dataProvider;
    }

}
