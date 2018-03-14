<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "newsletter".
 *
 * @property string $id
 * @property string $full_name
 * @property string $email_id
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 */
class Newsletter extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'subscription';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['email_id'], 'required', 'on' => 'subscribe'],
            [['status'], 'integer'],
            ['email_id', 'email'],
            [['subscription_data'], 'safe'],
            [['email_id'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'email_id' => 'Email Id',
            'status' => 'Status',
            'subscription_data' => 'Created At'
        ];
    }

}
