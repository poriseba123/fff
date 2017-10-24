<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "email".
 *
 * @property string $id
 * @property string $email_code
 * @property string $about
 * @property string $subject
 * @property string $body
 * @property string $variable
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 */
class EmailNotify extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'email';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['about', 'subject', 'body', 'updated_at'], 'required','on'=>['admin-update-email']],
            [['body', 'variable', 'status'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['email_code'], 'string', 'max' => 100],
            [['about', 'subject'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'email_code' => Yii::t('app', 'Email Code'),
            'about' => Yii::t('app', 'About'),
            'subject' => Yii::t('app', 'Subject'),
            'body' => Yii::t('app', 'Body'),
            'variable' => Yii::t('app', 'Variable'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
