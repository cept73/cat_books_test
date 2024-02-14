<?php
/** @noinspection PhpUnused */

namespace frontend\controllers;

use common\helpers\UrlHelper;
use common\repositories\BookRepository;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class BookController extends Controller
{
    /**
     * @throws NotFoundHttpException
     */
    public function actionView(string $path): string
    {
        $id = UrlHelper::getPathIdentifier($path);

        $book = (new BookRepository())->getBookById($id);
        if ($book === null) {
            throw new NotFoundHttpException('Book not found');
        }

        return $this->render('view', [
            'book' => $book
        ]);
    }
}
