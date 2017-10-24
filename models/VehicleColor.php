<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vehicle_color".
 *
 * @property integer $id
 * @property string $color_name_es
 * @property string $color_name_en
 * @property string $color_code
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 */
class VehicleColor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vehicle_color';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['color_name_es', 'color_name_en', 'color_code', 'status', 'created_at', 'updated_at'], 'required'],
            [['status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['color_name_es'], 'string', 'max' => 100],
            [['color_name_en'], 'string', 'max' => 50],
            [['color_code'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'color_name_es' => Yii::t('app', 'Color Name Es'),
            'color_name_en' => Yii::t('app', 'Color Name En'),
            'color_code' => Yii::t('app', 'Color Code'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
