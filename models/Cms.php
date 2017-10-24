<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cms".
 *
 * @property string $id
 * @property string $slug
 * @property string $title
 * @property string $content
 * @property string $created_at
 * @property string $updated_at
 * @property string $status
 */
class Cms extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['slug', 'title', 'content', 'updated_at'], 'required', 'on'=>['update_cms']],
            [['content', 'status'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['slug'], 'string', 'max' => 50],
            [['title'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'slug' => Yii::t('app', 'Slug'),
            'title' => Yii::t('app', 'Title'),
            'content' => Yii::t('app', 'Content'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Last Updated'),
            'status' => Yii::t('app', 'Status'),
        ];
    }
}
