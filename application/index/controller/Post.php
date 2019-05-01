<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\User;
use app\index\model\PostModel;
use \think\Session;
class Post extends Controller
{
    public function post()
    {
    	if(isLogin()){
    	 	 $this->assign('username',session('username'));
    	 }
    	 else {
    	 	return $this->error('你未登录','login/login');
    	 }
        return  $this->fetch('post');
    }

     public function addPost()
    {
    	if(!isLogin()){
    	 	return $this->error('你未登录','login/login');
    	 }
    	  $post = new PostModel();
    	  $info = array();
    	  $info['title'] = input('title');
    	  $info['content'] = input('content');
    	  $info['date'] = date('Y-m-d H:i:s',time());
          $isPost = $post->addPost(session('username'),$info,session('role'));
          if($isPost===true){
    	 	return $this->success('发表成功');
    	 }
    	 else {
    	 	return  $this->error($isPost);
    	 }
    }
}
