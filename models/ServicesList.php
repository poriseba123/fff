<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "services_list".
 *
 * @property int $id
 * @property string $name
 * @property string $fa_icon
 * @property string $image
 * @property int $status 0=inactive,1=active,3=delete
 */
class ServicesList extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'services_list';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['status'], 'integer'],
            [['name', 'fa_icon', 'image'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'fa_icon' => 'Fa Icon',
            'image' => 'Image',
            'status' => 'Status',
        ];
    }
}
