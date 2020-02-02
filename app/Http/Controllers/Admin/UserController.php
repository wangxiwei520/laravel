<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * @api {get} /userList  userList
     * @apiName 用户登录
     * @apiGroup 用户组
     * @apiVersion 1.0.0
     * @apiDescription 用户登录接口
     * @apiParam {string} mobile 用户名或手机号码
     */
    public function userList()
    {
        return (new User())->getInfo();
    }
}
