<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\UserModel;
use \think\Session;
class Login extends Controller
{
    public function login()
    {
        if(!isLogin()){
           return  $this->fetch('login');
         }
        else {
            return $this->error('你已登录','index/index');
        }
        return  $this->fetch('login');
    }
public function loginAction()
    {
        if(isLogin()){
           return $this->error('你已登录','index/index');
         }
    	$user = new UserModel();
    	$username = input('username');
    	$passcode = input('passcode');
        $isVail = $user->isVail($username,sha1($passcode));
        if($isVail===true){
        	session('username',$username);
        	return $this->success('登陆成功','index/index');
        }
        else {
        	return $this->error($isVail);
        }
    }

     public function exitUser()
    {
        if(!isLogin()){
           return $this->error('你未登录','login/login');
         }
        session('username',null);
        if(isLogin()){
           return $this->error('退出失败');
         }
         else {
            return $this->success('退出成功','login/login');
         }
    }
}
