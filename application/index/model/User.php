<?php 
namespace app\index\model;

use think\Model;

class User extends Model
{
	// 设置当前模型对应的完整数据表名称
    protected $table = 'user';
    
    public function isVail($username,$passcode){
    	$user = new User();
    	$isVail = $user->where('username', $username)
              ->find();
        if($isVail) {
        	if($isVail->passcode==$passcode){
        		return true;
        	}
        	else return "密码错误";
        }
        else return "用户名不存在";
    }


    public function userInfo($username){
        $user = new User();
        $info = $user->where('username', $username)
              ->paginate(1);
        return $info;
    }

    public function register($username,$passcode,$role){
    	$user = new User();
    	$isVail = $user->where('username', $username)
              ->find();
        if($isVail){
        		return "用户名已存在";
        }
        else {
            $user->data([
                'username'  =>  $username,
                 'passcode' =>  $passcode,
                 'role' => $role,
                ]);
            $user->save();
        	return true;
        }
    }

    public function editUser($username,$name){
        $user = new User();
        $isEdit = $user->save([
    'name'  => $name,
    ],['username' => $username]);
        if($isEdit){
             return true;
        }
        else {
            return '更新名字失败';
        }
    }

    public function editPersonnal($id,$personnal){
        $user = new User();
        $isEdit = $user->save([
    'personnal'  => $personnal,
    ],['id' => $id]);
        if($isEdit){
             return true;
        }
        else {
            return '更新简历失败';
        }
    }

  
}