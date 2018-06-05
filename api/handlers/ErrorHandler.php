<?php
namespace api\handlers;


use common\exceptions\LogicException;
use yii\web\Response;

class ErrorHandler extends \yii\web\ErrorHandler
{


    public function handleException($exception)
    {
        if ($exception instanceof LogicException) {
            $this->apiHandleException($exception);
        } else {
            parent::handleException($exception);
        }
    }

    public function apiHandleException(LogicException $exception)
    {
        $data = $exception->data;

        $response = \Yii::$app->response;

        $response->statusCode = $exception->getStatusCode();
        $response->format = Response::FORMAT_JSON;
        $response->data = $data;

        $response->send();
    }
}