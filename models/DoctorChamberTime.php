<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "doctor_chamber_time".
 *
 * @property string $id
 * @property string $doctor_chamber_id doctor_chamber table id
 * @property int $day_master_id day_master table id
 * @property string $start_time
 * @property string $end_time
 * @property int $status 0=>Inactive,1=>Active,3=>Delete
 * @property string $created_at
 * @property string $updated_at
 */
class DoctorChamberTime extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'doctor_chamber_time';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['doctor_chamber_id', 'day_master_id', 'start_time', 'end_time'], 'required'],
            [['doctor_chamber_id', 'day_master_id', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['start_time', 'end_time'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'doctor_chamber_id' => 'Doctor Chamber ID',
            'day_master_id' => 'Day Master ID',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
