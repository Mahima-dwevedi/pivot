<?php

namespace app\models;


use Yii;

/**
 * This is the model class for table "homeSlider".
 *
 * @property integer $id
 * @property string $banner
 * @property string $content
 * @property string $status
 * @property string $addDate
 * @property string $updateDate
 */
class homebanner extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
	public $banner_old;

    public static function tableName()
    {
        return 'homeSlider';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['banner'], 'required', 'on'=>'create'],
            [['banner'], 'file', 'extensions' => 'jpg, png, jpeg,gif', 'mimeTypes' => 'image/jpeg, image/png,image/jpeg,image/gif '],
 	   ['banner', 'image', 'extensions' => 'jpg, png, jpeg,gif', 'minWidth' => 200, 'maxWidth' => 464, 'minHeight' => 200, 'maxHeight' => 481,],

            [['content', 'status'], 'string'],
            [['addDate', 'updateDate'], 'safe'],
            [['banner'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'banner' => 'Banner',
            'content' => 'content',
            'status' => 'Status',
            'addDate' => 'Add Date',
            'updateDate' => 'Update Date',
        ];
    }
}
