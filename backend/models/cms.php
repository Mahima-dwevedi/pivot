<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


/**
 * This is the model class for table "cms".
 *
 * @property integer $id
 * @property string $pageDisplayTitle
 * @property string $pageTitle
 * @property string $slug
 * @property string $pageContent
 * @property string $pageMetaTitle
 * @property string $pageMetaKewords
 * @property string $pageMetaDescription
 * @property string $pageStatus
 * @property string $modifiedDate
 */
class Cms extends ActiveRecord
{
	/**
	 * Setting up the table name here
	 * @return string
	 */
	public static function tableName()
	{
		return 'cms';
	}

	/**
	 * Add model validation
	 * @return array
	 */
	public function rules()
	{
		return [
			[['pageTitle', 'slug', 'pageContent'], 'trim'],
			[['pageTitle', 'slug', 'pageStatus'], 'required'],

			['pageTitle', 'unique', 'message' => 'Page title has already been taken.'],
			['slug', 'unique', 'message' => 'Slug has already been taken.'],
			[['pageMetaTitle', 'createdBy', 'updatedBy'], 'string', 'max' => 100],
			[['pageTitle', 'pageMetaKewords', 'pageMetaDescription'], 'string', 'max' => 150],
			[['slug'], 'string', 'max' => 100],
			[['pageMetaTitle', 'options', 'createdBy', 'updatedBy', 'modifiedDate'], 'safe'],

		];
	}

	/**
	 * setting labels for columns
	 * @return array
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'pageTitle' => 'Page Title',
			'slug' => 'Slug',
			'createBy' => 'Created By',
			'updatedBy' => 'Updated By',
			'pageContent' => 'Page Content',
			'pageMetaTitle' => 'Page Meta Title',
			'pageMetaKewords' => 'Page Meta Kewords',
			'pageMetaDescription' => 'Page Meta Description',
			'pageStatus' => 'Status',
			'modifiedDate' => 'Updated Date',
			'options' => 'Page Show',
		];
	}

	/**
	 * search for cms
	 * @param string $params
	 * @return ActiveDataProvider
	 */
	public function search($params = '')
	{
		$query = cms::find();


		$dataProvider = new ActiveDataProvider([
			'query' => $query,

		]);

		/**
		 * Setup your sorting attributes
		 * Note: This is setup before the $this->load($params)
		 * statement below
		 */
		$dataProvider->setSort([
			'attributes' => [
				'pageDisplayTitle',
				'pageTitle' => [
					'asc' => ['pageDisplayTitle' => SORT_ASC, 'pageDisplayTitle' => SORT_ASC],
					'desc' => ['pageTitle' => SORT_DESC, 'pageTitle' => SORT_DESC],
					'label' => 'Full Name',
					'default' => SORT_ASC
				],
				'id'
			]
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		// adding condition here
		$this->addCondition($query, 'id');
		$this->addCondition($query, 'pageTitle', true);
		$this->addCondition($query, 'author', true);
		$this->addCondition($query, 'id');

		//Setup your custom filtering criteria

		// filter by person full name
		$query->andWhere('pageDisplayTitle LIKE "%' . $this->pageDisplayTitle . '%" ' .
			'OR pageTitle LIKE "%' . $this->pageTitle . '%"' . 'OR author LIKE "%' . $this->author . '%"'
		);
		return $dataProvider;
	}

}
