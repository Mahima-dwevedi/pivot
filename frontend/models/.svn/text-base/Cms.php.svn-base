<?php
namespace app\models;
use Yii;

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
    public function getItems()
        {
           $items = [];
          $models = \app\models\Cms::find()->where(['pageStatus'=>'1'])->all();
         
            foreach($models as $model) {
              $item[] = ['label' => $model->pageTitle, 'url' => ['/view?slug='.$model-> slug]];
               }
              
            return $item;
          }
 
}

