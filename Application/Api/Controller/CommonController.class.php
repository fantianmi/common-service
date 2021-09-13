<?php

namespace Api\Controller;

use Think\Controller;

class CommonController extends Controller
{
    public function jsuccess($data = '', $msg = '')
    {
        $this->json(1, $msg, $data);
        exit;
    }

    public function jerror($msg = '', $ret = 10000, $data = '')
    {
        $this->json($ret, $msg, $data);
        exit;
    }

    public function json($ret = 0, $msg = '', $data = '')
    {
        header('Content-Type:application/json; charset=utf-8');
        header('Access-Control-Allow-Methods:*');
        header('Access-Control-Allow-Headers:*');
        header("Access-Control-Request-Headers:*");
        header("Access-Control-Allow-Origin:*");
        $return = array(
            'status' => $ret,
            'info' => $msg,
            'data' => $data
        );
        echo json_encode($return);
        exit;
    }
}