<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

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
            [
                'label' => Yii::t('app', 'Превью'),
                'format' => 'raw',
                'value' => function ($dataProvider) {
                    if ($dataProvider->preview) {
                        return Html::img('/books'.$dataProvider->preview, ['style' => 'width:100px;']);
                    } else {
                        return $dataProvider->preview;
                    }
                }
            ],
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
            [
                'attribute' => 'date_create',
                'format' => ['date', 'php:d M yy']
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>  Yii::t('app', 'Кнопки действия'), 
                'template'=>'{update} {view} {delete}'
            ],
        ]
    ]);
    ?>
</div>