<?php
/**
 * @var Book $book
 * @noinspection PhpUnhandledExceptionInspection
 */

use common\helpers\UrlHelper;
use common\models\Book;
use common\services\BookService;

?>

<div class="col">
    <div class="card shadow-sm">
        <img src="<?= $book->photo_cover ?>" title="<?= $book->title ?>"  alt="" />
        <div class="card-body">
            <h2 class="card-text">
                <a href="<?= UrlHelper::getBookViewUrl($book) ?>">
                    <?= $book->title ?>
                </a>
            </h2>
            <p class="card-comment">ISBN: <?= $book->isbn ?>, год: <?= $book->year_publish ?></p>
            <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                    <?php foreach (BookService::getActionsList($book) as $button => $action) : ?>
                    <a href="<?= $action ?>" class="btn btn-sm btn-outline-secondary"><?= $button ?></a>
                    <?php endforeach; ?>
                </div>
                <small class="text-body-secondary"><?= $book->getAuthorsLabel() ?></small>
            </div>
        </div>
    </div>
</div>

