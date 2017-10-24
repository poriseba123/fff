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
class Newsletter extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'newsletter';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['full_name', 'email_id'], 'required','on'=>'subscribe'],
            [['status'], 'integer'],
            ['email_id', 'email'],
            [['created_at', 'updated_at'], 'safe'],
            [['full_name', 'email_id'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'full_name' => 'Nombre completo',
            'email_id' => 'Correo electrónico',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
