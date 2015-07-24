<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Book;

/**
 * BookSearch represents the model behind the search form about `app\models\Book`.
 */
class BookSearch extends Book {

    public $date_from;
    public $date_to;
    /**
     * @inheritdoc
     */
    public function rules() {
	return [
	    [['id', 'author_id'], 'integer'],
	    [['name', 'date_create', 'date_update', 'preview', 'date', 'date_from', 'date_to'], 'safe'],
	];
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
	    'name' => Yii::t('app', 'Название'),
            'date_from' => Yii::t('app', 'От:'),
            'date_to' => Yii::t('app', 'До:'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
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
    public function search($params) {
	$query = Book::find();

	$dataProvider = new ActiveDataProvider([
	    'query' => $query,
	]);

	$this->load($params);

	if (!$this->validate()) {
	    // uncomment the following line if you do not want to return any records when validation fails
	    // $query->where('0=1');
	    return $dataProvider;
	}

	$query->andFilterWhere([
	    'id' => $this->id,
	    'date_create' => $this->date_create,
	    'date_update' => $this->date_update,
	    'date' => $this->date,
	    'author_id' => $this->author_id,
	]);
	
	$query->andFilterWhere(['like', 'name', $this->name]);
	$query->andFilterWhere(['>=', 'date', $this->date_from]);
	$query->andFilterWhere(['<=', 'date', $this->date_to]);

	return $dataProvider;
    }

}
