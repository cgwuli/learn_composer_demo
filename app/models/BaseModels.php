<?php
namespace models;

use Medoo\Medoo;

class BaseModels extends Medoo{
    function __construct()
    {
        $options = [
            'type' => 'mysql',
            'host' => 'localhost',
            'database' => 'gzh',
            'username' => 'gzh_user',
            'password' => '123456789',
            'prefix' => ''
        ];
        parent::__construct($options);
    }
}