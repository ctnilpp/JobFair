<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\User;
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
    }

    public function loginAction()
    {
    	$user = new User();
    	$username = input('username');
    	$passcode = input('passcode');
        $isVail = $user->isVail($username,sha1($passcode));
        if($isVail===true){
            $info = $user->userInfo($username);
        	session('username',$username);
            session('role',$info[0]['role']);
        	return $this->success('登陆成功','index/index');
        }
        else {
        	return $this->error($isVail);
        }
    }

     public function showSession()
    {  
    	
    	var_dump(isLogin());
    }
}
