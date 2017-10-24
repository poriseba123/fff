<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "analysis_comments".
 *
 * @property string $id
 * @property string $parent_id
 * @property string $user_id
 * @property string $analysis_id
 * @property string $comment
 * @property integer $status
 * @property string $added_date
 * @property string $update_date
 */
class AnalysisComments extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'analysis_comments';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['user_id', 'analysis_id', 'comment', 'status', 'added_date', 'update_date'], 'required', "on" => ["create_comment"]],
            [['parent_id', 'user_id', 'analysis_id', 'comment', 'status', 'added_date', 'update_date'], 'required', "on" => ["reply"]],
            [['parent_id', 'user_id', 'analysis_id', 'comment', 'like_total', 'replyed', 'status', 'added_date', 'update_date'], 'safe', "on" => ["create_comment"]],
            [['parent_id', 'user_id', 'analysis_id', 'status'], 'integer'],
            [['comment'], 'string'],
            [['added_date', 'update_date'], 'required'],
            [['added_date', 'update_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'analysis_id' => Yii::t('app', 'Analysis ID'),
            'comment' => Yii::t('app', 'Comment'),
            'status' => Yii::t('app', 'Status'),
            'added_date' => Yii::t('app', 'Added Date'),
            'update_date' => Yii::t('app', 'Update Date'),
        ];
    }

    public function getUserReplyed() {
        return $this->hasMany(self::className(), ['parent_id' => "id"]);
    }

    public function getUserDetails() {
        return $this->hasOne(UserMaster::className(), ['id' => "user_id"]);
    }

}
