<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ambulance_contact".
 *
 * @property int $id
 * @property int $ambulance_id
 * @property string $status 0 -inactive 1-active 3-delete
 */
class AmbulanceContact extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'ambulance_contact';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['contact_number'], 'required', 'on' => ['create_ambulance', 'update_ambulance']],
            //[['contact_number'], 'required'],
            [['ambulance_id'], 'integer'],
            [['status', 'contact_number'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'ambulance_id' => 'Ambulance ID',
            'status' => 'Status',
        ];
    }

    public static function createMultiple($modelClass, $multipleModels = []) {
        $model = new $modelClass;
        $formName = $model->formName();
        $post = Yii::$app->request->post($formName);
        $models = [];

        if (!empty($multipleModels)) {
            $keys = array_keys(ArrayHelper::map($multipleModels, 'id', 'id'));
            $multipleModels = array_combine($keys, $multipleModels);
        }

        if ($post && is_array($post)) {
            foreach ($post as $i => $item) {
                if (isset($item['id']) && !empty($item['id']) && isset($multipleModels[$item['id']])) {
                    $models[] = $multipleModels[$item['id']];
                } else {
                    $models[] = new $modelClass;
                }
            }
        }

        unset($model, $formName, $post);

        return $models;
    }

}
