<?php
/**
 * Created by PhpStorm.
 * User: heimo
 * Date: 2018/6/5
 * Time: 下午4:07
 */

return [
    [
        'class' => 'yii\rest\UrlRule',
        'controller' => ['login'],
        'pluralize' => false,
        'extraPatterns' => [
            'OPTIONS <action:.+>' => 'options',
            'POST' => 'login',
            'POST test' => 'test',
        ]
    ]
];