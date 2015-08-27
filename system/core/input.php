<?php

/**
 * User: wuchunzhi
 * Date: 2015/8/24 0024
 * Email: cnddcoder@gmail.com
 */
class Input
{
    private $get = null;
    private $post = null;
    private $get_post = null;

    public function __construct()
    {

    }

    public function init()
    {
        $this->get();
        $this->post();
        $this->get_post();
    }

    public function get($params = '')
    {
        if (is_null($this->get)) {
            foreach ($_GET as $key => $val) {
                $this->get .= $key . '=' . $val . '&';
            }
            $this->get = xss_clean($this->get);
            if (!is_null($this->get)) {
                parse_str($this->get, $get_info);
                $this->get = null;
                foreach ($get_info as $key => $val) {
                    $this->get[$key] = $val;
                }
            }
        }

        if ($params == null) {
            return $this->get;
        }
        return $this->get[$params];
    }

    public function post($params = '')
    {
        if (is_null($this->post)) {
            foreach ($_POST as $key => $val) {
                $this->post .= $key . '=' . $val . '&';
            }
            if (!is_null($this->post)) {
                parse_str($this->post, $post_info);
                $this->post = null;
                foreach ($post_info as $key => $val) {
                    $this->post[$key] = $val;
                }
            }
        }
        if ($params == null) {
            return $this->post;
        }
        return $this->post[$params];
    }

    public function get_post($params = '')
    {
        if (is_null($this->get_post)) {
            foreach ($_REQUEST as $key => $val) {
                $this->get_post .= $key . '=' . $val . '&';
            }
            if (!is_null($this->get_post)) {
                parse_str($this->get_post, $request_info);
                $this->get_post = null;
                foreach ($request_info as $key => $val) {
                    $this->get_post[$key] = $val;
                }
            }
        }
        if ($params == null) {
            return $this->get_post;
        }
        return $this->get_post[$params];
    }

}