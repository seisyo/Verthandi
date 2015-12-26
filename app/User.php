<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use SoftDeletes;

    protected $table = 'user';
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];

    public function userDetail(){

        return $this->hasOne('App\UserDetail', 'user_id', 'id');
    }
}
