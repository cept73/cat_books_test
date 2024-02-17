<?php

namespace frontend\controllers;

use common\helpers\UrlHelper;
use Yii;
use yii\web\Controller;
use yii\web\ErrorAction;
use yii\web\Response;

abstract class BaseController extends Controller
{
    /**
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function actions()
    {
        return array_merge(parent::actions(), [
            'error' => [
                'class' => ErrorAction::class,
            ]
        ]);
    }

    /**
     * @noinspection PhpUnused
     */
    public function actionError(): Response|string
    {
        $exception = Yii::$app->errorHandler->exception;
        if ($exception === null) {
            return $this->redirect(UrlHelper::getHomePage());
        }

        $this->layout = 'error';
        Yii::$app->view->params['code'] = $exception->getCode() ?: Yii::$app->response->statusCode;

        return $this->renderContent($exception->getMessage());
    }
}
