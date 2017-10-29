<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "doctor_type".
 *
 * @property int $id
 * @property string $type
 * @property int $status 0=>inactive,1=>active
 */
class DoctorType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'doctor_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type'], 'required'],
            [['status'], 'integer'],
            [['type'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'status' => 'Status',
        ];
    }
}
