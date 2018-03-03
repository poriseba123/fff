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
class Contactinformation extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'contact_information';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['text1', 'text2', 'text3'], 'required', 'on' => ['create', 'update']],
            [['text1'], 'string', 'max' => 350],
            [['text2'], 'string', 'max' => 350],
            [['text3'], 'string', 'max' => 350],
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {

        return [
            'id' => 'ID',
            'text1' => 'ADDRESS',
            'text2' => 'PHONE NUMBERS',
            'text3' => 'EMAIL ADDRESS'
        ];
    }

    public function search($params) {
        $query = Contactinformation::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => ['defaultOrder' => ['id' => SORT_DESC],
                'attributes' => [
                    'id',
                    'text1' => [
                        'asc' => ['text1' => SORT_ASC],
                        'desc' => ['text1' => SORT_DESC],
                        'label' => 'ADDRESS',
                        'default' => SORT_DESC
                    ],
                    'text2' => [
                        'asc' => ['text2' => SORT_ASC],
                        'desc' => ['text2' => SORT_DESC],
                        'label' => 'PHONE NUMBERS',
                        'default' => SORT_DESC
                    ],
                    'text3' => [
                        'asc' => ['text3' => SORT_ASC],
                        'desc' => ['text3' => SORT_DESC],
                        'label' => 'EMAIL ADDRESS',
                        'default' => SORT_DESC
                    ]
                ]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'text1', $this->text1])
                ->andFilterWhere(['like', 'text2', $this->text2]);

        return $dataProvider;
    }

}

?>