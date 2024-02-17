<?php

/**
 * @var View $this
 * @var yii\bootstrap5\ActiveForm $form
 * @var Book $book
 * @var string $randomIsbn13Number
 * @var string $backUrl
 * @var array $authorsList
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

    <?= $this->render('_partial/change-form', ['book' => $book, 'isbnLabel' => $isbnLabel, 'authorsList' => $authorsList]) ?>
</div>
