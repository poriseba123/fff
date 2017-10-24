<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bank_details".
 *
 * @property string $id
 * @property string $user_id
 * @property string $owner_name
 * @property string $banknote_number
 * @property string $bank_name
 * @property string $account_number
 * @property integer $account_type
 * @property integer $status
 * @property integer $is_verify
 * @property string $created_at
 * @property string $updated_at
 */
class BankDetails extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bank_details';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'owner_name', 'banknote_number', 'bank_name', 'account_number'], 'required'],
            [['user_id', 'account_type', 'status', 'is_verify'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['owner_name', 'banknote_number', 'bank_name', 'account_number'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'owner_name' => 'Owner Name',
            'banknote_number' => 'Banknote Number',
            'bank_name' => 'Bank Name',
            'account_number' => 'Account Number',
            'account_type' => 'Account Type',
            'status' => 'Status',
            'is_verify' => 'Is Verify',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
