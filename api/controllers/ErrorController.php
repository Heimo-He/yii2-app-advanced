<?php
/**
 * Created by PhpStorm.
 * User: heimo
 * Date: 2018/6/5
 * Time: 下午6:00
 */
namespace api\controllers;

use yii\rest\Controller;
use yii\web\Response;

class ErrorController extends Controller
{

    public function actionInfo()
    {
        $response = \Yii::$app->response;
        $statusCode = $response->statusCode;
        $msg = Response::$httpStatuses[$statusCode];

        $responseMsg['code'] = substr($statusCode, 0, 1) . '00' . substr($statusCode, 1, 2);
        $responseMsg['message'] = $msg;
        $responseMsg['data'] = '';

        return $responseMsg;
    }
}