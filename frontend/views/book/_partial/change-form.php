<?php
/** @noinspection PhpUnhandledExceptionInspection */

/**
 * @var Book $book
 * @var string $isbnLabel
 * @var array $authorsList
 */

use common\facades\FileFacade;
use common\models\Book;
use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin(['id' => 'create-form']); ?>

<?= $form->field($book, 'title')->textInput(['autofocus' => true]) ?>

<?= $form->field($book, 'year_publish')->textInput() ?>

<?= $form->field($book, 'description')->textInput() ?>

<?= $form->field($book, 'isbn')->textInput()->hint($isbnLabel) ?>

<?= $form->field($book, '_photo_cover_file')->widget(FileInput::class, [
    'options' => [
        'multiple' => false,
        'accept' => 'image/*',
    ],
    'pluginOptions' => [
        'initialPreview' => [$book->photo_cover],
        'initialPreviewAsData' => true,
        'initialPreviewConfig' => [
            ['caption' => FileFacade::getShortFileName($book->photo_cover)],
        ],
        'overwriteInitial' => false,
        'maxFileSize' => 4096,
        'showPreview' => true,
        'showCaption' => true,
        'showRemove' => true,
        'showUpload' => false,
    ]
]) ?>

<?= $form->field($book, '_authors')->widget(Select2::class, [
    'data' => $authorsList,
    'language' => 'ru',
    'options' => [
        'multiple' => true,
        'placeholder' => 'Выберите авторов',
        'value' => $book->authorsIds(),
    ],
    'pluginOptions' => [
        'allowClear' => true
    ]
]) ?>

<div class="form-group">
    <?= Html::submitButton(
        Yii::t('app', 'Сохранить'),
        ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']
    ) ?>
</div>

<?php ActiveForm::end(); ?>
