<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "cities".
 *
 * @property int $id
 * @property string $name
 * @property int $state_id
 */
class Landingpage extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'landing_page';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['heading', 'tagline', 'listing_line', 'slider_line', 'subscription_line', 'youtube_url', 'about_us'], 'required', 'on' => ['create', 'update']],
            [['heading'], 'string', 'max' => 25],
            [['tagline'], 'string', 'max' => 150],
            [['listing_line'], 'string', 'max' => 150],
            [['slider_line'], 'string', 'max' => 150],
            [['subscription_line'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {

        return [
            'id' => 'ID',
            'heading' => 'Heading',
            'tagline' => 'Tagline',
            'listing_line' => 'Listing Heading',
            'slider_line' => 'Slider Heading',
            'subscription_line' => 'Subscription Heading',
            'youtube_url' => 'Youtube url',
            'about_us' => 'About Us',
        ];
    }

    public function search($params) {
        $query = Landingpage::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => ['defaultOrder' => ['id' => SORT_DESC],
                'attributes' => [
                    'id',
                    'heading' => [
                        'asc' => ['heading' => SORT_ASC],
                        'desc' => ['heading' => SORT_DESC],
                        'label' => 'Heading',
                        'default' => SORT_DESC
                    ],
                    'tagline' => [
                        'asc' => ['tagline' => SORT_ASC],
                        'desc' => ['tagline' => SORT_DESC],
                        'label' => 'Tagline',
                        'default' => SORT_DESC
                    ]
                ]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'heading', $this->heading])
                ->andFilterWhere(['like', 'tagline', $this->tagline]);

        return $dataProvider;
    }

}

?>