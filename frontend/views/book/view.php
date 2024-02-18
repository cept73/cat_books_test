<?php

/**
 * @var View $this
 * @var Book $book
 * @var string $backUrl
 * @var bool $canSubscribe
 * @noinspection PhpUnhandledExceptionInspection
 */

use common\models\Book;
use frontend\assets\BookPageAsset;
use yii\web\View;

$this->title = Yii::t('app', 'Просмотр книги: {title}', ['title' => $book->title]);

$titleBlockClass = isset($book->photo_cover) ? 'col-md-8' : 'col-12';

BookPageAsset::register($this);

?>

<?= $this->render('/site/_partial/go-back', ['backUrl' => $backUrl]) ?>

<div class="bg-transparent">
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

<?php if ($canSubscribe && !empty($book->authors())) : ?>
<div class="align-content-center my-5">
    <span class="me-2"><?= Yii::t('app', 'Subscribe authors:') ?></span>
    <?php foreach ($book->authors() as $author) : ?>
    <button type="button" class="btn btn-primary position-relative" data-bs-toggle="modal" data-bs-target="#subscribeAuthor<?= $author->id ?>">
        <?= $author->getFullName() ?>
        <!--<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            1
        </span>-->
    </button>
    <?php endforeach; ?>
</div>
<?php endif ?>

<?php foreach ($book->authors() as $author) : ?>
<!-- Modal -->
<div class="modal fade" id="subscribeAuthor<?= $author->id ?>" tabindex="-1" aria-labelledby="subscribeAuthor<?= $author->id ?>Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    <span class="me-1"><?= Yii::t('app', 'Subscribe to:') ?></span>
                    <?= $author->getFullName() ?>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <label>
                    <span class="me-1"><?= Yii::t('app', 'Phone:') ?></span>
                    <input type="tel" class="form-control" name="phone">
                </label>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?= Yii::t('app', 'Close') ?></button>
                <button type="button" class="btn btn-primary" onclick="javascript: subscribe(<?= $author->id ?>, this)">
                    <?= Yii::t('app', 'Subscribe') ?>
                </button>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>

<div class="toast-container position-absolute top-0 end-0 p-3">
    <div class="toast align-items-center" id="toastSubscribeSuccessful" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body"><?= Yii::t('app', 'Вы успешно подписались на книги автора') ?></div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>
