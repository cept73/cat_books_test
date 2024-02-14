<?php

use yii\caching\FileCache;
use yii\rbac\DbManager;

return [
    'language' => 'ru-RU',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(__DIR__, 2) . '/vendor',
    'components' => [
        'cache' => [
            'class' => FileCache::class,
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => true,
            'rules' => require('url-rules.php')
        ],
        'authManager' => [
            'class' => DbManager::class,
        ],
    ],
    'name' => 'Cat Books',
];
