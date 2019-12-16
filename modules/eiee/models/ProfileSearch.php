<?php

namespace app\modules\eiee\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eiee\models\Profile;

/**
 * ProfileSearch represents the model behind the search form of `app\modules\eiee\models\Profile`.
 */
class ProfileSearch extends Profile
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'section', 'key_profile', 'value_profile', 'status', 'rule', 'tag', 'createdAt', 'updatedAt'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Profile::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
        ]);
            
        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'section', $this->section])
            ->andFilterWhere(['like', 'key_profile', $this->key_profile])
            ->andFilterWhere(['like', 'value_profile', $this->value_profile])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'rule', $this->rule])
            ->andFilterWhere(['like', 'tag', $this->tag])
            ->andFilterWhere(['like', 'createdAt', $this->createdAt])
            ->andFilterWhere(['like', 'updatedAt', $this->updatedAt]);  
        return $dataProvider;
    }
}
