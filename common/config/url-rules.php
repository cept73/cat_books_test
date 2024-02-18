<?php

/** @noinspection RequiredAttributes */
return [
    '' => 'site/index',
    'book/<action:create|report>' => 'book/<action>',
    'book/<path>' => 'book/view',
    'book/<path>/<action>' => 'book/<action>',
    'site/<action>' => 'site/<action>',
    'ajax/<action>' => 'ajax/<action>',
];
