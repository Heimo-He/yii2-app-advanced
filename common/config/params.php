<?php
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,

    'cors' => [
        'Origin' => ['*'],   //允许跨域访问
        'Access-Control-Request-Headers' => ['Authorization', 'Origin,', 'X-Requested-With', 'Content-Type', 'Accept', 'X-ARS'],
        //允许的请求方法
        'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],//OPTIONS是必须的，因为跨域请求会首先以OPTIONS方法发送一个请求
        //'Access-Control-Allow-Methods' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD'],
        'Access-Control-Allow-Credentials' => false,   // 允许前端带cookie访问
        // Allow OPTIONS caching 告诉浏览器我已经记得你了，一天之内不要再发送OPTIONS请求了
        'Access-Control-Max-Age' => 600,    //告诉浏览器，预检请求返回的结果能被缓存多长时间，chrome 最大能缓存600秒，firefox最大能缓存86400秒,
        // Allow the X-Pagination-Current-Page header to be exposed to the browser.
        'Access-Control-Expose-Headers' => ['X-Pagination-Current-Page', 'Authorization-Access-Token'],
    ],

    'login_timeout' => 24*60*60,
    'callbackKey' => '5KkdGFPknKxJD54Dlmn4Dx4fda455dap',

    'Authorization' => true,
];
