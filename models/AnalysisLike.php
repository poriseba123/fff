<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "analysis_like".
 *
 * @property string $id
 * @property string $analysis_id
 * @property string $vs_id
 * @property string $user_id
 * @property integer $status
 * @property string $added_date
 * @property string $updated_date
 */
class AnalysisLike extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'analysis_like';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['analysis_id', 'vs_id', 'user_id', 'status'], 'integer'],
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
            'vs_id' => Yii::t('app', 'Vs ID'),
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
