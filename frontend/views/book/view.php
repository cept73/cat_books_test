<?php
/** @noinspection PhpUnhandledExceptionInspection */

/**
 * @var View $this
 * @var Book $book
 */

use common\models\Book;
use yii\web\View;

$this->title = Yii::t('app', 'Просмотр книги: {title}', ['title' => $book->title]);
?>
<div class="site-index">
    <div class="body-content">

        <a class="btn btn-outline-secondary" href="#" onclick="javascript: window.history.back(); return false">
             <?= Yii::t('app', 'Назад') ?>
        </a>

        <div class="bg-transparent rounded-3">
            <div class="container-fluid py-5 text-center">
                <h1 class="display-4"><?= $book->title ?></h1>
                <h3 class="fw-light"><?= $book->description ?></h3>
            </div>
        </div>

        <div>
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
        <div class="align-content-center p-3"><img src="<?= $book->photo_cover ?>" alt="<?= $book->title ?>" class="rounded-2"></div>

    </div>
</div>
