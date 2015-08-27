<?php
/**
 * User: wuchunzhi
 * Date: 2015/8/27 0027
 * Email: cnddcoder@gmail.com
 */
class Model{
    public function __construct(){

    }

    public function __get($key){
        $this->{$key} = &load_class($key);
        return $this->{$key};
    }
}