<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "message_report_point".
 *
 * @property integer $id
 * @property string $point
 * @property integer $status
 */
class MessageReportPoint extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'message_report_point';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['point', 'status'], 'required'],
            [['status'], 'integer'],
            [['point'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'point' => 'Point',
            'status' => 'Status',
        ];
    }
}
