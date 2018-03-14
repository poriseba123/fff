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
class Faq extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'faq';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['question', 'answer','status'], 'required', 'on' => ['create', 'update']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {

        return [
            'id' => 'ID',
            'question' => 'Question',
            'answer' => 'Answer',
            'status'=>'Status'
        ];
    }

    public function search($params) {
        $query = Faq::find();
         $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => ['defaultOrder' => ['id' => SORT_DESC],
                'attributes' => [
                    'id',
                    'question' => [
                        'asc' => ['question' => SORT_ASC],
                        'desc' => ['question' => SORT_DESC],
                        'label' => 'Question',
                        'default' => SORT_DESC
                    ],
                    'answer' => [
                        'asc' => ['answer' => SORT_ASC],
                        'desc' => ['answer' => SORT_DESC],
                        'label' => 'Answer',
                        'default' => SORT_DESC
                    ],
                    'status'
                ]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'question', $this->question])
                ->andFilterWhere(['like', 'answer', $this->answer])
                ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }

}

?>