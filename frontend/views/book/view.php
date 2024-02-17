<?php

/**
 * @var View $this
 * @var Book $book
 * @var string $backUrl
 * @noinspection PhpUnhandledExceptionInspection
 */

use common\models\Book;
use yii\web\View;

$this->title = Yii::t('app', 'Просмотр книги: {title}', ['title' => $book->title]);

$titleBlockClass = isset($book->photo_cover) ? 'col-md-8' : 'col-12';

?>

<?= $this->render('/site/_partial/go-back', ['backUrl' => $backUrl]) ?>

<div class="bg-transparent rounded-3">
    <div class="container-fluid py-5">
        <div class="row">
            <div class="<?= $titleBlockClass ?>">
                <h1 class="display-4 book-title"><?= $book->title ?></h1>
                <h3 class="fw-light text-left"><?= $book->description ?></h3>
            </div>
            <?php if (isset($book->photo_cover)) : ?>
            <div class="col-md-4">
                <img src="<?= $book->photo_cover ?>" alt="<?= $book->title ?>" class="w-100 rounded-2">
            </div>
            <?php endif ?>
        </div>
    </div>
</div>

<div class="w-50 offset-3">
    <table class="table">
        <tbody>
            <?php foreach ($book->getInformation() as $propKey => $propValue) : ?>
            <tr>
                <th scope="row"><?= $propKey ?></th>
                <td><?= $propValue ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

