<?php
namespace app\admin\controller;
use think\Controller;
use \think\Session;
use app\admin\model\ReplyModel;
class Reply extends Controller
{
    public function editReply()
    {
        if(!isLogin()){
           return $this->error('你未登录','login/login');
         }
        $reply = new ReplyModel();
         $replyList = $reply->showReply();
         $this->assign('replyList',$replyList);
        return  $this->fetch('editReply');
    }

     public function deleteAction()
    {
        if(!isLogin()){
           return $this->error('你未登录','login/login');
         }
        $reply= new ReplyModel();
        $id = input('get.id');
         $isDelete = $reply->deleteReply($id);
         if($isDelete===true){
                return $this->success('删除评论成功');
         }
         else {
            return $this->error($isDelete);
         }
    }
}
