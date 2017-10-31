<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "day_master".
 *
 * @property int $id
 * @property string $day
 */
class DayMaster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'day_master';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['day'], 'required'],
            [['day'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'day' => 'Day',
        ];
    }
}
