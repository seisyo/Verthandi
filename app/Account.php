<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $table = 'account';
    protected $fillable = ['id', 'name', 'comment'];
    public $timestamps = false;

    public function account()
    {
        return $this->hasOne('App\Account', 'parent_id', 'id');
    }
}
