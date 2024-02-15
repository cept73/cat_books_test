<?php
/** @noinspection PhpUnused */

namespace frontend\controllers;

use common\helpers\FileHelper;
use common\helpers\UrlHelper;
use common\models\Book;
use common\repositories\BookRepository;
use Exception;
use Throwable;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;

class BookController extends Controller
{
    /**
     * @throws NotFoundHttpException
     */
    public function actionView(string $path): string
    {
        $id = UrlHelper::getPathIdentifier($path);

        if (empty($id) || ($book = (new BookRepository())->getBookById($id)) === null) {
            throw new NotFoundHttpException('Book not found');
        }

        return $this->render('view', [
            'book' => $book
        ]);
    }

    /**
     * @throws NotFoundHttpException
     * @throws Exception
     */
    public function actionCreate(): Response|string
    {
        $book = new Book();

        $postData = Yii::$app->request->post();
        if (!empty($postData) && $book->load($postData)) {
            $uploadedFile = UploadedFile::getInstance($book, 'photo_cover_file');

            if ($book->validate()) {
                /** @var ?UploadedFile $uploadedFile */
                if ($uploadedFile) {
                    $dirName = '/assets/books/' . Yii::$app->user->id . '/';
                    $uploadPath = Yii::getAlias('@frontend/web' . $dirName);
                    \yii\helpers\FileHelper::createDirectory($uploadPath);
                    $fileName = FileHelper::getUniqueFileName($uploadedFile);
                    $filePath = $uploadPath . $fileName;
                    $uploadedFile->saveAs($filePath);

                    $book->photo_cover = $dirName . $fileName;
                }

                try {
                    $book->save();

                    // TODO: connect to author
                    /* if (false === (new AuthorBookService())->setAuthor($book, \Yii::$app->user)) {
                        throw new \yii\base\Exception();
                    }*/

                    Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
                } catch (Throwable $exception) {
                    $errorMessage = $exception->getMessage();
                    if (YII_DEBUG && $errorMessage) {
                        Yii::$app->session->setFlash('error', $errorMessage);
                    }
                }

                return $this->redirect(UrlHelper::getBookViewUrl($book));
            }

            Yii::$app->session->setFlash('error', 'There was an error sending your message.');
        }

        return $this->render('create', ['book' => $book]);
    }
}
