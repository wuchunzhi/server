<?php
/**
 * User: wuchunzhi
 * Date: 2015/8/25 0025
 * Email: cnddcoder@gmail.com
 */
class Load{
    static $_model;
    public function __construct(){

    }

    public function model($model){
        if(isset(self::$_model[$model])){
            return self::$_model[$model];
        }
        require APPPATH . '/models/' . $model . '.php';
        $modename = ucfirst($model);
        self::$_model[$model] = new $modename();
        return self::$_model[$model];
    }
}