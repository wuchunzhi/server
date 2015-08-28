<?php

/**
 * User: wuchunzhi
 * Date: 2015/8/26 0026
 * Email: cnddcoder@gmail.com
 */
class servers
{
    static $_swoole_server;

    static $_server;

    static $_send;

    public function __construct()
    {
        self::$_server = new swoole_server("0.0.0.0", 9501);
        self::$_server->set(array(
            'reactor_num' => 8 * 2, //�߳��� CPU2��
            'worker_num' => 8 * 2,   //����������work������ CPU2��
            'daemonize' => false, //�Ƿ���Ϊ�ػ�����
            'max_request' => 0, //work�������������
            'max_conn' => 500, //server �������tcp������  ���ó��� ulimit -n ����������
            'task_worker_num' => 8 * 2, //����task���̵����������ô˲����󽫻�����task���ܡ�����swoole_server���Ҫע��onTask/onFinish2���¼��ص����������û��ע�ᣬ�����������޷�������
            'task_max_request' => 2000, //����task���̵����������
            'task_tmpdir' => './tmp', //����task��������ʱĿ¼
        ));
        self::$_server->on('connect', array($this, 'connect'));
        self::$_server->on('receive', array($this, 'receive'));
        self::$_server->on('Task', array($this, 'Task'));
        self::$_server->on('WorkerStart', array($this, 'WorkerStart'));
        self::$_server->on('WorkerStop', array($this, 'WorkerStop'));
        self::$_server->on('Finish', array($this, 'Finish'));
        self::$_server->on('WorkerError', array($this, 'WorkerError'));
        self::$_server->on('close', array($this, 'close'));
        self::$_server->start();
    }

    /**
     * ��ʼ����Ϣ
     */
    public function init_info($fd, $from_id, $data)
    {
        $_SERVER = array();
        if (is_string($data)) {
            $data = json_decode($data, true);
        }
        $_SERVER['c'] = isset($data['c']) ? $data['c'] : 'index';
        $_SERVER['m'] = isset($data['m']) ? $data['m'] : 'index';
        $_SERVER['fd'] = $fd;
        $_SERVER['from_id'] = $from_id;
    }

    /**
     * ���п��
     */
    public function run_mvc()
    {
        $index = mainindex::getinstance();
        $index->start_server();
    }

    /**
     * ����
     * @param $serv
     * @param $fd
     */
    public function connect($serv, $fd)
    {
        echo "Client:Connect. $fd . \n";
    }

    /**
     * ��������
     * @param $serv
     * @param $fd
     * @param $from_id
     * @param $data
     */
    public function receive($serv, $fd, $from_id, $data)
    {
        $time = explode ( " ", microtime () );
        $time = $time [1] . ($time [0] * 1000);
        $time2 = explode ( ".", $time );
        $btime = $time2 [0];
        if (!isset(self::$_send)) {
            self::$_send = $serv;
        }
        $this->init_info($fd, $from_id, $data);
        $this->run_mvc();
        $time = explode ( " ", microtime () );
        $time = $time [1] . ($time [0] * 1000);
        $time2 = explode ( ".", $time );
        $etime = $time2 [0];
        self::$_send->send($fd, "\n usetime: " . $etime - $btime);
        //$serv->close($fd);
    }

    /**
     *
     * @param $serv
     * @param $task_id
     * @param $from_id
     * @param $data
     */
    public function Task($serv, $task_id, $from_id, $data)
    {
        echo "Task .\n";
    }

    /**
     * @param $server
     * @param $worker_id
     */
    public function WorkerStart($server, $worker_id)
    {
        require 'index.php';
        mainindex::getinstance();
        echo "WorkerStart | worker_id = $worker_id .\n";
    }

    /**
     * @param $server
     * @param $worker_id
     */
    public function WorkerStop($server, $worker_id)
    {
        echo "WorkerStop .\n";
    }

    /**
     * @param $serv
     * @param $task_id
     * @param $data
     */
    public function Finish($serv, $task_id, $data)
    {
        echo "Finish .\n";
    }

    /**
     * @param $serv
     * @param $worker_id
     * @param $worker_pid
     * @param $exit_code
     */
    public function WorkerError($serv, $worker_id, $worker_pid, $exit_code)
    {
        echo "WorkerError .\n";
    }

    /**
     * �ر�����
     */
    public function close()
    {
        echo "Client: Close.\n";
    }

    public static function get_instance()
    {
        if (self::$_swoole_server) {
            return self::$_swoole_server;
        }
        self::$_swoole_server = new self();
        return self::$_swoole_server;
    }
}

servers::get_instance();