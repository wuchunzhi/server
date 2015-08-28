<?php

/**
 * User: wuchunzhi
 * Date: 2015/8/27 0027
 * Email: cnddcoder@gmail.com
 */
class Db
{
    private $_sql = "";
    private $_select = '*';
    static $_db;
    private $_where = "";

    public function __construct($config)
    {
        if ($config['type'] != '') {
            $this->load($config);
        }
    }

    public function load($config)
    {
        $type = $config['type'];
        switch ($type) {
            case 'mysql':
                if (!isset(self::$_db[$type])) {
                    self::$_db[$type] =& load_class('mysql', 'database', $config[$type]);
                }
                break;
        }
    }

    public function where($key, $val = '')
    {
        if(!empty($val)){
            $type = $this->_where_init($key, $val);
            $this->_where .= "AND $key $type $val ";
        }elseif(is_array($key)){
            foreach($key as $k => $v){
                $type = $this->_where_init($key, $val);
                $this->_where .= "AND $key . $type . $val ";
            }
        }else{
            if(empty($this->_where)){
                $this->_where .= "WHERE $key";
            }
            $this->_where .= "AND $key";
        }
    }

    private function _where_init($key, $val)
    {
        list($key, $type) = explode(' ', $key);
        $type = empty($type) ? '=' : $type;
        if (empty($this->_where)) {
            $this->_where .= "WHERE $key $type $val ";
        }
        return $type;
    }

    public function where_in($key, $val)
    {
        if (is_array($val)) {
            $where = "";
            foreach ($val as $v) {
                $where .= "'{$v}',";
            }
            $where = substr($where, 0, strlen($where) - 1);
            $where = " $key IN $where";
            if (empty($this->_where)) {
                $this->_where .= "WHERE $where ";
            }
            $this->_where .= "AND $where ";
        }
    }

    public function or_where($key, $val)
    {
        $type = $this->_where_init($key, $val);
        $this->_where .= "OR $key $type $val ";
    }

    public function where_not_in($key, $val)
    {
        if (is_array($val)) {
            $where = "";
            foreach ($val as $v) {
                $where .= "'{$v}',";
            }
            $where = substr($where, 0, strlen($where) - 1);
            $where = " $key NOT IN . $where";
            if (empty($this->_where)) {
                $this->_where .= "WHERE $where ";
            }
            $this->_where .= "AND $where ";
        }
    }

    public function or_where_not_in($key, $val)
    {
        if (is_array($val)) {
            $where = "";
            foreach ($val as $v) {
                $where .= "'{$v}',";
            }
            $where = substr($where, 0, strlen($where) - 1);
            $where = " $key NOT IN  $where";
            if (empty($this->_where)) {
                $this->_where .= "WHERE $where ";
            }
            $this->_where .= "OR $where ";
        }
    }

    public function like($key, $val = '', $escape = ''){
        if(!empty($val)){
            if($escape == 'before'){
                $val = "%$val";
            }elseif($escape == 'after'){
                $val = "$val%";
            }else{
                $val = "%$val%";
            }
            if (empty($this->_where)) {
                $this->_where .= "WHERE $key LIKE $val ";
            }
            $this->_where .= "AND $key LIKE $val ";
        }elseif(is_array($key)){
            foreach($key as $k => $v){
                $val = "%$val%";
                if (empty($this->_where)) {
                    $this->_where .= "WHERE $key LIKE $val ";
                }
                $this->_where .= "AND $key LIKE $val ";
            }
        }else{
            if(empty($this->_where)){
                $this->_where .= "WHERE $key";
            }
            $this->_where .= "AND $key";
        }
    }

    public function or_like($key, $val = '', $escape = ''){
        if(!empty($val)){
            if($escape == 'before'){
                $val = "%$val";
            }elseif($escape == 'after'){
                $val = "$val%";
            }else{
                $val = "%$val%";
            }
            if (empty($this->_where)) {
                $this->_where .= "WHERE $key LIKE $val ";
            }
            $this->_where .= "OR $key LIKE $val ";
        }elseif(is_array($key)){
            foreach($key as $k => $v){
                $val = "%$val%";
                if (empty($this->_where)) {
                    $this->_where .= "WHERE $key LIKE $val ";
                }
                $this->_where .= "OR $key LIKE $val ";
            }
        }
    }

    public function not_like($key, $val = '', $escape = ''){
        if(!empty($val)){
            if($escape == 'before'){
                $val = "%$val";
            }elseif($escape == 'after'){
                $val = "$val%";
            }else{
                $val = "%$val%";
            }
            if (empty($this->_where)) {
                $this->_where .= "WHERE $key NOT LIKE $val ";
            }
            $this->_where .= "AND $key NOT LIKE $val ";
        }elseif(is_array($key)){
            foreach($key as $k => $v){
                $val = "%$val%";
                if (empty($this->_where)) {
                    $this->_where .= "WHERE $key NOT LIKE $val ";
                }
                $this->_where .= "AND $key NOT LIKE $val ";
            }
        }
    }

    public function or_not_like($key, $val = '', $escape = ''){
        if(!empty($val)){
            if($escape == 'before'){
                $val = "%$val";
            }elseif($escape == 'after'){
                $val = "$val%";
            }else{
                $val = "%$val%";
            }
            if (empty($this->_where)) {
                $this->_where .= "WHERE $key NOT LIKE $val ";
            }
            $this->_where .= "OR $key NOT LIKE $val ";
        }elseif(is_array($key)){
            foreach($key as $k => $v){
                $val = "%$val%";
                if (empty($this->_where)) {
                    $this->_where .= "WHERE $key NOT LIKE $val ";
                }
                $this->_where .= "OR $key NOT LIKE $val ";
            }
        }
    }

    public function group_by(){

    }

    public function distinct(){

    }

    public function having(){

    }

    public function or_having(){

    }

    public function order_by(){

    }

    public function limit(){

    }

    public function count_all_results(){

    }

    public function cout_all(){

    }

    public function select($select = '*')
    {
        $this->_select = $select;
    }

    public function get($tablename)
    {
        $this->_sql = "SELECT $this->_select FROM $tablename $this->_where";
        $res = self::$_db->query($this->_sql);
        return $res;
    }

    public function insert()
    {

    }

    public function update()
    {

    }

    public function query()
    {

    }

    private function init_params(){
        $this->_sql = "";
        $this->_select = '*';
        $this->_where = "";
    }
}

