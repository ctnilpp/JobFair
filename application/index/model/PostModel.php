<?php 
namespace app\index\model;

use think\Model;

class PostModel extends Model
{
	// 设置当前模型对应的完整数据表名称
    protected $table = 'post';
    
    public function showPost(){
        $post = new PostModel();
        $showPost = $post->paginate(20);
        return $showPost;
    }

    public function showLastPost($username){
        $post = new PostModel();
        $showPost = $post
        ->where('author',$username)
        ->limit(0,5)
        ->order(['date'=>'desc'])
        ->select();
        return modelTransfer($showPost);
    }

    public function showOwnPost($username){
        $post = new PostModel();
        $showOwnPost = $post->where('author',$username)
        ->paginate(1);
        return $showOwnPost;
    }

    public function showPostDetail($id){
        $post = new PostModel();
        $showOwnPost = $post->where('id',$id)
        ->paginate(1);
        return $showOwnPost;
    }

    public function addPost($username,$info,$role){
        $post = new PostModel();
        if($role!='会员'){
            return '发表失败,你不是企业会员';
        }
        $post->data([
   		 	  'title'  =>  $info['title'],
   			 'content' =>  $info['content'],
   			 'date'  =>  $info['date'],
   			 'author' =>  $username,
   			 'click' =>  0,
   			 'commentnum' =>  0,
			]);
		if($post->save()){
			return true;
		}
		else return '发表失败';
    }
}