<?php
/**
 * User: wuchunzhi
 * Date: 2015/8/24 0024A
 * Email: cnddcoder@gmail.com
 */

/**
 * ����ʽ
 * QUERY_STRING ģʽ c=xxx&m=xxxx
 * PATH_INFO ģʽ /user/getuser
 */
$return['router']['query_info'] = 'QUERY_STRING';

//PATH_INFO�ָ��ַ���
$return['router']['path_info_mark'] = '/';

//QUERY_STRINGģʽ �������ͷ�������
$return['router']['controller'] = 'c';
$return['router']['method'] = 'm';

//cliģʽ �Զ�����
$return['router']['auto_controller'] = array('index');
$return['router']['auto_model'] = array();

