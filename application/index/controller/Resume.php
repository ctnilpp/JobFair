<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\User;
use app\index\model\ResumeModel;
use \think\Session;
class Resume extends Controller
{
    public function resume()
    {
      if(isLogin()){
         $this->assign('username',session('username'));
       }
       $resume= new ResumeModel();
       $resumeList = $resume->showResume(session('username'));
       $this->assign('resumeList',$resumeList);
        return  $this->fetch('resume');
    }

public function resumeDetail()
    {
      if(!isLogin()){
        return $this->error('你未登录','login/login');
       }
         $sender = input('username');
         $user = new User();
         $resume= new ResumeModel();
         $userInfo = $user->userInfo($sender);
         $resumeDetail = $resume->getResume($sender,session('username'));
           $this->assign('userInfo',$userInfo);
           $this->assign('resumeDetail',$resumeDetail);
           $this->assign('username',session('username'));
        return  $this->fetch('resumedetail');
    }

  public function changePass(){

        if(!isLogin()){
        return $this->error('你未登录','login/login');
       }
       $sender = input('sender');
      $resume = new ResumeModel();
      $user = new User();
     $userInfo = $user->userInfo($sender);
     
     $successPass = $resume->changePass($sender,session('username'),session('role'));
     // var_dump($successPass);
     //  var_dump($sender);
    if($successPass){

            return $this->success('录取成功');
    }
    else {
       return  $this->error('录取失败');
    }
  }

     public function addResume()
    {
    	if(!isLogin()){
    	 	return $this->error('你未登录','login/login');
    	 }
    	  $resume = new ResumeModel();
          $author = input('author');
          // var_dump($author);
          $isSend = $resume->isSend(session('username'),$author);
         if($isSend){
             return  $this->error("你发送过简历了");
         }
         else {
          $isResume =  $resume->addAction(session('username'),$author,session('role'));
              if($isResume===true){
        return $this->success('发表简历成功');
       }       
       else {
        return  $this->error($isResume);
       }
         }
             
    }
}
