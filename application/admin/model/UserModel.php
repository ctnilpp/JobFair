<?php 
namespace app\admin\model;

use think\Model;

class UserModel extends Model
{
	// 设置当前模型对应的完整数据表名称
    protected $table = 'user';
    
    public function isVail($username,$passcode){
    	$user = new UserModel();
    	$isVail = $user->where('username', $username)
              ->find();
        if($isVail) {
            if($isVail->role==='管理员'){
                if($isVail->passcode==$passcode){
                 return true;
                     }
                     else return "密码错误";
            }
        	else return "你不是管理员";
        	
        }
        else return "用户名不存在";
    }

    public function showUser(){
        $user = new UserModel();
        $showUser = $user->paginate(10);
        return $showUser;
    }

    public function editUser($id,$username,$passcode){
        $user = new UserModel();
        $isEdit = $user->save([
    'username'  => $username,
    'passcode' => $passcode
    ],['id' => 1]);
        if($isEdit){
             return true;
        }
        else {
            return '更新用户失败';
        }
    }

    public function deleteUser($id){
        $user = new UserModel();
        $isDelete =$user->where('id','=',$id)
        ->delete();
        if($isDelete){
             return true;
        }
        else {
            return '删除用户失败';
        }
    }   
}