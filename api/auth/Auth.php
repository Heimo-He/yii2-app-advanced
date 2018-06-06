<?php
/**
 * Created by PhpStorm.
 * User: heimo
 * Date: 2018/6/6
 * Time: 下午5:49
 */
namespace api\auth;

use common\exceptions\ApiException;
use yii\filters\auth\AuthMethod;

class Auth extends AuthMethod
{
    /**
     * @var string the parameter name for passing the access token
     */
    public $tokenParam = 'access_token';
    public $tokenHeader = 'Authorization-Access-Token';


    /**
     * {@inheritdoc}
     */
    public function authenticate($user, $request, $response)
    {
        $accessToken = $request->get($this->tokenParam) ? $request->get($this->tokenParam) : $request->headers[$this->tokenHeader];
        if (is_string($accessToken)) {
            $identity = $user->loginByAccessToken($accessToken, get_class($this));
            if ($identity !== null) {
                return $identity;
            }
        }

        throw new ApiException(401, 'Login Required');
    }
}