<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "identity_document".
 *
 * @property string $id
 * @property integer $type
 * @property string $file_name
 * @property string $added_date
 * @property integer $status
 */
class IdentityDocument extends \yii\db\ActiveRecord {

    public $document;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'identity_document';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['type', 'user_id', 'document', 'added_date', 'status'], 'required', 'on' => ['upload_identity_document']],
            [['type', 'user_id', 'file_name', 'document', 'added_date', 'status'], 'safe', 'on' => ['upload_identity_document']],
            [['document'], 'file', 'extensions' => 'png, jpg, jpeg, gif', 'on' => ['upload_identity_document']],
            [['type', 'status'], 'integer'],
            [['file_name'], 'string'],
            [['added_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'type' => Yii::t('app', 'Document Type'),
            'file_name' => Yii::t('app', 'File Name'),
            'added_date' => Yii::t('app', 'Added Date'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    public function getUserDetails() {
        return $this->hasOne(UserMaster::className(), array("id" => "user_id"));
    }

}
