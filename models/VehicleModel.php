<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vehicle_model".
 *
 * @property string $id
 * @property integer $brand_id
 * @property string $model_no
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 */
class VehicleModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vehicle_model';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['brand_id', 'model_no', 'status', 'created_at', 'updated_at'], 'required'],
            [['brand_id', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['model_no'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'brand_id' => Yii::t('app', 'Brand ID'),
            'model_no' => Yii::t('app', 'Model No'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
