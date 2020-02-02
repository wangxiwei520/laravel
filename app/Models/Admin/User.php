<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'auth_user';
    protected $guarded = [];
    public function  getInfo(){
        $users = self::get();
        return $users;
    }


    public function getUser($where,$filed)
    {
     return   $this->where($where)->select($filed)->first();
    }
}
