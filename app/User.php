<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';
    protected $guarded = ['id'];

    public function userDetail(){

        return $this->hasOne('App\UserDetail', 'user_id', 'id');
    }
}
