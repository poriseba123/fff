<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "message_report".
 *
 * @property string $id
 * @property string $message_id
 * @property string $user_id
 * @property string $step1
 * @property string $step2
 * @property string $step3
 * @property string $step4
 * @property string $message
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 */
class MessageReport extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public $message_sender;
    public $actual_message;
    public static function tableName() {
        return 'message_report';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
//            [['message_id', 'user_id', 'created_at', 'updated_at'], 'required'],
            [['message_id', 'status'], 'integer'],
            [['message'], 'string'],
            [['created_at', 'updated_at', 'message_id', 'user_id','message_sender','actual_message'], 'safe'],
            [['step1', 'step2', 'step3', 'step4'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'message_id' => 'Message ID',
            'user_id' => 'User ID',
            'step1' => 'Step1',
            'step2' => 'Step2',
            'step3' => 'Step3',
            'step4' => 'Step4',
            'message' => 'Message',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getMessagerel() {
        return $this->hasOne(MessageMaster::className(), ['id' => 'message_id']);
    }

    public function getWhoReport() {
        return $this->hasOne(UserMaster::className(), ['id' => 'user_id']);
    }

    public function search($params) {
        $query = MessageReport::find()->joinWith('messagerel');
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => ['defaultOrder' => ['id' => SORT_DESC],
                'attributes' => [
                    'id',
                    'user_id',
                    'step1',
                    'step2',
                    'message',
                    'created_at',
                    'status',
                ]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'message_report.user_id', $this->user_id])
                ->andFilterWhere(['like', 'message_report.step1', $this->step1])
                ->andFilterWhere(['like', 'message_report.step2', $this->step2])
                ->andFilterWhere(['like', 'message_report.message', $this->message])
                ->andFilterWhere(['like', 'message_report.created_at', $this->created_at])
                ->andFilterWhere(['like', 'message_report.status', $this->status])
                ->andWhere('message_report.status <> \'3\'');

        return $dataProvider;
    }

}
