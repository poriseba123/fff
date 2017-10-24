<?php

namespace app\modules\admin\models;

use Yii;
use app\models\Cms;
use yii\data\ActiveDataProvider;

class SearchCms extends Cms {
    
    public function rules() {
        return [
            [['slug','title', 'updated_at', 'created_at'], 'safe'],
        ];
    }
    
    public function search($params) {
        $query = Cms::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => ['defaultOrder' => ['id' => SORT_ASC],
                'attributes' => [
                    'id',
                    'slug' => [
                        'asc' => ['slug' => SORT_ASC],
                        'desc' => ['slug' => SORT_DESC],
                        'label' => 'Slug',
                        'default' => SORT_ASC
                    ],
                    'title' => [
                        'asc' => ['title' => SORT_ASC],
                        'desc' => ['title' => SORT_DESC],
                        'label' => 'Page Title',
                        'default' => SORT_ASC
                    ],
                    'created_at' => [
                        'asc' => ['created_at' => SORT_ASC],
                        'desc' => ['created_at' => SORT_DESC],
                        'label' => 'Created At',
                        'default' => SORT_ASC
                    ],
                    'updated_at' => [
                        'asc' => ['updated_at' => SORT_ASC],
                        'desc' => ['updated_at' => SORT_DESC],
                        'label' => 'Last Updated',
                        'default' => SORT_ASC
                    ],
                ]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'slug', $this->slug])
                ->andFilterWhere(['like', 'title', $this->title])
                ->andFilterWhere(['like', 'created_at', $this->created_at])
                ->andFilterWhere(['like', 'updated_at', $this->updated_at])
                ->andWhere('status <> \'3\'');

        return $dataProvider;
    }
    
}

