<?php
/**
 * User: wuchunzhi
 * Date: 2015/8/27 0027
 * Email: cnddcoder@gmail.com
 */
class Output{
    public function __construct(){

    }

    public function api_return($data){
        if(is_array($data)){
            $data = json_encode($data);
        }
        servers::$_send->send($_SERVER['fd'], $data);
    }

}