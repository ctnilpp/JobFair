<?php 
namespace app\index\model;

use think\Model;


class ResumeModel extends Model
{
	// 设置当前模型对应的完整数据表名称
    protected $table = 'resume';
    
    public function showResume($username){
        $resume = new ResumeModel();
        $showResume = $resume->where('recorder',$username)->paginate(20);
        return $showResume;
    }

    public function isSend($sender,$recorder){
        $resume = new ResumeModel();
        $resumeNumber = $resume->where('recorder',$recorder)
        ->where('sender',$sender)->count();
        if($resumeNumber>0){
              return true;
        }
        else return false;
    }

public function getResume($sender,$recorder){
        $resume = new ResumeModel();
         $info = $resume->where('sender', $sender)->where('recorder',$recorder)
              ->paginate(1);
        return $info;
    }

  //   public function showLastPost($username){
  //       $post = new PostModel();
  //       $showPost = $post
  //       ->where('author',$username)
  //       ->limit(0,5)
  //       ->order(['date'=>'desc'])
  //       ->select();
  //       return modelTransfer($showPost);
  //   }

  //   public function showOwnPost($username){
  //       $post = new PostModel();
  //       $showOwnPost = $post->where('author',$username)
  //       ->paginate(1);
  //       return $showOwnPost;
  //   }

  //   public function showPostDetail($id){
  //       $post = new PostModel();
  //       $showOwnPost = $post->where('id',$id)
  //       ->paginate(1);
  //       return $showOwnPost;
  //   }
public function changePass($sender,$recorder,$role){
        $resume = new ResumeModel();
        if($role!='会员'){
            return '录取失败,你不是会员';
        }
       $resumeSuccess = $resume->where('sender',$sender)->where('recorder',$recorder)
    ->update(['pass' => 1]);
    // var_dump($resumeSuccess);
    if($resumeSuccess){
          return true;
    }
    else return false;
    }


    public function addAction($username,$author,$role){
        $resume = new ResumeModel();
        if($role!='用户'){
            return '发表简历失败,你不是用户';
        }
        $resume->data([
   		 	  'sender'  =>  $username,
   			 'recorder' =>  $author,
			]);
		if($resume->save()){
			return true;
		}
		else return '发表简历失败';
    }
}