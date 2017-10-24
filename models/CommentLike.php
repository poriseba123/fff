<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comment_like".
 *
 * @property string $id
 * @property string $analysis_id
 * @property string $user_id
 * @property integer $status
 * @property string $added_date
 * @property string $updated_date
 */
class CommentLike extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment_like';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['comment_id', 'user_id', 'status'], 'integer'],
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
            'analysis_id' => Yii::t('app', 'Analysis ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'status' => Yii::t('app', 'Status'),
            'added_date' => Yii::t('app', 'Added Date'),
            'updated_date' => Yii::t('app', 'Updated Date'),
        ];
    }
    
    public function getUserDetails() {
        return $this->hasOne(UserMaster::className(), ['id' => 'user_id']);
    }
}
