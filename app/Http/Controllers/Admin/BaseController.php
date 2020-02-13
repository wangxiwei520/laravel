<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{
    protected $user;
    public function __construct()
    {
        if (!Auth::user()) {
          return  prompt('认证失败',10002);
        }
        $this->user = Auth::user();
    }
}
