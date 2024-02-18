<?php
/**
 * @noinspection PhpMissingReturnTypeInspection
 * @noinspection PhpUnused
 */

namespace frontend\controllers;

use common\exceptions\AccessDeniedException;
use common\helpers\RbacPermissionHelper;
use common\services\RbacService;
use common\services\SubscribeService;
use frontend\models\SubscribeForm;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Site controller
 */
class AjaxController extends BaseAjaxController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['subscribe'],
                'rules' => [
                    [
                        'actions' => ['subscribe'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['subscribe'],
                ],
            ],
        ];
    }

    /**
     * Subscribe
     * @throws AccessDeniedException
     */
    public function actionSubscribe()
    {
        if (!RbacService::isUserCan(RbacPermissionHelper::SUBSCRIBE_AUTHOR)) {
            throw new AccessDeniedException();
        }

        $subscribeForm = new SubscribeForm();
        $postData = Yii::$app->request->post();
        if (!$subscribeForm->load($postData, '') || !$subscribeForm->validate()) {
            return [
                'status' => self::STATUS_ERROR,
                'errors' => $subscribeForm->errors
            ];
        }

        $result = SubscribeService::subscribeByForm($subscribeForm);

        return [
            'status' => self::STATUS_OK,
            'result' => $result
        ];
    }
}
