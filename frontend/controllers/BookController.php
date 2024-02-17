<?php
/** @noinspection PhpUnused */

namespace frontend\controllers;

use common\exceptions\AccessDeniedException;
use common\facades\FileFacade;
use common\helpers\IsbnHelper;
use common\helpers\RbacPermissionHelper;
use common\helpers\UrlHelper;
use common\models\Book;
use common\repositories\BookRepository;
use Exception;
use Faker\Generator;
use Throwable;
use Yii;
use yii\db\StaleObjectException;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;

class BookController extends BaseController
{
    /**
     * @throws NotFoundHttpException
     */
    public function actionView(string $path): string
    {
        $book = $this->getBookByPathOrFail($path);

        return $this->render('view', [
            'book' => $book,
            'backUrl' => UrlHelper::getHomePage(),
        ]);
    }

    /**
     * @throws NotFoundHttpException
     * @throws Exception
     */
    public function actionCreate(): Response|string
    {
        $book = new Book();

        $currentUser = Yii::$app->user;
        if (!$currentUser->can(RbacPermissionHelper::CREATE_BOOK)) {
            throw new AccessDeniedException();
        }

        return $this->changeBook($book, 'create');
    }

    /**
     * @throws NotFoundHttpException
     * @throws AccessDeniedException
     */
    public function actionEdit(string $path): Response|string
    {
        $book = $this->getBookByPathOrFail($path);

        $currentUser = Yii::$app->user;
        if (!$currentUser->can(RbacPermissionHelper::getChangeBookPermission($book))) {
            throw new AccessDeniedException();
        }

        return $this->changeBook($book, 'edit');
    }

    /**
     * @param string $path
     * @return Response
     * @throws NotFoundHttpException
     * @throws Throwable
     * @throws StaleObjectException
     */
    public function actionDelete(string $path): Response
    {
        $book = $this->getBookByPathOrFail($path);
        $book->delete();

        return $this->redirect(UrlHelper::getHomePage());
    }

    /**
     * @throws NotFoundHttpException
     */
    private function getBookByPathOrFail(string $path): Book
    {
        $id = UrlHelper::getPathIdentifier($path);

        if (empty($id) || ($book = (new BookRepository())->getBookById($id)) === null) {
            throw new NotFoundHttpException('Book not found');
        }

        return $book;
    }

    private function changeBook($book, $viewFile): Response|string
    {
        $postData = Yii::$app->request->post();
        if (!empty($postData) && $book->load($postData)) {
            /** @var ?UploadedFile $uploadedFile */
            $uploadedFile = UploadedFile::getInstance($book, 'photo_cover_file');

            if ($book->validate()) {
                if ($uploadedFile) {
                    $dirName = '/assets/books/' . Yii::$app->user->id . '/';
                    $fileName = FileFacade::uploadFileTo($uploadedFile, "@frontend/web$dirName");

                    $book->photo_cover = $dirName . $fileName;
                }

                try {
                    $book->save();

                    // TODO: connect to author?
                    /* if (false === (new AuthorBookService())->setAuthor($book, \Yii::$app->user)) {
                        throw new \yii\base\Exception();
                    }*/

                    Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
                } catch (Throwable $exception) {
                    $errorMessage = $exception->getMessage();
                    if (YII_DEBUG && $errorMessage) {
                        Yii::$app->session->setFlash('error', $errorMessage . ':' . $exception->getTraceAsString());
                    }
                }

                return $this->redirect(UrlHelper::getBookViewUrl($book));
            }

            Yii::$app->session->setFlash('error', 'There was an error sending your message.');
        }

        $randomIsbn13Number = IsbnHelper::convertToISBN13((new Generator())->isbn13());

        return $this->render($viewFile, [
            'book' => $book,
            'randomIsbn13Number' => $randomIsbn13Number,
            'backUrl' => UrlHelper::getHomePage()
        ]);
    }
}
