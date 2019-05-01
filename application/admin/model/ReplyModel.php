<?php 
namespace app\admin\model;

use think\Model;

class ReplyModel extends Model
{
	// 设置当前模型对应的完整数据表名称
    protected $table = 'comment';
    
    public function showReply(){
        $reply = new ReplyModel();
        $replyPost = $reply->paginate(10);
        return $replyPost;
    }

    public function deleteReply($id){
        $reply = new ReplyModel();
        $isDelete =$reply->where('id','=',$id)
        ->delete();
        if($isDelete){
             return true;
        }
        else {
            return '删除评论失败';
        }
    }
}