<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Gaceta;

/**
 * GacetaSearch represents the model behind the search form about `app\models\Gaceta`.
 */
class GacetaSearch extends Gaceta
{

    public $created_at_range; 

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['asunto', 'numero', 'fecha_publicacion', 'ruta', 'created_at_range'], 'safe'],
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
        $query = Gaceta::find();

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
        /*$query->andFilterWhere([
            'id' => $this->id,
            'fecha_publicacion' => $this->fecha_publicacion,
        ]);*/

        if(!empty($this->created_at_range) && strpos($this->created_at_range, '-') !== false) {
            list($start_date, $end_date) = explode(' - ', $this->created_at_range);
            $dateStart = date_create($start_date);
            $dateEnd = date_create($end_date);
            $query->andFilterWhere(['between', 'gaceta.fecha_publicacion', date_format($dateStart, 'Y-m-d'), date_format($dateEnd, 'Y-m-d')]);
        }

        $query->andFilterWhere(['like', 'asunto', $this->asunto])
            ->andFilterWhere(['like', 'numero', $this->numero])
            ->andFilterWhere(['like', 'ruta', $this->ruta]);

        return $dataProvider;
    }
}
