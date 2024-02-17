<?php

/**
 * @var View $this
 * @var yii\bootstrap5\ActiveForm $form
 * @var Book $book
 * @var string $randomIsbn13Number
 * @var string $backUrl
 * @noinspection PhpUnhandledExceptionInspection
 */

use common\models\Book;
use yii\web\View;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = Yii::t('app', 'Изменение книги');

$isbnLabel = Yii::t('app', 'For example: {isbn}', [
    'isbn' => $randomIsbn13Number
]);

?>

<?= $this->render('/site/_partial/go-back', ['backUrl' => $backUrl]) ?>

<div class="my-5 offset-lg-3 col-lg-6">
    <h1><?= Html::encode(Yii::t('app', 'Изменение книги')) ?></h1>

    <?php $form = ActiveForm::begin(['id' => 'create-form']); ?>

    <?= $form->field($book, 'title')->textInput(['autofocus' => true]) ?>

    <?= $form->field($book, 'year_publish')->textInput() ?>

    <?= $form->field($book, 'description')->textInput() ?>

    <?= $form->field($book, 'isbn')->textInput()->hint($isbnLabel) ?>

    <?= $form->field($book, 'photo_cover_file')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton(
            Yii::t('app', 'Сохранить'),
            ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']
        ) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
