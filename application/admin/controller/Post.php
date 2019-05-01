<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\PostModel;
use \think\Session;
class Post extends Controller
{
    public function editPost()
    {
        if(!isLogin()){
           return $this->error('你未登录','login/login');
         }
    	$post = new PostModel();
         $postList = $post->showPost();
         $this->assign('postList',$postList);
        return  $this->fetch('editPost');
    }

    public function addPost()
    {
        if(!isLogin()){
           return $this->error('你未登录','login/login');
         }
        return  $this->fetch('addPost');
    }

    public function deleteAction()
    {
        if(!isLogin()){
           return $this->error('你未登录','login/login');
         }
        $post = new PostModel();
        $id = input('get.id');
         $isDelete = $post->deletePost($id);
         if($isDelete===true){
                return $this->success('删除帖子成功');
         }
         else {
            return $this->error($isDelete);
         }
    }
}
