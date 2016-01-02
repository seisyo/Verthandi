<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trade extends Model
{
    use SoftDeletes;

    protected $table = 'trade';
    protected $guarded = ['id'];
    protected $fillable = ['name', 'comment', 'handler', 'event_id', 'user_id', 'trade_at'];
    protected $dates = ['deleted_at'];

    // public function user()
    // {
    //     return $this->hasOne('App\User', 'id', 'user_id');
    // }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function event()
    {
        return $this->belongsTo('App\Event');
    }

    public function diary()
    {
        return $this->hasMany('App\Diary');
    }
}
