<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    //


    //登录
    public function login(Request $request)
    {

        $user_name = $request->input('name');
        $user = new User();
        //获取用户数据
        $userInfo =  $user->where(['name'=>$user_name])->first();
        //验证用户信息
        if ($userInfo && password_verify($request->input('password'),$userInfo->password) && !empty($userInfo['status'])) {
            //存储加密信息  防止控制台操作
//            $transportInfo=array(
//                'is_super'=>$userInfo['is_super'],
//                'user_id'=>$userInfo['id'],
//                'api_token'=>$userInfo['api_token'],
//                'img'=>$user['img'],
//                'group_id'=>$user['group_id'],
//                'time'=>strtotime(date("Y-m-d"),time()),
//                'transportWtk'=>md5($user['is_super'].$user['id'].strtotime(date("Y-m-d"),time()))
//            );
            //生成加密token
//            $token = str_authcode(json_encode($transportInfo),'ENCODE');
            $token = create_api_token();
            $userInfo->update(['api_token'=>hash('sha256',$token)]);
         return prompt('登录成功',200,compact('token'));
        }
        return prompt('用户名或密码错误',10000);
    }

    //注册
    public function register(Request $request)
    {
        $validator =    $this->validator($request->all());
        //验证失败
        if ($validator->fails()) {
            return prompt('验证失败',10000);
        }
        $api_token = create_api_token();
        $data = array_merge($request->all(),compact('api_token'));
        $this->create($data);
        return prompt('注册成功',200,compact('api_token'));
     }

     //创建数据
    protected function create(array $data)
    {
        return  User::create([
           'name'=>$data['name'],
           'password'=>password_hash($data['password'],1),
           'api_token'=>hash('sha256',$data['api_token']),
       ]);
     }
    //验证
     protected function validator(array $data){
      return  Validator::make($data,[
           'name' => 'required|unique:users|max:10|min:4',
           'password' => 'required',
       ],[
          'name.max'=>'用户名长度不能大于10',
          'name.users'=>'用户名已存在',
          'name.min'=>'用户名长度不能小于4',
      ]);
     }


     //退出登录
    public function logout(Request $request)
    {
        auth()->user()->update(['api_token'=>null]);
        return prompt('退出登录成功!');
     }
     //验证用户是否登录
    public function checkIsLogin(Request $request)
    {
        $isLogin = false;
        if (Auth::user()) {
            $isLogin=true;
        }
        return prompt('ok',200,compact('isLogin'));
    }
}
