<?php
/**
 * User: wuchunzhi
 * Date: 2015/8/24 0024A
 * Email: cnddcoder@gmail.com
 */

$return['router'] = array(
    /**
     * 请求方式
     * QUERY_STRING 模式 c=xxx&m=xxxx
     * PATH_INFO 模式 /user/getuser
     */
    'query_info' => 'QUERY_STRING',
    //PATH_INFO分隔字符串
    'path_info_mark' => '/',

    //QUERY_STRING模式 控制器和方法名称
    'controller' => 'c',
    'method' => 'm',

    //cli模式 服务端启动自动加载
    'auto_controller' => array(
        'index'
    ),
    'auto_model' => array(),
);
$return['database'] = array(
    //数据库类型 mysql,mysqli
    'type' => 'mysql',
    'mysql' => array(
        //数据库地址
        'hostname' => '127.0.0.1',
        //数据库用户名
        'username' => 'root',
        //数据库密码
        'password' => 'coolheros',
        //数据库
        'basename' => 'swoole',
        //是否持久连接 1为不记录  0为记录
        'pconnect' => 1,
        //是否记录日志
        'log' => true,
        //日志路径
        'logfilepath' => '',
    ),
);

