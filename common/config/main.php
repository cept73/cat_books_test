<?php

return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(__DIR__, 2) . '/vendor',
    'components' => [
        'cache' => [
            'class' => \yii\caching\FileCache::class,
        ],
        // TODO: Включить prettyUrl и проверить корректность конфига для веб-сервера
        'urlManager' => [
            'enablePrettyUrl' => false,
            'showScriptName' => false,
        ],
    ],
    'name' => 'Cat Books',
];
