<?php
// 包含自动加载文件
require 'vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// create a log channel
$log = new Logger('name');
$log->pushHandler(new StreamHandler(__DIR__.'/your.log', Logger::WARNING));

// add records to the log
$log->warning('composer测试1');
$log->error('composer测试2');