<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\User;
use app\index\model\PostModel;
use app\index\model\ReplyModel;
use \think\Session;
class Read extends Controller
{
    public function read()
    {
    	if(isLogin()){
    	 	 $this->assign('username',session('username'));
    	 }
          $user = new User();
         $userInfo = $user->userInfo(session('username'));
         $reply = new ReplyModel();
         $replyList = $reply->showReply(input('get.id'));
    	 $post = new PostModel();
         $postDetail = $post->showPostDetail(input('get.id'));
    	 $this->assign('postDetail',$postDetail);
           $this->assign('userInfo',$userInfo);
            $this->assign('replyList',$replyList);
        return  $this->fetch('read');
    }

    public function addAction()
    {
        if(!isLogin()){
            return  $this->error('你未登录');
         }
         
        $reply = new ReplyModel();
        $info = array();
        $info['content'] = input('content');
        $info['pid']  = (int)input('pid');
        $info['date'] = date('Y-m-d H:i:s',time());
        $isAdd = $reply->addReply(session('username'),$info);
        if($isAdd===true){
            return $this->success('评论成功');
        }
        else {
            return $this->error($isAdd);
        }
    }
}
