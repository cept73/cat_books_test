<?php

/**
 * @var View $this
 * @var Book[] $books
 */

use common\helpers\RbacPermissionHelper;
use common\helpers\UrlHelper;
use common\models\Book;
use yii\web\View;

$this->title = 'Main page';
?>
    <div class="p-5 mb-4 bg-transparent rounded-3">
        <div class="container-fluid py-5 text-center">
            <h1 class="display-4">Welcome to Books Store!</h1>
            <p class="fs-5 fw-light">Welcome to Books Store</p>

            <?php if (Yii::$app->user->can(RbacPermissionHelper::CREATE_BOOK)) : ?>
                <a class="btn btn-primary btn-lg" href="<?= UrlHelper::getBookCreateUrl() ?>">
                    <?= Yii::t('app', 'Add book') ?>
                </a>
            <?php endif; ?>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <?php foreach ($books as $book) : ?>
            <?= $this->render('_partial/book-short', ['book' => $book]) ?>
        <?php endforeach; ?>
    </div>
