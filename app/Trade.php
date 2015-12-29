<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trade extends Model
{
    use SoftDeletes;

    protected $table = 'trade';
    protected $guarded = ['id'];
    protected $fillable = ['name', 'comment', 'handler'];
    protected $dates = ['deleted_at'];

    public function trade(){

        return $this->hasOne('App\User', 'user_id', 'id');

    }

    public function event(){

        return $this->hasOne('App\Event', 'event_id', 'id');

    }
}
