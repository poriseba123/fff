<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "seo".
 *
 * @property string $id
 * @property string $module
 * @property string $title
 * @property string $route
 * @property string $description
 * @property string $keyword
 * @property string $updated_at
 */
class Seo extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'seo';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['title', 'route', 'description', 'keyword','updated_at'], 'required', 'on' => "create_seo"],
            [['title', 'description', 'keyword','updated_at'], 'required', 'on' => "update_seo"],
            [['id'], 'integer'],
            [['updated_at'], 'safe'],
            [['module'], 'string', 'max' => 50],
            [['title', 'route', 'keyword'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 160],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'module' => Yii::t('app', 'Module'),
            'title' => Yii::t('app', 'Title'),
            'route' => Yii::t('app', 'Route'),
            'description' => Yii::t('app', 'Description'),
            'keyword' => Yii::t('app', 'Keyword'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

}
