<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "ambulance_master".
 *
 * @property int $id
 * @property string $lat
 * @property string $longi
 * @property string $all_time 0 -no 1-yes
 * @property string $ac 0-no 1-yes
 * @property string $oxygen 0-no 1-yes
 * @property string $vehiclenumber
 * @property string $status 0-inactive 1-active 3-delete
 * @property string $title
 * @property string $image
 */
class AmbulanceMaster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ambulance_master';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['lat', 'longi', 'vehiclenumber', 'title', 'image'], 'required'],
            [['all_time', 'ac', 'oxygen', 'status'], 'string'],
            [['lat', 'longi', 'vehiclenumber', 'title', 'image'], 'string', 'max' => 211],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'lat' => 'Lat',
            'longi' => 'Longi',
            'all_time' => 'all_time',
            'ac' => 'Ac',
            'oxygen' => 'Oxygen',
            'vehiclenumber' => 'Vehiclenumber',
            'status' => 'Status',
            'title' => 'Title',
            'image' => 'Image',
        ];
    }
      public function search($params) {
        $query = AmbulanceMaster::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => ['defaultOrder' => ['id' => SORT_DESC],
                'attributes' => [
                    'id','vehiclenumber','all_time','oxygen','ac','lat','longi',
                    'title' => [
                        'asc' => ['title' => SORT_ASC],
                        'desc' => ['title' => SORT_DESC],
                        'label' => 'title',
                        'default' => SORT_DESC
                    ],
                    'status'
                ]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'title', $this->title])
                ->andFilterWhere(['like', 'vehiclenumber', $this->vehiclenumber])
                ->andFilterWhere(['like', 'all_time', $this->all_time])
                ->andFilterWhere(['like', 'ac', $this->ac])
                ->andFilterWhere(['like', 'oxygen', $this->oxygen])
                ->andFilterWhere(['like', 'status', $this->status])
                ->andWhere('status <> \'3\'');

        return $dataProvider;
    }
}
