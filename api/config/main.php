<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);
// 路由控制
$ruleDir = __DIR__ . '/rules/';
$rules =  [];
// 打开目录，然后读取其内容
if (is_dir($ruleDir)){
    if ($dh = opendir($ruleDir)){
        while (($file = readdir($dh)) !== false){
            //echo "filename:" . $file . "<br>";
            if(!in_array($file, ['.', '..']) && pathinfo($file)["extension"] == 'php'){
                $rules = @array_merge($rules, require($ruleDir . $file));
            }
        }
        closedir($dh);
    }
}

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'api\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-api',
            'enableCookieValidation' => false,
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
                'text/json' => 'yii\web\JsonParser',
            ],
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableSession' => false,
            'enableAutoLogin' => true,
            'loginUrl' => null
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-api',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'class' => 'api\handlers\ErrorHandler',
            'errorAction' => 'error/info',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => true,
            'rules' => $rules,
        ],
    ],
    'params' => $params,
];
