<?php

/**
 * User: wuchunzhi
 * Date: 2015/8/24 0024
 * Email: cnddcoder@gmail.com
 */
class Index extends Controller
{
    public function __construct(){

    }

    public function index(){
        $this->output->api_return("<------------------------> .\n");
    }
    public function user(){
        $this->load->model('Usermodel');
    }
}