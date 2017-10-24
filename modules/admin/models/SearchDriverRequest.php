<?php

namespace app\modules\admin\models;

use Yii;
use yii\data\ActiveDataProvider;
use app\models\UserVehicle;

class SearchDriverRequest extends UserVehicle {

    public $full_name;
    public $vehicle_brand;
    public $vehicle_model;
    public $vehicle_color;

    public function rules() {
        return [
            [['full_name', 'vehicle_brand', 'vehicle_model', 'vehicle_color','added_date', 'status'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'full_name' => 'Name',
            'added_date' => 'Registration Date',
        ];
    }

    public function search($params) {
        $query = UserVehicle::find()
                ->from(UserVehicle::tableName() . ' t')
                ->joinWith(['userDetails as ud', 'vBrand as vb', 'vModel as vm', 'vColor as vc'])
                ->where("t.status = 0 AND (ud.status = 1 OR ud.status = 2)");
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
                    'vehicle_brand' => [
                        'asc' => ['vb.brand' => SORT_ASC],
                        'desc' => ['vb.brand' => SORT_DESC],
                        'label' => 'Vehicle Brand',
                        'default' => SORT_DESC
                    ],
                    'vehicle_model' => [
                        'asc' => ['vm.model_no' => SORT_ASC],
                        'desc' => ['vm.model_no' => SORT_DESC],
                        'label' => 'Vehicle Model',
                        'default' => SORT_DESC
                    ],
                    'vehicle_color' => [
                        'asc' => ['vc.color_name_es' => SORT_ASC],
                        'desc' => ['vc.color_name_es' => SORT_DESC],
                        'label' => 'Vehicle Color',
                        'default' => SORT_DESC
                    ],
                    'added_date' => [
                        'asc' => ['t.added_date' => SORT_ASC],
                        'desc' => ['t.added_date' => SORT_DESC],
                        'label' => 'Requested Date',
                        'default' => SORT_DESC
                    ],
                    'status'
                ]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 't.added_date', $this->added_date])
                ->andFilterWhere(['like', 't.status', $this->status])
                ->andFilterWhere(['like', 'vb.brand', $this->vehicle_brand])
                ->andFilterWhere(['like', 'vm.model_no', $this->vehicle_model])
                ->andFilterWhere(['like', 'vc.color_name_es', $this->vehicle_color])
                ->andWhere('ud.first_name LIKE "%' . $this->full_name . '%" ' . 'OR ud.last_name LIKE "%' . $this->full_name . '%"')
                ->andWhere('ud.user_type = \'2\'')
                ->andWhere('ud.status <> \'3\'');

        return $dataProvider;
    }

}
