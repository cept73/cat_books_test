<?php

/**
 * @var View $this
 * @var Author[] $authors
 * @var string $backUrl
 * @noinspection PhpUnhandledExceptionInspection
 */

use common\models\Author;
use yii\web\View;

$this->title = Yii::t('app', 'Отчет по авторам');

?>

<?= $this->render('/site/_partial/go-back', ['backUrl' => $backUrl]) ?>

<div class="bg-transparent rounded-3 py-5">
    <div class="container-fluid">
        <h2>Отчет по авторам</h2>
    </div>

    <div class="w-50 offset-3">
        <table class="table">
            <tbody class="align-content-start">
                <?php foreach ($authors as $rank => $author) : ?>
                <tr>
                    <th scope="row"><?= $rank + 1 ?></th>
                    <td><?= $author ? $author->getFullName() : '??' ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

