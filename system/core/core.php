<?php
/**
 * User: wuchunzhi
 * Date: 2015/8/24 0024
 * Email: cnddcoder@gmail.com
 */
//���ع�������
require 'common.php';

//���ؾ�̬�����ļ�
require APPPATH . '/config/constant.php';

//��������
$CONFIG = load_class('config');
//��ȡ����
$CONFIG->load('config');
//���ݲ�����ȡ����
$router_config = $CONFIG->get_item(array('router'));
//����·��
$ROUTER = load_class('router', 'core', $router_config);

if (isset($_SERVER['cli']) && isset($_SERVER['init'])) {
    $ROUTER->get_auto_router();
    return;
}

//��ȡ������&��������
if(!isset($_SERVER['init']) && !isset($_SERVER['cli'])){
    $REQUEST = $ROUTER->get_router();
    $controller = $REQUEST['controller'];
    $method = $REQUEST['method'];
}else{
    $controller = $_SERVER['c'];
    $method = $_SERVER['m'];
}

if (!file_exists(APPPATH . '/controllers/' . $controller . '.php')) {
    show_404('controllers/' . $controller . '.php');
    return;
}

$INPUT = load_class('input');
$INPUT->init();

load_class('controller');

$controller = load_class($controller, 'controllers');

$controller->$method();
