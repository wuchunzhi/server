<?php

/**
 * User: wuchunzhi
 * Date: 2015/8/24 0024
 * Email: cnddcoder@gmail.com
 */
class mainindex
{
    static $_getinstance;

    private function __construct()
    {

    }

    public function start_server()
    {
        if (!defined('BASE')) {
            define('BASE', __DIR__);
            $application = 'apps';
            define('APPPATH', BASE . '/' . $application);
            $system = 'system';
            define('SYSPATH', BASE . '/' . $system);
        }
        require SYSPATH . '/core/core.php';
    }

    public static function getinstance()
    {
        $_SERVER['cli'] = true;
        if (isset(self::$_getinstance)) {
            return self::$_getinstance;
        }
        $_SERVER['init'] = true;
        self::start_server();
        self::$_getinstance = new self();
    }
}
