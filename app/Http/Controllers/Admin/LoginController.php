<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    //


    public function login(Request $request)
    {
        $user_name = $request->input('username');
        $user = new User();
        //获取用户数据
        $userInfo =  $user->getUser(['user_name'=>$user_name],['id','user_name','password','status','group_id']);
        //验证用户信息
        if ($userInfo && password_verify($request->input('password'),$userInfo->password) && !empty($userInfo['status'])) {
         return prompt('登录成功');
        }
        return prompt('用户名或密码错误',10001);
    }
}
