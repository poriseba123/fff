<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "country_phonecodes".
 *
 * @property integer $id
 * @property string $iso
 * @property string $name
 * @property string $nicename
 * @property string $iso3
 * @property integer $numcode
 * @property integer $phonecode
 */
class CountryPhonecodes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'country_phonecodes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['iso', 'name', 'nicename', 'phonecode'], 'required'],
            [['numcode', 'phonecode'], 'integer'],
            [['iso'], 'string', 'max' => 2],
            [['name', 'nicename'], 'string', 'max' => 80],
            [['iso3'], 'string', 'max' => 3],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'iso' => Yii::t('app', 'Iso'),
            'name' => Yii::t('app', 'Name'),
            'nicename' => Yii::t('app', 'Nicename'),
            'iso3' => Yii::t('app', 'Iso3'),
            'numcode' => Yii::t('app', 'Numcode'),
            'phonecode' => Yii::t('app', 'Phonecode'),
        ];
    }
}
