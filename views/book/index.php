<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Книги');
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Добавить книгу'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            'preview',
            [
                'label' => Yii::t('app', 'Автор'),
                'value' => function ($dataProvider) {
                    return $dataProvider->author->firstname . ' ' . $dataProvider->author->lastname;
                }
            ],
            [
                'attribute' => 'date',
                'format' => ['date', 'php:d M yy']
            ],
            'date_create',
            [
                'class' => 'yii\grid\ActionColumn',
                
            ],
        ]
    ]);
    ?>
</div>