<?php
/**
 * User: wuchunzhi
 * Date: 2015/8/24 0024
 * Email: cnddcoder@gmail.com
 */
if (!function_exists('load_class')) {
    function load_class($classname, $directory = 'core', $data = '')
    {
        static $_class = array();
        if (isset($_class[$classname])) {
            return $_class[$classname];
        }
        $directory = '/' . $directory;
        if (file_exists(SYSPATH . $directory . '/' . $classname . '.php')) {
            require SYSPATH . $directory . '/' . $classname . '.php';
        } elseif (file_exists(APPPATH . $directory . '/' . $classname . '.php')) {
            require APPPATH . $directory . '/' . $classname . '.php';
        }
//        $ucname = ucfirst($classname);
        $_class[$classname] = new $classname($data);
        return $_class[$classname];
    }
}

/**
 * 显示404页面
 */
if (!function_exists('show_404')) {
    function show_404($info = '')
    {
        echo "<h1> {$info} 404 NOT FIND </h1>";
    }
}

/**
 * 删除不可见的字符串
 */
if (!function_exists('remove_invisible_characters')) {
    function remove_invisible_characters($str, $url_encoded = TRUE)
    {
        $non_displayables = array();

        if ($url_encoded) {
            $non_displayables[] = '/%0[0-8bcef]/';    // url encoded 00-08, 11, 12, 14, 15
            $non_displayables[] = '/%1[0-9a-f]/';    // url encoded 16-31
        }

        $non_displayables[] = '/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]+/S';    // 00-08, 11, 12, 14-31, 127

        do {
            $str = preg_replace($non_displayables, '', $str, -1, $count);
        } while ($count);

        return $str;
    }
}

/**
 * XSS攻击过滤
 */
if (!function_exists('xss_clean')) {
    function xss_clean($info)
    {
        $farr = array(
            "/\s+/",
            "/<(\/?)(script|i?frame|style|html|body|title|link|meta|\?|\%)([^>]*?)>/isU",
            "/(<[^>]*)on[a-zA-Z]+\s*=([^>]*>)/isU",//过滤javascript的on事件
        );
        $tarr = array(
            " ",
            "＜\1\2\3＞",
            "\1\2",
        );
        $str = preg_replace($farr, $tarr, $info);
        return $str;
    }
}