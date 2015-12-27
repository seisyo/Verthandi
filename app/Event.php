<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use SoftDeletes;
    
    protected $table = 'event';
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];
}
