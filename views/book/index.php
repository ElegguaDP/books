<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;

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
  <?php  Pjax::begin(['id'=>'ViewId']); ?>
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
                        return Html::img('/books'.$dataProvider->preview, ['id' => $dataProvider->id,'class' => 'preview-book', 'onclick' => 'changeSizeImage(this)']);
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
                'template'=>'{update} {view} {delete}',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>','#', [
                            'class' => 'activity-view-link',
                            'title' => Yii::t('yii', 'Просмотр'),
                            'data-toggle' => 'modal',
                            'data-target' => '#activity-modal',
                            'data-id' => $key,
                            'data-pjax' => '0'
                        ]);
                    },
                ],
            ],
        ]
    ]);
    ?>
    <?php  Pjax::end(); ?>
</div>
<?php $this->registerJsFile(Url::base() .'/js/view-modal.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
<?php Modal::begin([
    'id' => 'activity-modal',
    'header' => '<h4 class="modal-title">Просмотр</h4>',
    'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>'
]); ?>

<div class="well">

</div>

<?php Modal::end(); ?>

<?php $this->registerJsFile(Url::base() .'/js/preview.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>