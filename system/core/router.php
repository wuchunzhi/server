<?php

/**
 * User: wuchunzhi
 * Date: 2015/8/24 0024
 * Email: cnddcoder@gmail.com
 */
class Router
{
    private $_config = array();

    public function __construct($config)
    {
        $this->_config = $config;
    }

    /**
     * 路由设置
     * @return array
     */
    public function get_router()
    {
        if($this->_config['query_info'] == 'QUERY_STRING'){
            return $this->_QUERY_STRING();
        }
        if($this->_config['query_info'] == 'PATH_INFO'){
            return $this->_PATH_INFO();
        }
    }

    /**
     * QUERY_STRING模式
     * @return array
     */
    private function _QUERY_STRING(){
        list($controller, $method) = explode('&', xss_clean($_SERVER['QUERY_STRING']));
        $controller = str_replace($this->_config['controller'] . '=', '', $controller);
        $method = str_replace($this->_config['method'] . '=', '', $method);
        return array('controller' => $controller, 'method' => $method);
    }

    /**
     * PATH_INFO模式
     * @return array
     */
    private function _PATH_INFO(){
        $pathinfo = substr($_SERVER['PATH_INFO'], 1, strlen($_SERVER['PATH_INFO']) - 1);
        list($controller, $method) = explode('/', $pathinfo);
        $controller = str_replace($this->_config['controller'] . '=', '', $controller);
        $method = str_replace($this->_config['method'] . '=', '', $method);
        return array('controller' => $controller, 'method' => $method);
    }

    public function get_auto_router(){
        //加载controller
        $CTR = load_class('Controller');
        if(!empty($this->_config['auto_controller'])){
            foreach($this->_config['auto_controller'] as $val){
                if (!file_exists(APPPATH . '/controllers/' . $val . '.php')) {
                    show_404('controllers/' . $val . '.php');
                    return;
                }
                load_class($val, 'controllers');
            }
        }
        //加载model
        if(!empty($this->_config['auto_model'])){
            foreach($this->_config['auto_model'] as $val){
                if (!file_exists(APPPATH . '/models/' . $val . '.php')) {
                    show_404('models/' . $val . '.php');
                    return;
                }
                load_class($val, 'models');
            }
        }
    }
}