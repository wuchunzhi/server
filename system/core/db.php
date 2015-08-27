<?php
/**
 * User: wuchunzhi
 * Date: 2015/8/27 0027
 * Email: cnddcoder@gmail.com
 */
class Db{
    private $_sql = "";
    static $_db;
    public function __construct($config){
        $this->load($config);
    }

    public function load($config){
        $type = $config['type'];
        switch($type){
            case 'mysql':
                if(!isset(self::$_db[$type])){
                    self::$_db[$type] =& load_class('mysql', 'database', $config[$type]);
                }
                break;
        }
    }

    public function where(){

    }

    public function select(){

    }

    public function get(){

    }

    public function insert(){

    }

    public function update(){

    }

    public function query(){

    }
}