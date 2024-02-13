<?php

/**
 * @var View $this
 * @var Book[] $books
 * @var bool $isLoggedIn
 */

use common\models\Book;
use yii\web\View;

$this->title = 'Main page';
?>
<div class="site-index">
    <div class="p-5 mb-4 bg-transparent rounded-3">
        <div class="container-fluid py-5 text-center">
            <h1 class="display-4">Congratulations!</h1>
            <p class="fs-5 fw-light">Welcome to Books Store</p>
        </div>
    </div>

    <div class="body-content">

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <?php foreach ($books as $book) : ?>
                <?= $this->render('_partial/book-short', ['book' => $book, 'isLoggedIn' => $isLoggedIn]) ?>
            <?php endforeach; ?>
        </div>

    </div>
</div>
