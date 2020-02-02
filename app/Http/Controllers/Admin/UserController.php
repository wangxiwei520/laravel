<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function userList()
    {
        $user = (new User())->getInfo();
        dump($user);
    }
}
