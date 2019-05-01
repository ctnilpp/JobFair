<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\User;
class Register extends Controller
{
    public function register()
    {
        if(!isLogin()){
            return  $this->fetch('register');
         }
        else {
            return $this->error('你已登录','index/index');
        }
       
    }

    public function registerAction()
    {
        if(isLogin()){
            return  $this->error('你已登录');
         }
         
        $user = new User();
    	$username = input('username');
    	$passcode = input('passcode');
        $role = input('role');
        $register = $user->register($username,sha1($passcode),$role);
        if($register===true){
            session('username',$username);
            session('role',$role);
            return $this->success('注册成功','index/index');
        }
        else {
            return $this->error($register);
        }
    }


}
