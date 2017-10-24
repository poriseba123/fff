<?php

namespace app\modules\admin\models;

use Yii;
use app\models\SourceMessage;
use yii\data\ActiveDataProvider;

class SearchSourceMessage extends SourceMessage {

    public function rules() {
        return [
            [['message', 'category'], 'safe'],
        ];
    }

    public function search($params) {
        $query = SourceMessage::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => ['defaultOrder' => ['id' => SORT_ASC],
                'attributes' => [
                    'id',
                    'category' => [
                        'asc' => ['category' => SORT_ASC],
                        'desc' => ['category' => SORT_DESC],
                        'label' => 'Category',
                        'default' => SORT_ASC
                    ],
                    'message' => [
                        'asc' => ['message' => SORT_ASC],
                        'desc' => ['message' => SORT_DESC],
                        'label' => 'Message',
                        'default' => SORT_ASC
                    ],
                ]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'message', $this->message])
                ->andFilterWhere(['like', 'category', $this->category]);

        return $dataProvider;
    }

}
