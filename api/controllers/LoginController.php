<?php
/**
 * Created by PhpStorm.
 * User: heimo
 * Date: 2018/6/5
 * Time: 下午4:05
 */
namespace api\controllers;

use common\exceptions\ApiException;
use Yii;
use common\models\LoginForm;
use yii\web\IdentityInterface;


class LoginController extends BaseController
{
    public $modelClass = '';
    public $isAuth = false;
    public function actionLogin(){
        $model = new LoginForm();
        $model->load(['LoginForm' => Yii::$app->request->post()]);
        $user = $model->login();
        if ($user) {
            if ($user instanceof IdentityInterface) {
                return [
                    'access_token' => $user->access_token,
                    'username' => $user->username,
                ];
            } else {
                return $user->errors;
            }
        }
        throw new ApiException(400,'用户名密码错误',Yii::$app->request->post());
    }
}