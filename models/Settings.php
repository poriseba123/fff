<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "settings".
 *
 * @property string $id
 * @property string $slug
 * @property string $title
 * @property string $description
 * @property string $type
 * @property string $default
 * @property string $value
 * @property string $module
 */
class Settings extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'settings';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['description', 'type', 'default', 'value'], 'string'],
            [['slug', 'title'], 'string', 'max' => 100],
            [['module'], 'string', 'max' => 50],
            [['slug'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'slug' => 'Slug',
            'title' => 'Title',
            'description' => 'Description',
            'type' => 'Type',
            'default' => 'Default',
            'value' => 'Value',
            'module' => 'Module',
        ];
    }

    public static function mysql_version() {
        $connection = Yii::$app->getDb();
        $sql = $connection->createCommand('SELECT VERSION() as version');
        $version = $sql->queryOne();
        if (is_array($version) && isset($version['version']))
            return $version['version'];
        else
            return 'NA';
    }

}
