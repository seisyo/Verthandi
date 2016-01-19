<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $table = 'account';
    protected $fillable = ['id', 'name', 'comment', 'parent_id', 'direction'];
    public $timestamps = false;

    public function account()
    {
        return $this->hasOne('App\Account', 'id', 'parent_id');
    }

    public function diary()
    {
        return $this->hasMany('App\Diary');
    }
}
