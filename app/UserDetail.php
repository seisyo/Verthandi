<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $table = 'user_detail';
    protected $fillable = ['user_id', 'first_name', 'last_name', 'email', 'phone'];
    protected $primaryKey  = 'user_id';
    public $timestamps = false;

}
