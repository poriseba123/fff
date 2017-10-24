<?php

namespace app\models;

use Yii;
use app\models\UserMaster;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "report_master".
 *
 * @property string $id
 * @property string $from_user_id
 * @property string $to_user_id
 * @property string $reason
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 */
class ReportMaster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'report_master';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['from_user_id', 'to_user_id', 'reason', 'created_at', 'updated_at'], 'required'],
            [['from_user_id', 'to_user_id', 'status'], 'integer'],
            [['reason'], 'string'],
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
            'from_user_id' => 'From User ID',
            'to_user_id' => 'To User ID',
            'reason' => 'Reason',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    public function getFromUserDetails() {
        return $this->hasOne(UserMaster::className(), ['id' => 'from_user_id']);
    }
    public function getToUserDetails() {
        return $this->hasOne(UserMaster::className(), ['id' => 'to_user_id']);
    }
     public function search($params) {
        $query = ReportMaster::find()->Where("status = 0 OR status = 1");
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => ['defaultOrder' => ['id' => SORT_DESC],
                'attributes' => [
                    'id','status'
                ]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        

        return $dataProvider;
    }
}
