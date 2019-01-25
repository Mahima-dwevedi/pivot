<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\cms;

/**
 * searchcms represents the model behind the search form about `app\models\cms`.
 */
class searchcms extends cms
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [[ 'pageTitle', 'slug', 'createdBy', 'updatedBy', 'pageContent', 'pageMetaTitle', 'pageMetaKewords', 'pageMetaDescription', 'pageStatus', 'modifiedDate'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = cms::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id'=>SORT_DESC]],
            'pagination' => [
            'pageSize' => Yii::$app->session->get('pagging'),
            
    ],
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'modifiedDate' => $this->modifiedDate,
        ]);

        $query->andFilterWhere(['like', 'pageDisplayTitle', $this->pageDisplayTitle])
            ->andFilterWhere(['like', 'pageTitle', $this->pageTitle])
            ->andFilterWhere(['like', 'slug', $this->slug])
          
            ->andFilterWhere(['like', 'pageContent', $this->pageContent])
            ->andFilterWhere(['like', 'pageMetaTitle', $this->pageMetaTitle])
            ->andFilterWhere(['like', 'pageMetaKewords', $this->pageMetaKewords])
            ->andFilterWhere(['like', 'pageMetaDescription', $this->pageMetaDescription])
            ->andFilterWhere(['like', 'pageStatus', $this->pageStatus]);

        return $dataProvider;
    }
}
