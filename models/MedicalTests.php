<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "medical_tests".
 *
 * @property int $id
 * @property string $sortname
 * @property string $name
 * @property int $phonecode
 */
class MedicalTests extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'medical_tests';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'status'], 'required'],
			[['name'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
			'name' => 'Name'
            
        ];
    }
}
