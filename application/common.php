<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

function isLogin(){
	if(session('username')){
		 return true;
	}
	else return false;
}

function modelTransfer($array)
{
    if (empty($array) || !count($array)) {
        return false;
    }
    foreach ($array as $value) {
        $datarray[] = $value->toArray();
    }
    return $datarray;
}

// 应用公共文件
