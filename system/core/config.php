<?php

/**
 * User: wuchunzhi
 * Date: 2015/8/24 0024
 * Email: cnddcoder@gmail.com
 */
class Config
{
    static $_config = array();

    private $_classname;

    public function __construct()
    {

    }

    /**
     * @param $classname ���������ļ�
     */
    public function load($classname)
    {
        if (!isset(self::$_config[$classname])) {
            require APPPATH . '/config/' . $classname . '.php';
            self::$_config[$classname] = $return;
        }
        $this->_classname = $classname;
    }

    /**
     * �����������±��ȡ����
     * @param $classname
     * @param $item
     * @return mixed
     */
    public function get_item($item)
    {
        if(is_array($item)){
            $config = self::$_config[$this->_classname];
            foreach($item as $key => $val){
                if(isset($config[$val])){
                    $config = $config[$val];
                }
            }
            return $config;
        }
        if (isset(self::$_config[$this->_classname][$item])) {
            return self::$_config[$this->_classname][$item];
        }
    }
}