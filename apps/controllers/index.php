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
        $this->db->where('username','1111');
        $res = $this->db->get('admin_users');
        $this->output->api_return($res);
    }
    public function user(){
        $this->load->model('Usermodel');
    }
}