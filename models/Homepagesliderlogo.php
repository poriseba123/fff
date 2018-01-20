<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "Homepagesliderlogo".

 */
class Homepagesliderlogo extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    

    public static function tableName() {
        return 'Homepagesliderlogo';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['slider_image1', 'slider_image2', 'slider_image3', 'slider_image4', 'logo_image'], 'on' => ['create', 'update']],
            [['slider_image1', 'slider_image2', 'slider_image3', 'slider_image4', 'logo_image'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'logo_image' => 'Logo',
            'slider_image1' => 'Slider Image 1',
            'slider_image2' => 'Slider Image 2',
            'slider_image3' => 'Slider Image 3',
            'slider_image4' => 'Slider Image 4',
        ];
    }

}

?>