<?php

namespace app\modules\admin\models;

use Yii;
use yii\data\ActiveDataProvider;
use app\models\IdentityDocument;

class SearchUser extends UserMaster {

    public $full_name;
    public $identity;

    public function rules() {
        return [
            [["id",'full_name', 'email', 'phone','added_date', 'identity_document_verified', 'status'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'full_name' => 'Name',
            'email' => 'Email Id',
            'phone' => 'Contact No.',
            'added_date' => 'Registration Date',
            'identity' => 'Identity Document',
            'identity_document_verified' => 'Identity Status',
        ];
    }

    public function search($params) {
        $query = IdentityDocument::find()
                ->from(\app\models\UserMaster::tableName()." t")
                ->joinWith(["userDetails as ud"]);
                
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => ['defaultOrder' => ['id' => SORT_DESC],
                'attributes' => [
                    'id',
                    'full_name' => [
                        'asc' => ['ud.first_name' => SORT_ASC, 'ud.last_name' => SORT_ASC],
                        'desc' => ['ud.first_name' => SORT_DESC, 'ud.last_name' => SORT_DESC],
                        'label' => 'Full Name',
                        'default' => SORT_DESC
                    ],
                    'id' => [
                        'asc' => ['id' => SORT_ASC],
                        'desc' => ['id' => SORT_DESC],
                        'label' => 'Id',
                        'default' => SORT_DESC
                    ],
                    'email' => [
                        'asc' => ['ud.email' => SORT_ASC],
                        'desc' => ['ud.email' => SORT_DESC],
                        'label' => 'Email Address',
                        'default' => SORT_DESC
                    ],
                    'added_date' => [
                        'asc' => ['t.added_date' => SORT_ASC],
                        'desc' => ['t.added_date' => SORT_DESC],
                        'label' => 't.Registration Date',
                        'default' => SORT_DESC
                    ],
                    'status'
                ]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'email', $this->email])
                ->andFilterWhere(['like', 'phone', $this->phone])
                ->andFilterWhere(['like', 'added_date', $this->added_date])
                ->andFilterWhere(['like', 'status', $this->status])
                ->andWhere('first_name LIKE "%' . $this->full_name . '%" ' . 'OR last_name LIKE "%' . $this->full_name . '%"')
                ->andWhere('user_type = \'2\'')
                ->andWhere('status <> \'3\'');

        return $dataProvider;
    }
    
    public function searchIdentity($params) {
        $query = UserMaster::find()
                ->where("identity_document_verified <> 0");
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => ['defaultOrder' => ['id' => SORT_DESC],
                'attributes' => [
                    'id',
                    'full_name' => [
                        'asc' => ['first_name' => SORT_ASC, 'last_name' => SORT_ASC],
                        'desc' => ['first_name' => SORT_DESC, 'last_name' => SORT_DESC],
                        'label' => 'Full Name',
                        'default' => SORT_DESC
                    ],
                    'email' => [
                        'asc' => ['email' => SORT_ASC],
                        'desc' => ['email' => SORT_DESC],
                        'label' => 'Email Address',
                        'default' => SORT_DESC
                    ],
                    'status'
                ]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'email', $this->email])
                ->andFilterWhere(['like', 'identity_document_verified', $this->identity_document_verified])
                ->andWhere('first_name LIKE "%' . $this->full_name . '%" ' . 'OR last_name LIKE "%' . $this->full_name . '%"')
                ->andWhere('status <> \'3\'');

        return $dataProvider;
    }

}
