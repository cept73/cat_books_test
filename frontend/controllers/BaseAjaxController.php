<?php

namespace frontend\controllers;

use Yii;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\Response;

abstract class BaseAjaxController extends Controller
{
    public const STATUS_OK = 'ok';
    public const STATUS_ERROR = 'error';

    /**
     * @throws BadRequestHttpException
     */
    public function beforeAction($action): bool
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return parent::beforeAction($action);
    }
}
