<?php
namespace common\exceptions;

class ApiException extends LogicException
{
    protected $statusCode = 200;
}
