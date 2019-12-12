<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Setting;

/**
 * SettingSearch represents the model behind the search form of `app\models\Setting`.
 */
class SettingSearch extends Setting
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_setting', 'status_setting', 'createdAt_setting', 'updatedAt_setting'], 'integer'],
            [['type_setting', 'section_setting', 'key_setting', 'value_setting'], 'safe'],
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
        $query = Setting::find();

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
            'id_setting' => $this->id_setting,
            'status_setting' => $this->status_setting,
            'createdAt_setting' => $this->createdAt_setting,
            'updatedAt_setting' => $this->updatedAt_setting,
        ]);

        $query->andFilterWhere(['like', 'type_setting', $this->type_setting])
            ->andFilterWhere(['like', 'section_setting', $this->section_setting])
            ->andFilterWhere(['like', 'key_setting', $this->key_setting])
            ->andFilterWhere(['like', 'value_setting', $this->value_setting]);

        return $dataProvider;
    }
}
