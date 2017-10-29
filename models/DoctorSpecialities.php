<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "doctor_specialities".
 *
 * @property int $id
 * @property int $doctor_type_id doctor_type table id
 * @property string $speciality
 * @property string $description
 * @property int $status 0=>inactive,1=>active
 */
class DoctorSpecialities extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'doctor_specialities';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['doctor_type_id', 'status'], 'integer'],
            [['speciality', 'description'], 'required','on'=>['create_specialities','update']],
            [['description'], 'string'],
            [['speciality'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'doctor_type_id' => 'Doctor Type ID',
            'speciality' => 'Speciality',
            'description' => 'Description',
            'status' => 'Status',
        ];
    }
     public function search($params) {
        $query = DoctorSpecialities::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => ['defaultOrder' => ['id' => SORT_DESC],
                'attributes' => [
                    'id',
                    'speciality' => [
                        'asc' => ['speciality' => SORT_ASC],
                        'desc' => ['speciality' => SORT_DESC],
                        'label' => 'Speciality',
                        'default' => SORT_DESC
                    ],
                    'description' => [
                        'asc' => ['description' => SORT_ASC],
                        'desc' => ['description' => SORT_DESC],
                        'label' => 'description',
                        'default' => SORT_DESC
                    ],
                    'status'
                ]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'speciality', $this->speciality])
                ->andFilterWhere(['like', 'description', $this->description])
                ->andFilterWhere(['like', 'status', $this->status])
                ->andWhere('status <> \'3\'');

        return $dataProvider;
    }
}
