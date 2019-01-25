<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "partners".
 *
 * @property integer $pkPartnerID
 * @property string $partnerEmail
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $partnerFirstName
 * @property string $partnerLastName
 * @property string $partnershipLevel
 * @property integer $partnerMobile
 * @property string $partnerDateOfBirth
 * @property integer $fkCityID
 * @property integer $fkCountryID
 * @property string $partnerFirstLogin
 * @property string $partnerProfilePicture
 * @property string $partnerKnowHow
 * @property string $partnerStatus
 * @property string $partnerContractSigned
 * @property integer $fkBankID
 * @property string $partnerNameInBank
 * @property integer $partnerBankAccNo
 * @property string $partnerSubscribeNewsletter
 * @property string $partnerAddedDate
 * @property string $partnerUpdateDate
 *
 * @property Contact[] $contacts
 * @property Bank $fkBank
 * @property Channel $fkChannel
 */
class Partners extends \yii\db\ActiveRecord
{
    // Global variables

    public $contract; 

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'partners';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['partnerEmail', 'auth_key', 'password_hash', 'password_reset_token', 'partnerFirstName', 'partnerLastName', 'partnershipLevel', 'partnerMobile', 'partnerDateOfBirth', 'fkCityID', 'fkCountryID', 'partnerFirstLogin', 'partnerProfilePicture', 'partnerKnowHow', 'partnerStatus', 'partnerContractSigned', 'fkBankID', 'partnerNameInBank', 'partnerBankAccNo', 'partnerSubscribeNewsletter', 'partnerAddedDate', 'partnerUpdateDate'], 'required'],
            [['partnerMobile', 'fkCityID', 'fkCountryID', 'fkBankID', 'partnerBankAccNo'], 'integer'],
            [['partnershipLevel', 'partnerFirstLogin', 'partnerKnowHow', 'partnerStatus', 'partnerContractSigned', 'partnerSubscribeNewsletter'], 'string'],
            [['partnerDateOfBirth', 'partnerAddedDate', 'partnerUpdateDate'], 'safe'],
            [['partnerEmail'], 'string', 'max' => 50],
            [['auth_key', 'password_hash', 'password_reset_token'], 'string', 'max' => 250],
            [['partnerFirstName', 'partnerLastName'], 'string', 'max' => 30],
            [['partnerProfilePicture'], 'string', 'max' => 150],
            [['partnerNameInBank'], 'string', 'max' => 55]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pkPartnerID' => 'Pk Partner ID',
            'partnerEmail' => 'Partner Email',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'partnerFirstName' => 'Partner First Name',
            'partnerLastName' => 'Partner Last Name',
            'partnershipLevel' => 'Partnership Level',
            'partnerMobile' => 'Partner Mobile',
            'partnerDateOfBirth' => 'Partner Date Of Birth',
            'fkCityID' => 'Fk City ID',
            'fkCountryID' => 'Fk Country ID',
            'partnerFirstLogin' => 'Partner First Login',
            'partnerProfilePicture' => 'Partner Profile Picture',
            'partnerKnowHow' => 'Partner Know How',
            'partnerStatus' => 'Partner Status',
            'partnerContractSigned' => 'Partner Contract Signed',
            'fkBankID' => 'Fk Bank ID',
            'partnerNameInBank' => 'Partner Name In Bank',
            'partnerBankAccNo' => 'Partner Bank Acc No',
            'partnerSubscribeNewsletter' => 'Partner Subscribe Newsletter',
            'partnerAddedDate' => 'Partner Added Date',
            'partnerUpdateDate' => 'Partner Update Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContacts()
    {
        return $this->hasMany(Contact::className(), ['fkPartnerID' => 'pkPartnerID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChannel()
    {
        return $this->hasMany(Channel::className(), ['fkPartnerID' => 'pkPartnerID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkBank()
    {
        return $this->hasOne(Bank::className(), ['pkBankID' => 'fkBankID']);
    }

}
