<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "like_master".
 *
 * @property string $id
 * @property string $analysis_id
 * @property string $user_id
 * @property integer $type
 * @property integer $status
 * @property string $added_date
 * @property string $updated_date
 */
class LikeMaster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'like_master';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['target_id', 'user_id', 'type', 'status'], 'integer'],
            [['added_date', 'updated_date'], 'required'],
            [['added_date', 'updated_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'target_id' => Yii::t('app', 'Analysis ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'type' => Yii::t('app', 'Type'),
            'status' => Yii::t('app', 'Status'),
            'added_date' => Yii::t('app', 'Added Date'),
            'updated_date' => Yii::t('app', 'Updated Date'),
        ];
    }
}
