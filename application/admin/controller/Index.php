<?php
namespace app\admin\controller;
use think\Controller;
use \think\Session;
class Index extends Controller
{
    public function index()
    {
        if(!isLogin()){
           return $this->error('你未登录','login/login');
         }
        return  $this->fetch('index');
    }

   
}
