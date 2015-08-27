<?php
/**
 * User: wuchunzhi
 * Date: 2015/8/25 0025
 * Email: cnddcoder@gmail.com
 */
class Load{
    public function __construct(){

    }

    public function model($model){
        if(is_array($model)){
            return;
        }
        return $reutn = &load_class($model, 'models');
    }
}