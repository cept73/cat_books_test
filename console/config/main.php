<?php

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'console\controllers',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'controllerMap' => [
        'fixture' => [
            'class' => \yii\console\controllers\FixtureController::class,
            'namespace' => 'common\fixtures',
          ],
        'seeder' => [
            'class' => \diecoding\seeder\SeederController::class,
            'defaultAction' => 'seed',
            'seederPath' => '@console/seeder',
            'seederNamespace' => 'console\seeder',
            'defaultSeederClass' => 'Seeder',
            'tablesPath' => '@console/seeder/tables',
            'tableSeederNamespace' => 'console\seeder\tables',
            'modelNamespace' => 'common\models',
            'templateSeederFile' => '@vendor/diecoding/yii2-seeder/src/views/Seeder.php',
            'templateTableFile' => '@vendor/diecoding/yii2-seeder/src/views/TableSeeder.php'
        ],
    ],
    'components' => [
        'log' => [
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
    ],
    'params' => $params,
];
