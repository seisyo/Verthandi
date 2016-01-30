<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

    protected $table = 'event';
    protected $guarded = ['id'];
    protected $fillable = ['name', 'event_at'];
    protected $dates = ['deleted_at'];

    public function trade()
    {
        return $this->hasMany('App\Trade');
    }

    public function diaryAttachedFiles()
    {
        return $this->hasMany('App\DiaryAttachedFiles');
    }
}
