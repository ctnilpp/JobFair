<?php 
namespace app\index\model;

use think\Model;

class ReplyModel extends Model
{
	// 设置当前模型对应的完整数据表名称
    protected $table = 'comment';
    
    public function showReply($id){
        $reply = new ReplyModel();
        $showreply = $reply->where('pid','=',$id)
        ->paginate(20);
        return $showreply;
    }


    public function addReply($username,$info){
        $reply = new ReplyModel();
        $reply->data([    
   			 'content' =>  $info['content'],
   			 'pid'  =>  $info['pid'],
         'date' => $info['date'],
         'author' => $username  
			]);
		if($reply->save()){
			return true;
		}
		else return '发表评论失败';
    }
}