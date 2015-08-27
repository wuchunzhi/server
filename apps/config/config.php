<?php
/**
 * User: wuchunzhi
 * Date: 2015/8/24 0024A
 * Email: cnddcoder@gmail.com
 */

/**
 * 请求方式
 * QUERY_STRING 模式 c=xxx&m=xxxx
 * PATH_INFO 模式 /user/getuser
 */
$return['router']['query_info'] = 'QUERY_STRING';

//PATH_INFO分隔字符串
$return['router']['path_info_mark'] = '/';

//QUERY_STRING模式 控制器和方法名称
$return['router']['controller'] = 'c';
$return['router']['method'] = 'm';

//cli模式 自动加载
$return['router']['auto_controller'] = array('index');
$return['router']['auto_model'] = array();

