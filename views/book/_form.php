<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use kartik\file\FileInput;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Book */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="book-form">

    <?php $form = ActiveForm::begin(['id' => 'form', 'options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?php if ($model->preview) { ?>
        <p><?php echo(Yii::t('app', 'Текущее изображение')); ?></p>   
        <img src="/books/<?php echo $model->preview; ?>" style="width:200px;">
    <?php } ?>
    <?=
    $form->field($model, 'preview')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
        'pluginOptions' => [
            'previewFileType' => 'image',
            'showUpload' => false,
            'allowedFileExtensions' => ['jpg', 'gif', 'png'],
        ]
    ])
    ?>

    <?=
    $form->field($model, 'date')->widget(DatePicker::className(), [
        'language' => 'ru',
        'dateFormat' => 'yyyy-MM-dd',
        'clientOptions' => [
            'changeMonth' => true,
            'yearRange' => '1900:2099',
            'changeYear' => true
        ],
    ])
    ?>

    <?= $form->field($model, 'author_id')->dropDownList($authors)->label(Yii::t('app', 'Автор')) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Добавить') : Yii::t('app', 'Обновить'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>