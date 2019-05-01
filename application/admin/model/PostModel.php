<?php 
namespace app\admin\model;

use think\Model;

class PostModel extends Model
{
	// 设置当前模型对应的完整数据表名称
    protected $table = 'post';
    
    public function showPost(){
        $post = new PostModel();
        $showPost = $post->paginate(10);
        return $showPost;
    }


    public function deletePost($id){
        $post = new PostModel();
        $isDelete =$post->where('id','=',$id)
        ->delete();
        if($isDelete){
             return true;
        }
        else {
            return '删除帖子失败';
        }
    }
}