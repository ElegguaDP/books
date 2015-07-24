<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Book */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Книги'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-view">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            [
                'attribute' => 'date_create',
                'format' => ['date', 'php:d M yy H:i:s']
            ],
            [
                'attribute' => 'date_update',
                'format' => ['date', 'php:d M yy H:i:s']
            ],
            [
                'label' => Yii::t('app', 'Превью'),
                'format' => 'raw',
                'value' => $model->preview ? Html::img('/books'.$model->preview, ['style' => 'width:200px;']) : $model->preview
            ],
            [
                'attribute' => 'date',
                'format' => ['date', 'php:d M yy']
            ],
            [
                'label' => Yii::t('app', 'Автор'),
                'value' => $model->author->firstname . ' ' . $model->author->lastname
            ],
        ],
    ])
    ?>

</div>