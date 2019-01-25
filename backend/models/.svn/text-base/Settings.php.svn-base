<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "settings".
 *
 * @property integer $pkSettingsID
 * @property integer $fkAdminID
 * @property double $settingGstCharge
 */
class Settings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'settings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fkAdminID', 'settingGstCharge'], 'required'],
            [['fkAdminID'], 'integer'],
            [['settingGstCharge'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pkSettingsID' => 'Pk Settings ID',
            'fkAdminID' => 'Fk Admin ID',
            'settingGstCharge' => 'Setting Gst Charge',
        ];
    }
}
