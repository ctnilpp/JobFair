<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\User;
use app\index\model\PostModel;
use \think\Session;
class Index extends Controller
{
    public function index()
    {
    	 if(isLogin()){
    	 	 $this->assign('username',session('username'));
    	 }
    	 $post = new PostModel();
    	 $postList = $post->showPost();
    	 $this->assign('postList',$postList);
        return  $this->fetch('index');
    }

  public function sessionCheek()
    {
        
        echo session('role'); 
    }

     public function exitUser()
    {
         session('username',null);
         if(!isLogin()){
             return $this->success('退出成功','index/index');
         }
         else return $this->error('退出失败');
    }
}
