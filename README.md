# learn_composer_demo
学习使用composer写的以一个简单图书管理系统
# 目录简介
composer require monolog/monolog 下载包
代码包放到vendor里
相关包信息放到 composer.json
相关包依赖放到 composer.lock.json
# composer自动加载
composer.json 类自动加载方法 与 自动加载单文件
```
{
    "require": {
        "monolog/monolog": "^2.2",
        "noahbuscher/macaw": "dev-master"
    },
    "autoload": {
        "psr-4": { //
            "controllers\\":"app/controllers/"
        },
        "files": [ //单文件位置 
            "app/helpers.php"
        ]
    }
}
```
composer dump-autoload 执行

index.php 入口文件
require('vendor/autoload.php'); //引入自动加载包与类
require('class/catetree.php'); //引入要使用的单文件
