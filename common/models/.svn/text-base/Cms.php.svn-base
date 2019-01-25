<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "cms".
 *
 * @property integer $pkCmsID
 * @property string $pageDisplayTitle
 * @property string $pageTitle
 * @property string $pageContent
 * @property string $pageMetaTitle
 * @property integer $pageMetaKewords
 * @property string $pageMetaDescription
 * @property string $pageStatus
 * @property string $modifiedDate
 */
class Cms extends ActiveRecord implements IdentityInterface
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
            [['pageDisplayTitle', 'pageTitle', 'pageContent', 'pageMetaTitle', 'pageMetaKewords', 'pageMetaDescription', 'pageStatus'], 'required'],
            [['pageContent', 'pageMetaDescription', 'pageStatus'], 'string'],
            [['pageMetaKewords'], 'integer'],
            [['modifiedDate'], 'safe'],
            [['pageDisplayTitle', 'pageMetaTitle'], 'string', 'max' => 100],
            [['pageTitle'], 'string', 'max' => 150]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pkCmsID' => 'Pk Cms ID',
            'pageDisplayTitle' => 'Page Display Title',
            'pageTitle' => 'Page Title',
            'pageContent' => 'Page Content',
            'pageMetaTitle' => 'Page Meta Title',
            'pageMetaKewords' => 'Page Meta Kewords',
            'pageMetaDescription' => 'Page Meta Description',
            'pageStatus' => 'Page Status',
            'modifiedDate' => 'Modified Date',
        ];
    }
    
     public function slectdynamicurl()
    {
         
        $criteria = new CDbCriteria;
        $criteria->select = 'pageDisplayTitle';
        $criteria->condition = 'pageStatus="1"';
        $criteria->order = 'pkCmsID ASC';
        //$criteria->limit=4;
        //print_r($criteria);
        ///die;
        $varMenuItems = Cms::model()->findAll($criteria);
        //echo "<pre>";
        //print_r($varMenuItems);
       // die;
        
    }
    
    
    
    
    
}
