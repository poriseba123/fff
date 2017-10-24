<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "message_master".
 *
 * @property string $id
 * @property string $from_id
 * @property string $to_id
 * @property integer $read_status
 * @property integer $status
 * @property integer $type
 * @property string $created_at
 * @property string $updated_at
 */
class MessageMaster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'message_master';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['from_id', 'to_id'], 'required'],
            [['from_id', 'to_id', 'read_status', 'status', 'type'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'from_id' => 'From ID',
            'to_id' => 'To ID',
            'read_status' => 'Read Status',
            'status' => 'Status',
            'type' => 'Type',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    public function getFromUserDetails() {
        return $this->hasOne(UserMaster::className(), ['id' => 'from_id']);
    }
    public function getToUserDetails() {
        return $this->hasOne(UserMaster::className(), ['id' => 'to_id']);
    }
}
