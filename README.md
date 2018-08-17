> 基于Yii2改MCS架构用于开发restful api web应用

### 安装方式

- 初始化环境

```php
php init
```

- 安装依赖

```php
composer install
```

- 完善`common/config/main-local.php`中mysql配置和redis配置

- 修改`console/migrations/m130524_201442_init.php`中`password`为你的密码

- 生成`user`表及初始化root用户

```php
php yii migrate
```

- 配置rbac

```php
      'components' => [
          'authManager' => [
              'class' => 'heimo\rbac\components\DbManager', //配置文件
          ],
      ],

      'as access' => [
          'class' => 'heimo\rbac\components\AccessControl',
          'allowActions' => [//允许访问的节点，可自行添加
              'login/*',
              'logout/*',
              'callback/*',
          ]
      ],
```

- 创建rbac相关表

1. 菜单表menu

```php
yii migrate --migrationPath=@vendor/heimo/yii2-rbac/migrations
```

2. rbac相关权限表

```php
yii migrate --migrationPath=@yii/rbac/migrations/
```

- 授权认证方式

1. url中增加 `access_token` 参数 或者 header中增加 `Authorization` 参数，值为 `Bearer [access_token值]`

2. UserModel中实现 `loginByAccessToken($access_token)` 方法