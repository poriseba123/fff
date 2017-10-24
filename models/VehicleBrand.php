<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vehicle_brand".
 *
 * @property integer $id
 * @property string $brand
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 */
class VehicleBrand extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vehicle_brand';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['brand', 'created_at', 'updated_at'], 'required'],
            [['status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['brand'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'brand' => Yii::t('app', 'Brand'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
