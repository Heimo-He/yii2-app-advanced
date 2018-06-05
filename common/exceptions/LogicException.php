<?php
namespace common\exceptions;


use yii\base\Exception;

class LogicException extends Exception
{
    const CODE_MAP = [
        '20000' => '请求成功',
        '40000' => '参数异常',
        '50000' => '系统错误',
    ];


    /**
     * @var int
     */
    protected $statusCode = 200;
    public $data = [];
    public $message = '系统错误';
    public $apiCode = 20000;
    /**
     * @return int|string
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function __construct($statusCode = null, $message = null, $data = [], $code = null)
    {
        if ($statusCode && is_numeric($statusCode) && ($statusCode == 401 || $statusCode == 500)) {
            $this->statusCode = $statusCode;
        }
        $this->data['message'] = $message;
        $this->data['data'] = $data;

        $this->apiCode = $code ? : substr($statusCode, 0, 1) . '00' . substr($statusCode, 1, 2);
        $this->data['message'] = $this->data['message'] ?: static::CODE_MAP[$this->code];

        parent::__construct('', 0, null);
    }
}