<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends BaseController
{

    //获取用户详情
    public function userInfo()
    {
      $user = array(
          'id'=>$this->user->id,
          'name'=>$this->user->name,
          'img'=>$this->user->img,
          'is_super'=>$this->user->is_super,
          'group_id'=>$this->user->group_id,
      );
      return prompt('ok',200,$user);
    }
}
