<?php
/**
 * User: wuchunzhi
 * Date: 2015/8/24 0024A
 * Email: cnddcoder@gmail.com
 */

$return['router'] = array(
    /**
     * ����ʽ
     * QUERY_STRING ģʽ c=xxx&m=xxxx
     * PATH_INFO ģʽ /user/getuser
     */
    'query_info' => 'QUERY_STRING',
    //PATH_INFO�ָ��ַ���
    'path_info_mark' => '/',

    //QUERY_STRINGģʽ �������ͷ�������
    'controller' => 'c',
    'method' => 'm',

    //cliģʽ ����������Զ�����
    'auto_controller' => array(
        'index'
    ),
    'auto_model' => array(),
);
$return['database'] = array(
    //���ݿ����� mysql,mysqli
    'type' => 'mysql',
    'mysql' => array(
        //���ݿ��ַ
        'hostname' => '127.0.0.1',
        //���ݿ��û���
        'username' => 'root',
        //���ݿ�����
        'password' => 'coolheros',
        //���ݿ�
        'basename' => 'swoole',
        //�Ƿ�־����� 1Ϊ����¼  0Ϊ��¼
        'pconnect' => 1,
        //�Ƿ��¼��־
        'log' => true,
        //��־·��
        'logfilepath' => '',
    ),
);

