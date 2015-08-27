<?php
/**
 * User: wuchunzhi
 * Date: 2015/8/24 0024
 * Email: cnddcoder@gmail.com
 */
//加载公共函数
require 'common.php';

//加载配置
$CONFIG = &load_class('config');
//读取配置
$CONFIG->load('config');

//获取路由配置
$database_config = $CONFIG->get_item(array('database'));
//加载数据库
$DB = &load_class('db', 'core', $database_config);

//加载静态常量文件
require APPPATH . '/config/constant.php';

//获取路由配置
$router_config = $CONFIG->get_item(array('router'));
//加载路由
$ROUTER = &load_class('router', 'core', $router_config);

if (isset($_SERVER['cli']) && isset($_SERVER['init'])) {
    $ROUTER->get_auto_router();
    return;
}

//获取控制器&方法参数
if (!isset($_SERVER['init']) && !isset($_SERVER['cli'])) {
    $REQUEST = $ROUTER->get_router();
    $controller = $REQUEST['controller'];
    $method = $REQUEST['method'];
} else {
    $controller = $_SERVER['c'];
    $method = $_SERVER['m'];
}

if (!file_exists(APPPATH . '/controllers/' . $controller . '.php')) {
    show_404('controllers/' . $controller . '.php');
    return;
}

$INPUT = &load_class('input');
$INPUT->init();

load_class('controller');

$controller = &load_class($controller, 'controllers');

$controller->$method();
