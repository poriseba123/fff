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
            [['contact_number'], 'required', 'on' => ['create_ambulance', 'add']],
            //[['contact_number'], 'required'],
            [['ambulance_id'], 'integer'],
            [['status', 'contact_number'], 'string'],
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

}
