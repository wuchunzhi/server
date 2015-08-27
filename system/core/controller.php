<?php
/**
 * User: wuchunzhi
 * Date: 2015/8/24 0024
 * Email: cnddcoder@gmail.com
 */
class Controller{
    public function __construct(){

    }

    public function __get($key){
        $this->{$key} = load_class($key);
        return $this->{$key};
    }
}