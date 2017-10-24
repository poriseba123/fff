<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "meta_location".
 *
 * @property string $id
 * @property string $iso
 * @property string $local_name
 * @property string $type
 * @property string $in_location
 * @property double $geo_lat
 * @property double $geo_lng
 * @property string $db_id
 * @property string $flag
 * @property string $Status
 */
class MetaLocation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'meta_location';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['in_location'], 'integer'],
            [['geo_lat', 'geo_lng'], 'number'],
            [['flag', 'Status'], 'required'],
            [['Status'], 'string'],
            [['iso', 'db_id'], 'string', 'max' => 50],
            [['local_name'], 'string', 'max' => 255],
            [['type'], 'string', 'max' => 2],
            [['flag'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'iso' => 'Iso',
            'local_name' => 'Local Name',
            'type' => 'Type',
            'in_location' => 'In Location',
            'geo_lat' => 'Geo Lat',
            'geo_lng' => 'Geo Lng',
            'db_id' => 'Db ID',
            'flag' => 'Flag',
            'Status' => 'Status',
        ];
    }
    
      public function getcountry() {
        return $this->hasOne(MetaLocation::className(), ['id' => 'in_location']);
    }
    
    
}
