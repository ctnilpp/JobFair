<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\User;
use app\index\model\PostModel;
use \think\Session;
class Myself extends Controller
{
    public function Myself()
    {
    	 if(isLogin()){
             $this->assign('username',session('username'));
         }
         else {
              return $this->error('请先登录','login/login');
         }
         $user = new User();
         $userInfo = $user->userInfo(session('username'));
         $post = new PostModel();
         $ownPostList = $post->showOwnPost(session('username'));
         $ownLastPostList = $post->showLastPost(session('username'));
         $this->assign('ownLastPostList',$ownLastPostList);
         $this->assign('ownPostList',$ownPostList);
         $this->assign('userInfo',$userInfo);
        return  $this->fetch('myself');
    }

    public function deleteSession()
    {
        session('username',null);
    }

    public function editAction()
    {
        if(!isLogin()){
             return $this->error('你未登录','login/login');
         }
        $user = new User();
        $name = input('name');
         $isEdit = $user->editUser(session('username'),$name);
         if($isEdit===true){
                return $this->success('修改名字成功');
         }
         else {
            return $this->error($isEdit);
         }
    }

    public function editPersonnalAction()
    {
        if(!isLogin()){
             return $this->error('你未登录','login/login');
         }
        $user = new User();
        $personnal = input('personnal');
        $id = input('id');
         $isEdit = $user->editPersonnal($id,$personnal);
         if($isEdit===true){
                return $this->success('修改简历成功');
         }
         else {
            return $this->error($isEdit);
         }
    }

}
