<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\UserModel;
use \think\Session;
class User extends Controller
{
    public function editUser()
    {
        if(!isLogin()){
           return $this->error('你未登录','login/login');
         }
    	$user = new UserModel();
         $userList = $user->showUser();
         $this->assign('userList',$userList);
        return  $this->fetch('editUser');
    }

    public function addUser()
    {
        if(!isLogin()){
           return $this->error('你未登录','login/login');
         }
        return  $this->fetch('addUser');
    }

    public function editAction()
    {
        if(!isLogin()){
           return $this->error('你未登录','login/login');
         }
        $user = new UserModel();
        $id = input('id');
        $username = input('username');
        $passcode = sha1(input('passcode'));
         $isEdit = $user->editUser($id,$username,$passcode);
         if($isEdit===true){
                return $this->success('修改用户成功');
         }
         else {
            return $this->error($isEdit);
         }
    }

    public function deleteAction()
    {
        if(!isLogin()){
           return $this->error('你未登录','login/login');
         }
        $user = new UserModel();
        $id = input('get.id');
         $isDelete = $user->deleteUser($id);
         if($isDelete===true){
                return $this->success('删除用户成功');
         }
         else {
            return $this->error($isDelete);
         }
    }
}
