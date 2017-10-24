<?php

namespace app\modules\admin\models;

use Yii;
use app\models\EmailNotify;
use yii\data\ActiveDataProvider;

class SearchEmail extends EmailNotify {


    public function rules() {
        return [
            [['email_code', 'subject', 'created_at'], 'safe'],
        ];
    }

//    public function attributeLabels() {
//        return [
//            'full_name' => 'Name',
//            'email' => 'Email Id',
//            'phone' => 'Contact No.',
//            'added_date' => 'Registration Date',
//        ];
//    }

    public function search($params) {
        $query = EmailNotify::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => ['defaultOrder' => ['id' => SORT_ASC],
                'attributes' => [
                    'id',
                    'email_code' => [
                        'asc' => ['email_code' => SORT_ASC],
                        'desc' => ['email_code' => SORT_DESC],
                        'label' => 'Email Code',
                        'default' => SORT_ASC
                    ],
                    'subject' => [
                        'asc' => ['subject' => SORT_ASC],
                        'desc' => ['subject' => SORT_DESC],
                        'label' => 'Email Subject',
                        'default' => SORT_ASC
                    ],
                    'created_at' => [
                        'asc' => ['created_at' => SORT_ASC],
                        'desc' => ['created_at' => SORT_DESC],
                        'label' => 'Created At',
                        'default' => SORT_ASC
                    ],
                ]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'email_code', $this->email_code])
                ->andFilterWhere(['like', 'subject', $this->subject])
                ->andFilterWhere(['like', 'created_at', $this->created_at])
                ->andWhere('status <> \'3\'');

        return $dataProvider;
    }

}
