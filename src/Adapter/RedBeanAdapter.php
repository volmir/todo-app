<?php

namespace App\Adapter;

use RedBeanPHP\R as RedBean;

class RedBeanAdapter {
    public static function setup($config) {
        RedBean::setup('mysql:host=' . $config['host']. ';dbname=' . $config['dbname']. '',  
            $config['user'], 
            $config['password']
        );
    }
}
